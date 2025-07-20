<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by registration date
        if ($request->has('date_filter') && $request->date_filter) {
            switch ($request->date_filter) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        // Filter by order status
        if ($request->has('order_filter') && $request->order_filter) {
            switch ($request->order_filter) {
                case 'with_orders':
                    $query->whereHas('orders');
                    break;
                case 'no_orders':
                    $query->whereDoesntHave('orders');
                    break;
            }
        }

        // Order by latest first
        $customers = $query->withCount(['orders', 'wishlists'])
                          ->with(['orders' => function($q) {
                              $q->latest()->limit(1);
                          }])
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        $customer->load(['orders.orderItems.product', 'wishlists.product', 'addresses']);
        
        // Calculate customer statistics
        $stats = [
            'total_orders' => $customer->orders()->count(),
            'total_spent' => $customer->orders()->sum('total_amount'),
            'avg_order_value' => $customer->orders()->avg('total_amount') ?: 0,
            'last_order' => $customer->orders()->latest()->first(),
            'favorite_products' => $customer->wishlists()->with('product')->get(),
            'recent_orders' => $customer->orders()->with('orderItems.product')->latest()->limit(5)->get()
        ];

        return view('admin.customers.show', compact('customer', 'stats'));
    }

    public function toggleStatus(Request $request, User $customer)
    {
        $customer->update([
            'is_active' => !$customer->is_active
        ]);

        $status = $customer->is_active ? 'activated' : 'deactivated';
        
        return response()->json([
            'success' => true,
            'message' => "Customer has been {$status} successfully.",
            'is_active' => $customer->is_active
        ]);
    }

    public function destroy(User $customer)
    {
        // Check if customer has orders
        if ($customer->orders()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete customer with existing orders.'
            ], 400);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully.'
        ]);
    }
}

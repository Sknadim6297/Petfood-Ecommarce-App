<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Coupon::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Discount type filter
        if ($request->has('discount_type') && !empty($request->discount_type)) {
            $query->where('discount_type', $request->discount_type);
        }

        $coupons = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:coupons,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'usage_limit' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000'
        ], [
            'code.unique' => 'This coupon code already exists.',
            'discount.min' => 'Discount must be greater than 0.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'end_date.after' => 'End date must be after start date.',
        ]);

        // Custom validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount > 100) {
            $validator->after(function ($validator) {
                $validator->errors()->add('discount', 'Percentage discount cannot be more than 100%.');
            });
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $coupon = Coupon::create([
                'code' => strtoupper($request->code),
                'discount_type' => $request->discount_type,
                'discount' => $request->discount,
                'min_order_amount' => $request->min_order_amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'usage_limit' => $request->usage_limit,
                'description' => $request->description
            ]);

            return redirect()
                ->route('admin.coupons.index')
                ->with('success', 'Coupon created successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error creating coupon: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'discount_type' => 'required|in:percentage,fixed',
            'discount' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'usage_limit' => 'nullable|integer|min:1',
            'description' => 'nullable|string|max:1000'
        ], [
            'code.unique' => 'This coupon code already exists.',
            'discount.min' => 'Discount must be greater than 0.',
            'end_date.after' => 'End date must be after start date.',
        ]);

        // Custom validation for percentage discount
        if ($request->discount_type === 'percentage' && $request->discount > 100) {
            $validator->after(function ($validator) {
                $validator->errors()->add('discount', 'Percentage discount cannot be more than 100%.');
            });
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $coupon->update([
                'code' => strtoupper($request->code),
                'discount_type' => $request->discount_type,
                'discount' => $request->discount,
                'min_order_amount' => $request->min_order_amount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'usage_limit' => $request->usage_limit,
                'description' => $request->description
            ]);

            return redirect()
                ->route('admin.coupons.index')
                ->with('success', 'Coupon updated successfully!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating coupon: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            
            return redirect()
                ->route('admin.coupons.index')
                ->with('success', 'Coupon deleted successfully!');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting coupon: ' . $e->getMessage());
        }
    }

    /**
     * Toggle coupon status
     */
    public function toggleStatus(Coupon $coupon)
    {
        try {
            $coupon->update([
                'status' => $coupon->status === 'active' ? 'inactive' : 'active'
            ]);

            $message = $coupon->status === 'active' ? 'Coupon activated successfully!' : 'Coupon deactivated successfully!';
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $coupon->status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating coupon status: ' . $e->getMessage()
            ], 500);
        }
    }
}

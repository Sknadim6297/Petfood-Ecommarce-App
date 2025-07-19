<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:cod,online',
            'order_notes' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();
        
        // Debug: Log current user and cart check
        Log::info('Order placement attempt', [
            'user_id' => $user->id,
            'request_data' => $request->all()
        ]);
        
        // Get cart items
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        // Debug: Log cart items
        Log::info('Cart items found', [
            'user_id' => $user->id,
            'cart_count' => $cartItems->count(),
            'cart_items' => $cartItems->toArray()
        ]);
        
        if ($cartItems->isEmpty()) {
            Log::warning('Cart is empty for user', ['user_id' => $user->id]);
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty'
            ], 400);
        }

        DB::beginTransaction();
        
        try {
            // Calculate totals
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
            
            $shippingAmount = $subtotal >= 500 ? 0 : 50;
            $totalAmount = $subtotal + $shippingAmount;

            // Get shipping address directly from database
            $shippingAddress = Address::where('user_id', $user->id)
                                     ->where('id', $request->shipping_address_id)
                                     ->first();
            
            if (!$shippingAddress) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid shipping address selected'
                ], 400);
            }
            
            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . date('Y') . '-' . str_pad(rand(100000, 999999), 6, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'payment_method' => $request->payment_method === 'cod' ? 'cash_on_delivery' : 'online_payment',
                'payment_status' => $request->payment_method === 'cod' ? 'pending' : 'pending',
                'subtotal' => $subtotal,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $totalAmount,
                'shipping_address' => $shippingAddress->full_address,
                'phone' => $shippingAddress->phone,
                'email' => $user->email,
                'order_notes' => $request->order_notes
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    'total' => $cartItem->product->price * $cartItem->quantity
                ]);
            }

            // Clear cart
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            if ($request->payment_method === 'online') {
                // Here you would integrate with payment gateway
                // For now, we'll just return success
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'redirect_to_payment' => true,
                    'payment_url' => route('order.payment', $order->id)
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully! You will pay on delivery.',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error placing order: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show order confirmation
     */
    public function confirmation($orderId)
    {
        $order = Order::with(['orderItems.product', 'user'])
                     ->where('user_id', Auth::id())
                     ->findOrFail($orderId);

        return view('frontend.order.confirmation', compact('order'));
    }

    /**
     * Show user orders
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with(['orderItems.product'])
                      ->latest()
                      ->paginate(10);

        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show($orderId)
    {
        $order = Order::with(['orderItems.product'])
                     ->where('user_id', Auth::id())
                     ->findOrFail($orderId);

        return view('frontend.order.show', compact('order'));
    }

    /**
     * Handle payment page (for online payments)
     */
    public function payment($orderId)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('payment_method', 'online_payment')
                     ->findOrFail($orderId);

        // Here you would integrate with actual payment gateway
        // For demo purposes, we'll simulate successful payment
        
        return view('frontend.order.payment', compact('order'));
    }

    /**
     * Process payment (demo)
     */
    public function processPayment(Request $request, $orderId)
    {
        $order = Order::where('user_id', Auth::id())
                     ->where('payment_method', 'online_payment')
                     ->findOrFail($orderId);

        // Simulate payment processing
        $order->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment successful! Your order has been confirmed.',
            'redirect_url' => route('order.confirmation', $order->id)
        ]);
    }
}

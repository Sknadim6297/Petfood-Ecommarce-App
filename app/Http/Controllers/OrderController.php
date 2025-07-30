<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Address;
use App\Models\Cart;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->middleware('auth');
        $this->couponService = $couponService;
    }

    public function store(Request $request)
    {
        try {
            Log::info('Order store request started', $request->all());
            
            // Validate the request
            $request->validate([
                'shipping_address_id' => 'required|exists:addresses,id',
                'payment_method' => 'required|in:cod,online'
            ]);

            $user = Auth::user();
            Log::info('User validated', ['user_id' => $user->id]);
            
            // Get cart items - use database for authenticated users, session for guests
            if (Auth::check()) {
                // For authenticated users, get cart from database - load both product and cooked food relationships
                $cartItems = Cart::with(['product', 'cookedFood'])->where('user_id', $user->id)->get();
                
                // Clean up any cart items with null/deleted products or cooked foods
                $cartItems = $cartItems->filter(function($item) {
                    if ($item->item_type === 'cooked_food') {
                        if (!$item->cookedFood || $item->cookedFood->price === null) {
                            Log::warning('Removing cart item with null/invalid cooked food', [
                                'cart_item_id' => $item->id,
                                'cooked_food_id' => $item->cooked_food_id,
                                'has_cooked_food' => $item->cookedFood !== null
                            ]);
                            $item->delete(); // Remove invalid cart item
                            return false;
                        }
                    } else {
                        if (!$item->product || $item->product->price === null) {
                            Log::warning('Removing cart item with null/invalid product', [
                                'cart_item_id' => $item->id,
                                'product_id' => $item->product_id,
                                'has_product' => $item->product !== null
                            ]);
                            $item->delete(); // Remove invalid cart item
                            return false;
                        }
                    }
                    return true;
                });
                
                if ($cartItems->isEmpty()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your cart is empty'
                    ], 400);
                }
                
                // Calculate totals from database cart
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    if ($item->item_type === 'cooked_food') {
                        // Handle cooked food items
                        if ($item->cookedFood && $item->cookedFood->price !== null) {
                            $subtotal += $item->cookedFood->price * $item->quantity;
                        } else {
                            Log::warning('Cart item has null cooked food or price', [
                                'cart_item_id' => $item->id,
                                'cooked_food_id' => $item->cooked_food_id,
                                'has_cooked_food' => $item->cookedFood !== null,
                                'cooked_food_price' => $item->cookedFood ? $item->cookedFood->price : 'cooked_food_null'
                            ]);
                        }
                    } else {
                        // Handle regular product items
                        if ($item->product && $item->product->price !== null) {
                            $subtotal += $item->product->price * $item->quantity;
                        } else {
                            Log::warning('Cart item has null product or price', [
                                'cart_item_id' => $item->id,
                                'product_id' => $item->product_id,
                                'has_product' => $item->product !== null,
                                'product_price' => $item->product ? $item->product->price : 'product_null'
                            ]);
                        }
                    }
                }
            } else {
                // For guests, get cart from session
                $cart = session('cart', []);
                
                if (empty($cart)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your cart is empty'
                    ], 400);
                }
                
                // Calculate totals from session cart
                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }
                
                // Convert session cart to collection for consistent handling
                $cartItems = collect();
                foreach ($cart as $productId => $item) {
                    $product = Product::find($productId);
                    if ($product) {
                        $cartItems->push((object)[
                            'product_id' => $productId,
                            'quantity' => $item['quantity'],
                            'product' => $product
                        ]);
                    }
                }
            }

            // Check for applied coupon in session
            $appliedCoupon = session('applied_coupon');
            $discountAmount = 0;
            $couponCode = null;
            
            if ($appliedCoupon && isset($appliedCoupon['code']) && isset($appliedCoupon['discount_amount'])) {
                $couponCode = $appliedCoupon['code'];
                $discountAmount = $appliedCoupon['discount_amount']; // Use discount_amount, not discount
            }

            $shipping = $subtotal >= 500 ? 0 : 50;
            $finalTotal = $subtotal + $shipping - $discountAmount;

            // Get shipping address
            $shippingAddress = Address::where('id', $request->shipping_address_id)
                                   ->where('user_id', $user->id)
                                   ->first();

            if (!$shippingAddress) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid shipping address'
                ], 400);
            }

            DB::beginTransaction();

            try {
                // Create order
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'subtotal' => $subtotal,
                    'shipping_amount' => $shipping,
                    'total_amount' => $finalTotal,
                    'coupon_code' => $couponCode,
                    'discount_amount' => $discountAmount,
                    'payment_method' => $request->payment_method === 'cod' ? 'cash_on_delivery' : 'online_payment',
                    'payment_status' => 'pending',
                    'status' => 'pending',
                    'shipping_address' => $shippingAddress->full_address,
                    'phone' => $shippingAddress->phone,
                    'email' => $user->email,
                    'order_notes' => $request->order_notes
                ]);

                // Create order items
                foreach ($cartItems as $cartItem) {
                    if ($cartItem->item_type === 'cooked_food') {
                        // Handle cooked food items
                        if ($cartItem->cookedFood && $cartItem->cookedFood->price !== null) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'cooked_food_id' => $cartItem->cooked_food_id,
                                'item_type' => 'cooked_food',
                                'quantity' => $cartItem->quantity,
                                'price' => $cartItem->cookedFood->price,
                                'total' => $cartItem->cookedFood->price * $cartItem->quantity
                            ]);
                        } else {
                            // Log the problematic cart item and skip it
                            Log::warning('Skipping cart item with null cooked food in order creation', [
                                'cart_item_id' => $cartItem->id,
                                'cooked_food_id' => $cartItem->cooked_food_id,
                                'has_cooked_food' => $cartItem->cookedFood !== null
                            ]);
                        }
                    } else {
                        // Handle regular product items
                        if ($cartItem->product && $cartItem->product->price !== null) {
                            OrderItem::create([
                                'order_id' => $order->id,
                                'product_id' => $cartItem->product_id,
                                'item_type' => 'product',
                                'quantity' => $cartItem->quantity,
                                'price' => $cartItem->product->price,
                                'total' => $cartItem->product->price * $cartItem->quantity
                            ]);
                        } else {
                            // Log the problematic cart item and skip it
                            Log::warning('Skipping cart item with null product in order creation', [
                                'cart_item_id' => $cartItem->id,
                                'product_id' => $cartItem->product_id,
                                'has_product' => $cartItem->product !== null
                            ]);
                        }
                    }
                }

                // Clear cart after successful order
                if (Auth::check()) {
                    // Clear database cart for authenticated users
                    Cart::where('user_id', $user->id)->delete();
                    
                    // Also clear session cart to ensure consistency
                    session()->forget('cart');
                } else {
                    // Clear session cart for guests
                    session()->forget('cart');
                }

                // Clear applied coupon from session
                session()->forget('applied_coupon');

                DB::commit();

                // Handle payment method
                if ($request->payment_method === 'online') {
                    // For now, redirect to a payment gateway simulation
                    return response()->json([
                        'success' => true,
                        'message' => 'Order placed successfully!',
                        'order_id' => $order->id,
                        'redirect_url' => route('orders.payment', $order->id)
                    ]);
                } else {
                    // Cash on delivery - redirect to confirmation
                    return response()->json([
                        'success' => true,
                        'message' => 'Order placed successfully!',
                        'order_id' => $order->id,
                        'redirect_url' => route('orders.confirmation', $order->id)
                    ]);
                }

            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Order creation failed: ' . $e->getMessage());
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Order store error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }

    public function confirmation(Order $order)
    {
        // Check if the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(404, 'Order not found');
        }

        // Load the relationships if not already loaded
        $order->load(['orderItems.product', 'orderItems.cookedFood']);

        return view('frontend.orders.confirmation', compact('order'));
    }

    public function payment($orderId)
    {
        $order = Order::where('id', $orderId)
                     ->where('user_id', Auth::id())
                     ->where('payment_method', 'online')
                     ->where('payment_status', 'pending')
                     ->first();

        if (!$order) {
            return redirect()->route('orders.confirmation', $orderId);
        }

        // Simulate payment processing
        return view('frontend.orders.payment', compact('order'));
    }

    public function processPayment(Request $request, $orderId)
    {
        $order = Order::where('id', $orderId)
                     ->where('user_id', Auth::id())
                     ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }

        // Simulate payment processing
        $paymentSuccess = true; // In real implementation, this would come from payment gateway

        if ($paymentSuccess) {
            $order->update([
                'payment_status' => 'completed',
                'payment_id' => 'PAY-' . strtoupper(uniqid())
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'redirect_url' => route('orders.confirmation', $order->id)
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Please try again.'
            ]);
        }
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with(['orderItems.product', 'orderItems.cookedFood'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::with(['orderItems.product', 'orderItems.cookedFood'])
                     ->where('id', $orderId)
                     ->where('user_id', Auth::id())
                     ->first();

        if (!$order) {
            abort(404, 'Order not found');
        }

        return view('frontend.orders.show', compact('order'));
    }
}

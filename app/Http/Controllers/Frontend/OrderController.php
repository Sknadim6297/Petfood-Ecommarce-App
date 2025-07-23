<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CookedFood;
use App\Models\Address;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
        
        // Verify the shipping address belongs to the current user
        $shippingAddressExists = \App\Models\Address::where('id', $request->shipping_address_id)
                                                   ->where('user_id', $user->id)
                                                   ->exists();
        
        if (!$shippingAddressExists) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid shipping address selected'
            ], 400);
        }
        
        // Debug: Log current user and cart check
        Log::info('Order placement attempt', [
            'user_id' => $user->id,
            'request_data' => $request->all()
        ]);
        
        // Get cart items using the same logic as CartController
        $cart = $this->getCartItems($user->id);
        
        // Debug: Log cart items with more detail
        Log::info('Order placement - Cart retrieval details', [
            'user_id' => $user->id,
            'cart_count' => count($cart),
            'cart_items' => $cart,
            'cart_structure' => array_map(function($item) {
                return [
                    'has_price' => isset($item['price']),
                    'price_value' => $item['price'] ?? 'NULL',
                    'has_quantity' => isset($item['quantity']),
                    'quantity_value' => $item['quantity'] ?? 'NULL'
                ];
            }, $cart)
        ]);
        
        if (empty($cart)) {
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
            foreach ($cart as $itemKey => $item) {
                Log::info('Processing cart item for subtotal', [
                    'item_key' => $itemKey,
                    'item_data' => $item,
                    'has_price' => isset($item['price']),
                    'price_value' => $item['price'] ?? 'NULL',
                    'has_quantity' => isset($item['quantity']),
                    'quantity_value' => $item['quantity'] ?? 'NULL'
                ]);
                
                if (!isset($item['price']) || !isset($item['quantity'])) {
                    Log::error('Missing price or quantity in cart item', [
                        'item_key' => $itemKey,
                        'item' => $item
                    ]);
                    throw new \Exception('Invalid cart item: missing price or quantity');
                }
                
                // Ensure price and quantity are valid numbers
                $price = is_numeric($item['price']) ? (float) $item['price'] : 0;
                $quantity = is_numeric($item['quantity']) ? (int) $item['quantity'] : 0;
                
                if ($price <= 0 || $quantity <= 0) {
                    Log::error('Invalid price or quantity in cart item', [
                        'item_key' => $itemKey,
                        'price' => $price,
                        'quantity' => $quantity
                    ]);
                    throw new \Exception('Invalid cart item: price or quantity must be greater than 0');
                }
                
                $itemTotal = $price * $quantity;
                
                Log::info('Cart item calculation', [
                    'item_key' => $itemKey,
                    'price' => $price,
                    'quantity' => $quantity,
                    'item_total' => $itemTotal
                ]);
                
                $subtotal += $itemTotal;
            }
            
            $shippingAmount = $subtotal >= 500 ? 0 : 50;
            
            // Handle coupon discount
            $discountAmount = 0;
            $couponCode = null;
            
            try {
                $couponService = app(CouponService::class);
                
                if ($couponService->hasCoupon()) {
                    $appliedCoupon = $couponService->getAppliedCoupon();
                    
                    // Validate coupon before finalizing order
                    $validation = $couponService->validateAppliedCoupon($subtotal);
                    if ($validation['valid']) {
                        $discountAmount = $couponService->getDiscountAmount($subtotal);
                        $couponCode = $appliedCoupon['code'];
                        
                        // Log coupon usage
                        Log::info('Coupon applied to order', [
                            'user_id' => $user->id,
                            'coupon_code' => $couponCode,
                            'discount_amount' => $discountAmount,
                            'subtotal' => $subtotal
                        ]);
                    } else {
                        // Coupon is no longer valid, but proceed without it
                        Log::warning('Coupon validation failed during checkout', [
                            'user_id' => $user->id,
                            'message' => $validation['message']
                        ]);
                    }
                }
            } catch (\Exception $couponException) {
                // If coupon service fails, log the error but continue without discount
                Log::error('Coupon service error during checkout', [
                    'user_id' => $user->id,
                    'error' => $couponException->getMessage()
                ]);
                $discountAmount = 0;
                $couponCode = null;
            }
            
            $totalAmount = $subtotal + $shippingAmount - $discountAmount;

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
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'coupon_code' => $couponCode,
                'shipping_address' => $shippingAddress->full_address,
                'phone' => $shippingAddress->phone,
                'email' => $user->email,
                'order_notes' => $request->order_notes
            ]);

            // Create order items
            foreach ($cart as $itemKey => $item) {
                // Ensure we have valid price and quantity
                $price = is_numeric($item['price']) ? (float) $item['price'] : 0;
                $quantity = is_numeric($item['quantity']) ? (int) $item['quantity'] : 0;
                $total = $price * $quantity;
                
                // Skip items with invalid data
                if ($price <= 0 || $quantity <= 0) {
                    Log::warning('Skipping order item due to invalid price or quantity', [
                        'item_key' => $itemKey,
                        'price' => $price,
                        'quantity' => $quantity
                    ]);
                    continue;
                }
                
                // Get the appropriate item and price based on type
                if ($item['item_type'] === 'cooked_food') {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'cooked_food_id' => $item['id'],
                        'item_type' => 'cooked_food',
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total
                    ]);
                } else {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'item_type' => 'product',
                        'quantity' => $quantity,
                        'price' => $price,
                        'total' => $total
                    ]);
                }
            }

            // Clear cart
            Cart::where('user_id', $user->id)->delete();
            Session::forget('cart');
            
            // Mark coupon as used if one was applied
            if ($couponCode) {
                try {
                    $couponService = app(CouponService::class);
                    if ($couponService->hasCoupon()) {
                        $couponService->markCouponAsUsed();
                    }
                } catch (\Exception $couponException) {
                    // Log error but don't fail the order
                    Log::error('Failed to mark coupon as used', [
                        'user_id' => $user->id,
                        'coupon_code' => $couponCode,
                        'error' => $couponException->getMessage()
                    ]);
                }
            }

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
                    'payment_url' => route('orders.payment', $order->id),
                    'redirect_url' => route('orders.confirmation', $order->id)
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully! You will pay on delivery.',
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'redirect_url' => route('orders.confirmation', $order->id)
                ]);
            }

        } catch (\Exception $e) {
            DB::rollback();
            
            // More detailed error logging
            Log::error('Order placement failed', [
                'user_id' => $user->id,
                'error_message' => $e->getMessage(),
                'error_file' => $e->getFile(),
                'error_line' => $e->getLine(),
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'cart_data' => $cart ?? 'not_set'
            ]);
            
            // Return a more helpful error message
            $errorMessage = 'Error placing order. Please try again.';
            if (app()->environment('local')) {
                $errorMessage .= ' Debug: ' . $e->getMessage();
            }
            
            return response()->json([
                'success' => false,
                'message' => $errorMessage
            ], 500);
        }
    }

    /**
     * Show order confirmation
     */
    public function confirmation($orderId)
    {
        $order = Order::with(['orderItems.product', 'orderItems.cookedFood', 'user'])
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
                      ->with(['orderItems.product', 'orderItems.cookedFood'])
                      ->latest()
                      ->paginate(10);

        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show($orderId)
    {
        $order = Order::with(['orderItems.product', 'orderItems.cookedFood'])
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

    /**
     * Get cart items for authenticated user
     */
    private function getCartItems($userId)
    {
        // Check database first
        $dbCartItems = Cart::where('user_id', $userId)
                          ->with(['product', 'cookedFood'])
                          ->get();

        Log::info('Database cart items retrieved', [
            'user_id' => $userId,
            'db_cart_count' => $dbCartItems->count(),
            'db_cart_items' => $dbCartItems->toArray()
        ]);

        $cart = [];
        
        if ($dbCartItems->isNotEmpty()) {
            // Convert database cart to consistent format
            foreach ($dbCartItems as $item) {
                Log::info('Processing database cart item', [
                    'item_type' => $item->item_type,
                    'product_id' => $item->product_id,
                    'cooked_food_id' => $item->cooked_food_id,
                    'has_product' => $item->product !== null,
                    'has_cooked_food' => $item->cookedFood !== null
                ]);
                
                if ($item->item_type === 'cooked_food' && $item->cookedFood) {
                    // Ensure price is not null
                    $price = $item->cookedFood->price ?? 0;
                    
                    $cartItem = [
                        'id' => $item->cooked_food_id,
                        'name' => $item->cookedFood->name ?? 'Unknown Item',
                        'image' => $item->cookedFood->image,
                        'price' => (float) $price,
                        'quantity' => (int) $item->quantity,
                        'item_type' => 'cooked_food',
                        'category' => 'Cooked Food'
                    ];
                    $cart["cooked_food_{$item->cooked_food_id}"] = $cartItem;
                    
                    Log::info('Added cooked food to cart', [
                        'item' => $cartItem
                    ]);
                } elseif ($item->item_type === 'product' && $item->product) {
                    // Ensure effective_price is not null
                    $effectivePrice = $item->product->effective_price ?? $item->product->price ?? 0;
                    
                    $cartItem = [
                        'id' => $item->product_id,
                        'name' => $item->product->name ?? 'Unknown Product',
                        'image' => $item->product->image,
                        'price' => (float) $effectivePrice,
                        'quantity' => (int) $item->quantity,
                        'item_type' => 'product',
                        'category' => $item->product->category ? $item->product->category->name : 'Pet Product'
                    ];
                    $cart["product_{$item->product_id}"] = $cartItem;
                    
                    Log::info('Added product to cart', [
                        'item' => $cartItem
                    ]);
                } else {
                    Log::warning('Skipping cart item due to missing relationship', [
                        'item_type' => $item->item_type,
                        'product_id' => $item->product_id,
                        'cooked_food_id' => $item->cooked_food_id,
                        'has_product' => $item->product !== null,
                        'has_cooked_food' => $item->cookedFood !== null
                    ]);
                }
            }
        } else {
            // Fallback to session cart
            $cart = Session::get('cart', []);
            Log::info('Using session cart', [
                'session_cart' => $cart
            ]);
        }

        Log::info('Final cart structure for order', [
            'cart' => $cart
        ]);

        return $cart;
    }
}

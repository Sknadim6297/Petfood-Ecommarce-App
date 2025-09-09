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
        $cart = $this->getCart();

        // Debug: Log cart items with more detail
        Log::info('Order placement - Cart retrieval details', [
            'user_id' => $user->id,
            'cart_count' => count($cart),
            'cart_items' => $cart,
            'cart_structure' => array_map(function ($item) {
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
            // Calculate totals using fresh data from database (same logic as CartController)
            $subtotal = 0;
            foreach ($cart as $itemKey => $item) {
                Log::info('Processing cart item for subtotal', [
                    'item_key' => $itemKey,
                    'item_data' => $item,
                    'item_type' => $item['item_type'] ?? 'product'
                ]);

                if (!isset($item['quantity'])) {
                    Log::error('Missing quantity in cart item', [
                        'item_key' => $itemKey,
                        'item' => $item
                    ]);
                    throw new \Exception('Invalid cart item: missing quantity');
                }

                $quantity = is_numeric($item['quantity']) ? (int) $item['quantity'] : 0;

                if ($quantity <= 0) {
                    Log::error('Invalid quantity in cart item', [
                        'item_key' => $itemKey,
                        'quantity' => $quantity
                    ]);
                    throw new \Exception('Invalid cart item: quantity must be greater than 0');
                }

                // Get fresh price from database (same logic as CartController)
                $price = 0;
                if (($item['item_type'] ?? 'product') === 'cooked_food') {
                    $cookedFood = \App\Models\CookedFood::find($item['id']);
                    if ($cookedFood) {
                        $price = (float) $cookedFood->price;
                    } else {
                        throw new \Exception('Cooked food not found: ' . $item['id']);
                    }
                } else {
                    $product = \App\Models\Product::find($item['id']);
                    if ($product) {
                        $price = (float) $product->effective_price; // Use effective_price like CartController
                    } else {
                        throw new \Exception('Product not found: ' . $item['id']);
                    }
                }

                if ($price <= 0) {
                    Log::error('Invalid price for item', [
                        'item_key' => $itemKey,
                        'item_id' => $item['id'],
                        'item_type' => $item['item_type'] ?? 'product',
                        'price' => $price
                    ]);
                    throw new \Exception('Invalid item: price must be greater than 0');
                }

                $itemTotal = $price * $quantity;

                Log::info('Cart item calculation', [
                    'item_key' => $itemKey,
                    'item_id' => $item['id'],
                    'item_type' => $item['item_type'] ?? 'product',
                    'fresh_price' => $price,
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

            // Create order items with fresh prices from database
            foreach ($cart as $itemKey => $item) {
                $quantity = is_numeric($item['quantity']) ? (int) $item['quantity'] : 0;

                // Skip items with invalid quantity
                if ($quantity <= 0) {
                    Log::warning('Skipping order item due to invalid quantity', [
                        'item_key' => $itemKey,
                        'quantity' => $quantity
                    ]);
                    continue;
                }

                // Get fresh price from database (same logic as subtotal calculation)
                $price = 0;
                $itemData = null;

                if (($item['item_type'] ?? 'product') === 'cooked_food') {
                    $itemData = \App\Models\CookedFood::find($item['id']);
                    if ($itemData) {
                        $price = (float) $itemData->price;
                    }
                } else {
                    $itemData = \App\Models\Product::find($item['id']);
                    if ($itemData) {
                        $price = (float) $itemData->effective_price; // Use effective_price
                    }
                }

                if (!$itemData || $price <= 0) {
                    Log::warning('Skipping order item due to invalid item or price', [
                        'item_key' => $itemKey,
                        'item_id' => $item['id'],
                        'item_type' => $item['item_type'] ?? 'product',
                        'price' => $price,
                        'item_found' => !!$itemData
                    ]);
                    continue;
                }

                $total = $price * $quantity;

                // Create order item based on type
                if (($item['item_type'] ?? 'product') === 'cooked_food') {
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
        $order = Order::with([
            'orderItems.product.category',
            'orderItems.product.subcategory',
            'orderItems.cookedFood',
            'user'
        ])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.orders.confirmation', compact('order'));
    }

    /**
     * Show user orders
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderItems.product.category', 'orderItems.product.subcategory', 'orderItems.cookedFood'])
            ->latest()
            ->paginate(10);

        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Show single order
     */
    public function show($orderId)
    {
        $order = Order::with(['orderItems.product.category', 'orderItems.product.subcategory', 'orderItems.cookedFood'])
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('frontend.orders.show', compact('order'));
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
     * Get cart items - use session for coupon compatibility
     * (Same logic as CartController)
     */
    private function getCart()
    {
        // Always use session cart for consistency with coupon system
        $sessionCart = Session::get('cart', []);

        // If authenticated user has empty session cart, try to load from database
        if (Auth::check() && empty($sessionCart)) {
            $this->loadDatabaseCartToSession();
            $sessionCart = Session::get('cart', []);
        }

        return $sessionCart;
    }

    /**
     * Load database cart to session for authenticated users
     * (Same logic as CartController)
     */
    private function loadDatabaseCartToSession()
    {
        if (!Auth::check()) {
            return;
        }

        $cartItems = Cart::with(['product.category', 'cookedFood'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return;
        }

        $sessionCart = [];
        foreach ($cartItems as $item) {
            if ($item->item_type === 'cooked_food' && $item->cookedFood) {
                $sessionCart["cooked_food_{$item->cooked_food_id}"] = [
                    'id' => $item->cooked_food_id,
                    'name' => $item->cookedFood->name,
                    'image' => $item->cookedFood->image,
                    'price' => (float) $item->cookedFood->price,
                    'quantity' => $item->quantity,
                    'item_type' => 'cooked_food',
                    'category' => 'Cooked Food'
                ];
            } elseif ($item->item_type === 'product' && $item->product) {
                $effectivePrice = $item->product->effective_price ?? $item->product->price;
                $sessionCart["product_{$item->product_id}"] = [
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'image' => $item->product->image,
                    'price' => (float) $effectivePrice,
                    'quantity' => $item->quantity,
                    'item_type' => 'product',
                    'category' => $item->product->category ? $item->product->category->name : 'Pet Product'
                ];
            }
        }

        Session::put('cart', $sessionCart);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CouponService;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    /**
     * Apply coupon to cart
     */
    public function apply(Request $request)
    {
        try {
            $request->validate([
                'coupon_code' => 'required|string|max:50'
            ]);

            // Calculate cart total
            $cartTotal = $this->getCartTotal();

            Log::info('Coupon application attempt', [
                'coupon_code' => $request->coupon_code,
                'cart_total' => $cartTotal,
                'user_id' => Auth::id(),
                'user_authenticated' => Auth::check()
            ]);

            if ($cartTotal == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty. Add items to apply coupon.'
                ]);
            }

            $result = $this->couponService->applyCoupon($request->coupon_code, $cartTotal);

            if ($result['success']) {
                $finalTotal = $this->couponService->getFinalTotal($cartTotal);
                
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'coupon' => [
                        'code' => $result['coupon']->code,
                        'discount_type' => $result['coupon']->discount_type,
                        'discount' => $result['coupon']->discount,
                        'discount_amount' => $result['discount_amount']
                    ],
                    'cart_totals' => [
                        'subtotal' => $cartTotal,
                        'discount' => $result['discount_amount'],
                        'final_total' => $finalTotal
                    ]
                ]);
            }

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error('Coupon application error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while applying the coupon. Please try again.'
            ], 500);
        }
    }

    /**
     * Remove applied coupon
     */
    public function remove()
    {
        $result = $this->couponService->removeCoupon();
        $cartTotal = $this->getCartTotal();

        return response()->json([
            'success' => true,
            'message' => $result['message'],
            'cart_totals' => [
                'subtotal' => $cartTotal,
                'discount' => 0,
                'final_total' => $cartTotal
            ]
        ]);
    }

    /**
     * Get available coupons
     */
    public function available()
    {
        $coupons = $this->couponService->getAvailableCoupons();
        
        return response()->json([
            'success' => true,
            'coupons' => $coupons->map(function($coupon) {
                return [
                    'code' => $coupon->code,
                    'discount_type' => $coupon->discount_type,
                    'discount' => $coupon->discount,
                    'discount_amount' => $coupon->discount_amount,
                    'min_order_amount' => $coupon->min_order_amount,
                    'description' => $coupon->description,
                    'end_date' => $coupon->formatted_end_date
                ];
            })
        ]);
    }

    /**
     * Check coupon validity
     */
    public function check(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string|max:50'
        ]);

        $cartTotal = $this->getCartTotal();
        $result = $this->couponService->applyCoupon($request->coupon_code, $cartTotal);

        // Remove the coupon after checking (just for validation)
        if ($result['success']) {
            $this->couponService->removeCoupon();
        }

        return response()->json([
            'valid' => $result['success'],
            'message' => $result['message'] ?? 'Coupon checked successfully',
            'discount_amount' => $result['discount_amount'] ?? 0
        ]);
    }

    /**
     * Get current cart total
     */
    private function getCartTotal()
    {
        if (Auth::check()) {
            // For authenticated users, get cart from database
            $cartItems = \App\Models\Cart::with(['product', 'cookedFood'])
                ->where('user_id', Auth::id())
                ->get();
            
            $total = 0;
            foreach ($cartItems as $item) {
                if ($item->item_type === 'cooked_food' && $item->cookedFood) {
                    $total += $item->cookedFood->price * $item->quantity;
                } elseif ($item->item_type === 'product' && $item->product) {
                    $total += $item->product->effective_price * $item->quantity;
                }
            }
            return $total;
        } else {
            // For guests, use session cart
            $cart = session('cart', []);
            
            if (empty($cart) || !is_array($cart)) {
                return 0;
            }
            
            $total = 0;
            foreach ($cart as $item) {
                if (isset($item['price']) && isset($item['quantity'])) {
                    $total += (float)$item['price'] * (int)$item['quantity'];
                }
            }
            
            return $total;
        }
    }
}

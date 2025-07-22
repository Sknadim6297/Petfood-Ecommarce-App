<?php

namespace App\Services;

use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CouponService
{
    /**
     * Apply a coupon to the cart
     */
    public function applyCoupon($code, $cartTotal)
    {
        // Remove any existing coupon first
        $this->removeCoupon();

        $coupon = Coupon::where('code', strtoupper($code))->first();

        if (!$coupon) {
            return [
                'success' => false,
                'message' => 'Invalid coupon code.'
            ];
        }

        if (!$coupon->canBeUsed($cartTotal)) {
            if ($coupon->status !== 'active') {
                return [
                    'success' => false,
                    'message' => 'This coupon is not active.'
                ];
            }

            if ($coupon->start_date > now()) {
                return [
                    'success' => false,
                    'message' => 'This coupon is not yet valid.'
                ];
            }

            if ($coupon->end_date < now()) {
                return [
                    'success' => false,
                    'message' => 'This coupon has expired.'
                ];
            }

            if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) {
                return [
                    'success' => false,
                    'message' => 'This coupon has reached its usage limit.'
                ];
            }

            if ($cartTotal < $coupon->min_order_amount) {
                return [
                    'success' => false,
                    'message' => 'Minimum order amount of ₹' . number_format($coupon->min_order_amount, 2) . ' required to use this coupon.'
                ];
            }
        }

        $discountAmount = $coupon->calculateDiscount($cartTotal);

        // Store coupon in session
        Session::put('applied_coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount_type' => $coupon->discount_type,
            'discount' => $coupon->discount,
            'discount_amount' => $discountAmount,
            'min_order_amount' => $coupon->min_order_amount
        ]);

        return [
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'coupon' => $coupon,
            'discount_amount' => $discountAmount
        ];
    }

    /**
     * Remove applied coupon
     */
    public function removeCoupon()
    {
        Session::forget('applied_coupon');
        
        return [
            'success' => true,
            'message' => 'Coupon removed successfully!'
        ];
    }

    /**
     * Get applied coupon from session
     */
    public function getAppliedCoupon()
    {
        return Session::get('applied_coupon');
    }

    /**
     * Check if a coupon is applied
     */
    public function hasCoupon()
    {
        return Session::has('applied_coupon');
    }

    /**
     * Get discount amount for current applied coupon
     */
    public function getDiscountAmount($cartTotal = 0)
    {
        if (!$this->hasCoupon()) {
            return 0;
        }

        $appliedCoupon = $this->getAppliedCoupon();
        
        if ($appliedCoupon['discount_type'] === 'percentage') {
            return ($cartTotal * $appliedCoupon['discount']) / 100;
        }

        return $appliedCoupon['discount'];
    }

    /**
     * Get final total after applying coupon
     */
    public function getFinalTotal($cartTotal)
    {
        $discountAmount = $this->getDiscountAmount($cartTotal);
        return max(0, $cartTotal - $discountAmount);
    }

    /**
     * Validate applied coupon before checkout
     */
    public function validateAppliedCoupon($cartTotal)
    {
        if (!$this->hasCoupon()) {
            return ['valid' => true];
        }

        $appliedCoupon = $this->getAppliedCoupon();
        $coupon = Coupon::find($appliedCoupon['id']);

        if (!$coupon) {
            $this->removeCoupon();
            return [
                'valid' => false,
                'message' => 'Applied coupon is no longer valid.'
            ];
        }

        if (!$coupon->canBeUsed($cartTotal)) {
            $this->removeCoupon();
            return [
                'valid' => false,
                'message' => 'Applied coupon is no longer valid for this order.'
            ];
        }

        return ['valid' => true];
    }

    /**
     * Mark coupon as used (call this after successful order)
     */
    public function markCouponAsUsed()
    {
        if (!$this->hasCoupon()) {
            return;
        }

        $appliedCoupon = $this->getAppliedCoupon();
        $coupon = Coupon::find($appliedCoupon['id']);

        if ($coupon) {
            $coupon->incrementUsage();
        }

        $this->removeCoupon();
    }

    /**
     * Get available coupons for display
     */
    public function getAvailableCoupons($limit = 10)
    {
        return Coupon::valid()
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}

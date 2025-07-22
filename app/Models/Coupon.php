<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount',
        'min_order_amount',
        'start_date',
        'end_date',
        'status',
        'usage_limit',
        'used_count',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'discount' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeValid($query)
    {
        return $query->where('status', 'active')
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    // Accessors
    public function getIsValidAttribute()
    {
        return $this->status === 'active' && 
               $this->start_date <= now() && 
               $this->end_date >= now() &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function getDiscountAmountAttribute()
    {
        if ($this->discount_type === 'percentage') {
            return $this->discount . '%';
        }
        return '₹' . number_format($this->discount, 2);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'active' => '<span class="badge bg-success">Active</span>',
            'inactive' => '<span class="badge bg-danger">Inactive</span>',
        ];

        return $badges[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('M d, Y') : '';
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('M d, Y') : '';
    }

    // Methods
    public function canBeUsed($orderAmount = 0)
    {
        if (!$this->is_valid) {
            return false;
        }

        if ($orderAmount < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount($orderAmount)
    {
        if (!$this->canBeUsed($orderAmount)) {
            return 0;
        }

        if ($this->discount_type === 'percentage') {
            return ($orderAmount * $this->discount) / 100;
        }

        return $this->discount;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
    }
}

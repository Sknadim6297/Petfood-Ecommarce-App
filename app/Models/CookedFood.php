<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CookedFood extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'cooked_foods';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'price',
        'image',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cookedFood) {
            if (empty($cookedFood->slug)) {
                $cookedFood->slug = Str::slug($cookedFood->name);
            }
        });

        static::updating(function ($cookedFood) {
            if ($cookedFood->isDirty('name') && empty($cookedFood->slug)) {
                $cookedFood->slug = Str::slug($cookedFood->name);
            }
        });
    }

    /**
     * Scope for active cooked foods
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive cooked foods
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope for specific category
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price, 2);
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('assets/img/food-placeholder.jpg');
    }

    /**
     * Get category label
     */
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'fish' => 'Fish',
            'chicken' => 'Chicken',
            'meat' => 'Meat',
            'egg' => 'Egg',
            'other' => 'Other'
        ];

        return $categories[$this->category] ?? 'Other';
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->status === 'active' ? 'badge-success' : 'badge-secondary';
    }

    /**
     * Available categories
     */
    public static function getCategories()
    {
        return [
            'fish' => 'Fish',
            'chicken' => 'Chicken', 
            'meat' => 'Meat',
            'egg' => 'Egg',
            'other' => 'Other'
        ];
    }

    /**
     * Available statuses
     */
    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ];
    }
}

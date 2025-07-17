<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'sku',
        'stock_quantity',
        'image',
        'gallery',
        'category_id',
        'is_featured',
        'is_active',
        'is_healthy',
        'is_deal_of_week',
        'rating',
        'reviews_count',
        'sort_order'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'is_healthy' => 'boolean',
        'is_deal_of_week' => 'boolean',
    ];

    // Automatically generate slug from name
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Get the effective price (sale price if available, otherwise regular price)
    public function getEffectivePriceAttribute()
    {
        return $this->sale_price ?? $this->price;
    }

    // Check if product is on sale
    public function getIsOnSaleAttribute()
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    // Get discount percentage
    public function getDiscountPercentageAttribute()
    {
        if (!$this->is_on_sale) {
            return 0;
        }
        
        return round((($this->price - $this->sale_price) / $this->price) * 100);
    }

    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for featured products
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for in stock products
    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Scope for healthy products
    public function scopeHealthy($query)
    {
        return $query->where('is_healthy', true);
    }

    // Scope for deal of the week
    public function scopeDealOfWeek($query)
    {
        return $query->where('is_deal_of_week', true);
    }
}

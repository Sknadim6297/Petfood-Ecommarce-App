<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'cooked_food_id',
        'item_type',
        'quantity'
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product for the cart item
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the cooked food for the cart item
     */
    public function cookedFood()
    {
        return $this->belongsTo(CookedFood::class);
    }

    /**
     * Get the item (either product or cooked food)
     */
    public function getItemAttribute()
    {
        return $this->item_type === 'cooked_food' ? $this->cookedFood : $this->product;
    }

    /**
     * Get the item name
     */
    public function getItemNameAttribute()
    {
        $item = $this->item;
        return $item ? $item->name : 'Unknown Item';
    }

    /**
     * Get the item price
     */
    public function getItemPriceAttribute()
    {
        $item = $this->item;
        if (!$item) return 0;
        
        if ($this->item_type === 'cooked_food') {
            return $item->price;
        } else {
            return $item->effective_price;
        }
    }

    /**
     * Get the item image URL
     */
    public function getItemImageAttribute()
    {
        $item = $this->item;
        if (!$item) return null;
        
        if ($this->item_type === 'cooked_food') {
            return $item->image_url;
        } else {
            return $item->image_url;
        }
    }

    /**
     * Get the total price for this cart item
     */
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->item_price;
    }

    /**
     * Scope to get cart items for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'cooked_food_id',
        'item_type',
        'quantity',
        'price',
        'total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

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
}

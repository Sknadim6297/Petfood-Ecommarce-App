<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    /**
     * Get the user's wishlist items
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    /**
     * Get the products in the user's wishlist
     */
    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class, 'wishlists')->withTimestamps();
    }
    
    /**
     * Check if user has a product in their wishlist
     */
    public function hasInWishlist($productId)
    {
        return $this->wishlists()->where('product_id', $productId)->exists();
    }
    
    /**
     * Get the user's addresses
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Get the user's orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the user's cart items
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    
    /**
     * Get the products in the user's cart
     */
    public function cartProducts()
    {
        return $this->belongsToMany(Product::class, 'carts')->withPivot('quantity')->withTimestamps();
    }
    
    /**
     * Check if user has a product in their cart
     */
    public function hasInCart($productId)
    {
        return $this->carts()->where('product_id', $productId)->exists();
    }
}

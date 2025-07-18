<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;

class HeaderComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $cartCount = 0;
        $wishlistCount = 0;

        if (Auth::check()) {
            // For authenticated users, get counts from database
            $cartCount = Cart::where('user_id', Auth::id())->sum('quantity');
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            // For guests, get cart count from session
            $cart = Session::get('cart', []);
            $cartCount = array_sum(array_column($cart, 'quantity'));
        }

        $view->with([
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount
        ]);
    }
}

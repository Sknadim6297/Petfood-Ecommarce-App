<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Get cart items for authenticated user (database) or session (guest)
     */
    private function getCart()
    {
        if (Auth::check()) {
            // For authenticated users, get cart from database
            $cartItems = Cart::with('product.category')
                ->where('user_id', Auth::id())
                ->get();
            
            $cart = [];
            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'slug' => $item->product->slug,
                    'price' => $item->product->effective_price, // Use consistent price field
                    'original_price' => $item->product->price,
                    'image' => $item->product->image,
                    'quantity' => $item->quantity,
                    'category' => $item->product->category->name ?? 'Pet Product'
                ];
            }
            return $cart;
        } else {
            // For guests, use session
            return Session::get('cart', []);
        }
    }

    /**
     * Save cart (database for auth users, session for guests)
     */
    private function saveCart($cart)
    {
        if (Auth::check()) {
            // For authenticated users, save to database
            $userId = Auth::id();
            
            // Clear existing cart items for user
            Cart::where('user_id', $userId)->delete();
            
            // Add new cart items
            foreach ($cart as $productId => $item) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $item['quantity']
                ]);
            }
        } else {
            // For guests, save to session
            Session::put('cart', $cart);
        }
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart.',
                'redirect' => route('login')
            ], 401);
        }

        // Debug logging
        Log::info('Cart add request', [
            'request_data' => $request->all(),
            'product_id' => $request->product_id,
            'user_id' => Auth::id()
        ]);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is in stock
        if ($product->stock_quantity < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available. Only ' . $product->stock_quantity . ' items left.'
            ]);
        }

        $cart = $this->getCart();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if (isset($cart[$productId])) {
            // Update quantity if product already in cart
            $newQuantity = $cart[$productId]['quantity'] + $quantity;

            // Check stock again
            if ($product->stock_quantity < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Only ' . $product->stock_quantity . ' items available.'
                ]);
            }

            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            // Add new product to cart
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->effective_price,
                'original_price' => $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
                'category' => $product->category->name ?? 'Pet Product'
            ];
        }

        $this->saveCart($cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $this->getCartTotal($cart),
            'cart_html' => $this->getCartPopupHtml($cart)
        ]);
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = $this->getCart();
        $productId = $request->product_id;
        $quantity = $request->quantity;

        if ($quantity == 0) {
            // Remove item if quantity is 0
            unset($cart[$productId]);
        } else {
            $product = Product::findOrFail($productId);

            // Check stock
            if ($product->stock_quantity < $quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available.'
                ]);
            }

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            }
        }

        $this->saveCart($cart);

        // Calculate new totals efficiently
        $totals = $this->calculateCartTotals($cart);
        $newSubtotal = isset($totals['item_subtotals'][$productId]) ? 
            number_format($totals['item_subtotals'][$productId], 2) : '0.00';

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $totals['subtotal'],
            'new_total' => number_format($totals['subtotal'], 2),
            'new_subtotal' => $newSubtotal,
            'shipping' => $totals['shipping'],
            'final_total' => number_format($totals['final_total'], 2),
            'cart_html' => $this->getCartPopupHtml($cart)
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        $productId = $request->product_id;
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->saveCart($cart);
        }

        // Calculate new totals efficiently
        $totals = $this->calculateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $totals['subtotal'],
            'new_total' => number_format($totals['subtotal'], 2),
            'shipping' => $totals['shipping'],
            'final_total' => number_format($totals['final_total'], 2),
            'cart_html' => $this->getCartPopupHtml($cart)
        ]);
    }

    /**
     * Show cart page
     */
    public function index()
    {
        $cart = $this->getCart();
        $cartItems = [];
        
        // Calculate totals efficiently
        $totals = $this->calculateCartTotals($cart);
        
        // Prepare cart items with calculated subtotals
        foreach ($cart as $item) {
            $item['current_price'] = $item['price']; // Use consistent naming
            $item['subtotal'] = $totals['item_subtotals'][$item['id']];
            $cartItems[] = $item;
        }

        return view('frontend.cart.index', [
            'cartItems' => $cartItems,
            'total' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'finalTotal' => $totals['final_total']
        ]);
    }

    /**
     * Show checkout page
     */
    public function checkout()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed with checkout');
        }

        $user = Auth::user();
        $cart = $this->getCart();
        
        // Debug: Check addresses
        Log::info('User addresses count: ' . $user->addresses->count());
        Log::info('Cart items: ' . json_encode($cart));
        
        if (empty($cart)) {
            return view('frontend.cart.checkout', [
                'cartItems' => [],
                'subtotal' => 0,
                'shipping' => 0,
                'finalTotal' => 0,
                'addresses' => $user->addresses
            ]);
        }

        // Calculate totals using optimized method
        $totals = $this->calculateCartTotals($cart);
        
        // Prepare cart items for display with proper data structure
        $cartItems = [];
        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                $cartItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $item['quantity'],
                    'total' => $product->price * $item['quantity']
                ];
            }
        }

        return view('frontend.cart.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'finalTotal' => $totals['final_total'],
            'addresses' => $user->addresses
        ]);
    }

    /**
     * Get cart count for header
     */
    public function getCount()
    {
        $cart = $this->getCart();
        return response()->json([
            'count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    /**
     * Get cart popup content
     */
    public function getPopup()
    {
        $cart = $this->getCart();
        return response()->json([
            'html' => $this->getCartPopupHtml($cart),
            'count' => array_sum(array_column($cart, 'quantity')),
            'total' => $this->getCartTotal($cart)
        ]);
    }

    /**
     * Clear entire cart
     */
    public function clear(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user) {
                // Clear database cart
                Cart::where('user_id', $user->id)->delete();
            } else {
                // Clear session cart
                $request->session()->forget('cart');
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Cart cleared successfully!'
                ]);
            }
            
            return redirect()->back()->with('success', 'Cart cleared successfully!');
            
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error clearing cart: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Error clearing cart.');
        }
    }

    /**
     * Calculate cart total
     */
    /**
     * Calculate cart totals efficiently
     */
    private function calculateCartTotals($cart)
    {
        $subtotal = 0;
        $itemSubtotals = [];
        
        foreach ($cart as $productId => $item) {
            $itemSubtotal = $item['price'] * $item['quantity'];
            $subtotal += $itemSubtotal;
            $itemSubtotals[$productId] = $itemSubtotal;
        }
        
        return [
            'subtotal' => $subtotal,
            'item_subtotals' => $itemSubtotals,
            'shipping' => $subtotal >= 500 ? 0 : 50,
            'final_total' => $subtotal >= 500 ? $subtotal : $subtotal + 50
        ];
    }

    /**
     * Optimized cart total calculation
     */
    private function getCartTotal($cart)
    {
        $totals = $this->calculateCartTotals($cart);
        return $totals['subtotal'];
    }

    /**
     * Generate cart popup HTML
     */
    private function getCartPopupHtml($cart)
    {
        $html = '';
        $total = 0;

        if (empty($cart)) {
            return '<li class="text-center p-4"><p>Your cart is empty</p></li>';
        }

        foreach ($cart as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $imageUrl = $item['image'] ? asset('storage/' . $item['image']) : asset('assets/img/food-1.png');

            $html .= '
                <li class="d-flex align-items-center position-relative">
                    <div class="p-img light-bg">
                        <img src="' . $imageUrl . '" alt="' . $item['name'] . '">
                    </div>
                    <div class="p-data">
                        <h3 class="font-semi-bold">' . $item['name'] . '</h3>
                        <p class="theme-clr font-semi-bold">' . $item['quantity'] . ' x ₹' . number_format($item['price'], 2) . '</p>
                    </div>
                    <a href="javascript:void(0)" class="remove-cart-item" data-product-id="' . $item['id'] . '"></a>
                </li>';
        }

        return $html;
    }

    /**
     * Migrate session cart to database when user logs in
     */
    public function migrateSessionCartToDatabase()
    {
        if (!Auth::check()) {
            return false;
        }

        $sessionCart = Session::get('cart', []);
        if (empty($sessionCart)) {
            return false;
        }

        $userId = Auth::id();

        // Get existing database cart items
        $existingCartItems = Cart::where('user_id', $userId)->get();
        $existingProducts = $existingCartItems->pluck('quantity', 'product_id')->toArray();

        foreach ($sessionCart as $productId => $item) {
            if (isset($existingProducts[$productId])) {
                // Update quantity if product already exists in database cart
                $existingItem = $existingCartItems->where('product_id', $productId)->first();
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $item['quantity']
                ]);
            } else {
                // Add new item to database cart
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $item['quantity']
                ]);
            }
        }

        // Clear session cart
        Session::forget('cart');
        
        return true;
    }

    /**
     * Get cart count for current user
     */
    public function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = Session::get('cart', []);
            return array_sum(array_column($cart, 'quantity'));
        }
    }
}

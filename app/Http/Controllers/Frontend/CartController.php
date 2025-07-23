<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\CookedFood;
use App\Models\Cart;
use App\Services\CouponService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $couponService;

    public function __construct(CouponService $couponService = null)
    {
        $this->couponService = $couponService ?? app(CouponService::class);
    }
    /**
     * Get cart items - use session for coupon compatibility
     */
    private function getCart()
    {
        // Always use session cart for consistency with coupon system
        $sessionCart = Session::get('cart', []);
        
        // If authenticated user has empty session cart, try to load from database
        if (Auth::check() && empty($sessionCart)) {
            $this->loadDatabaseCartToSession();
            $sessionCart = Session::get('cart', []);
        }
        
        return $sessionCart;
    }
    
    /**
     * Load database cart to session for authenticated users
     */
    private function loadDatabaseCartToSession()
    {
        if (!Auth::check()) {
            return;
        }
        
        $cartItems = Cart::with(['product.category', 'cookedFood'])
            ->where('user_id', Auth::id())
            ->get();
        
        $cart = [];
        foreach ($cartItems as $item) {
            $itemData = null;
            $itemKey = null;
            
            if ($item->item_type === 'cooked_food' && $item->cookedFood) {
                $itemKey = 'cooked_food_' . $item->cooked_food_id;
                $itemData = [
                    'id' => $item->cookedFood->id,
                    'name' => $item->cookedFood->name,
                    'slug' => $item->cookedFood->slug,
                    'price' => $item->cookedFood->price,
                    'original_price' => $item->cookedFood->price,
                    'image' => $item->cookedFood->image,
                    'quantity' => $item->quantity,
                    'category' => ucfirst($item->cookedFood->category),
                    'item_type' => 'cooked_food'
                ];
            } elseif ($item->item_type === 'product' && $item->product) {
                $itemKey = 'product_' . $item->product_id;
                $itemData = [
                    'id' => $item->product->id,
                    'name' => $item->product->name,
                    'slug' => $item->product->slug,
                    'price' => $item->product->effective_price,
                    'original_price' => $item->product->price,
                    'image' => $item->product->image,
                    'quantity' => $item->quantity,
                    'category' => $item->product->category->name ?? 'Pet Product',
                    'item_type' => 'product'
                ];
            }
            
            if ($itemData) {
                $cart[$itemKey] = $itemData;
            }
        }
        
        if (!empty($cart)) {
            Session::put('cart', $cart);
        }
    }

    /**
     * Save cart to session and database
     */
    private function saveCart($cart)
    {
        // Always save to session for coupon compatibility
        Session::put('cart', $cart);
        
        // Also save to database for authenticated users
        if (Auth::check()) {
            $userId = Auth::id();
            
            // Clear existing cart items for user
            Cart::where('user_id', $userId)->delete();
            
            // Add new cart items
            foreach ($cart as $itemKey => $item) {
                $cartData = [
                    'user_id' => $userId,
                    'quantity' => $item['quantity'],
                    'item_type' => $item['item_type']
                ];
                
                if ($item['item_type'] === 'cooked_food') {
                    $cartData['cooked_food_id'] = $item['id'];
                    $cartData['product_id'] = null;
                } else {
                    $cartData['product_id'] = $item['id'];
                    $cartData['cooked_food_id'] = null;
                }
                
                Cart::create($cartData);
            }
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

        // Validate request based on item type
        $itemType = $request->input('item_type', 'product');
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity', 1);

        if ($itemType === 'cooked_food') {
            $request->validate([
                'item_id' => 'required|exists:cooked_foods,id',
                'quantity' => 'required|integer|min:1'
            ]);
            
            $item = CookedFood::findOrFail($itemId);
            $itemKey = 'cooked_food_' . $itemId;
            
            // Cooked foods don't have stock quantity, always available
            $stockAvailable = true;
            $stockQuantity = 9999;
        } else {
            $request->validate([
                'item_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);
            
            $item = Product::findOrFail($itemId);
            $itemKey = 'product_' . $itemId;
            
            // Check product stock
            $stockAvailable = $item->stock_quantity >= $quantity;
            $stockQuantity = $item->stock_quantity;
        }

        if (!$stockAvailable) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available. Only ' . $stockQuantity . ' items left.'
            ]);
        }

        $cart = $this->getCart();

        if (isset($cart[$itemKey])) {
            // Update quantity if item already in cart
            $newQuantity = $cart[$itemKey]['quantity'] + $quantity;

            // Check stock again for products
            if ($itemType === 'product' && $item->stock_quantity < $newQuantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot add more items. Only ' . $item->stock_quantity . ' items available.'
                ]);
            }

            $cart[$itemKey]['quantity'] = $newQuantity;
        } else {
            // Add new item to cart
            $cart[$itemKey] = [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'price' => $itemType === 'cooked_food' ? $item->price : $item->effective_price,
                'original_price' => $itemType === 'cooked_food' ? $item->price : $item->price,
                'image' => $item->image,
                'quantity' => $quantity,
                'category' => $itemType === 'cooked_food' ? ucfirst($item->category) : ($item->category->name ?? 'Pet Product'),
                'item_type' => $itemType
            ];
        }

        $this->saveCart($cart);

        return response()->json([
            'success' => true,
            'message' => ($itemType === 'cooked_food' ? 'Cooked food' : 'Product') . ' added to cart successfully!',
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
        // Check if user is authenticated for database operations
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to update cart items.',
                'redirect' => route('login')
            ], 401);
        }

        $itemType = $request->input('item_type', 'product');
        $itemId = $request->input('item_id') ?? $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Validate input
        if (!$itemId) {
            return response()->json([
                'success' => false,
                'message' => 'Item ID is required'
            ], 400);
        }

        // Validate based on item type
        if ($itemType === 'cooked_food') {
            $cookedFood = \App\Models\CookedFood::find($itemId);
            if (!$cookedFood) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cooked food not found'
                ], 404);
            }
            $itemKey = 'cooked_food_' . $itemId;
        } else {
            $product = \App\Models\Product::find($itemId);
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }
            $itemKey = 'product_' . $itemId;
        }

        // Validate quantity
        if (!is_numeric($quantity) || $quantity < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid quantity'
            ], 400);
        }

        $cart = $this->getCart();

        if ($quantity == 0) {
            // Remove item if quantity is 0
            unset($cart[$itemKey]);
        } else {
            if ($itemType === 'product') {
                $product = \App\Models\Product::findOrFail($itemId);
                // Check stock for products
                if ($product->stock_quantity < $quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available.'
                    ]);
                }
            }

            if (isset($cart[$itemKey])) {
                $cart[$itemKey]['quantity'] = $quantity;
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart'
                ], 404);
            }
        }

        $this->saveCart($cart);

        // Calculate new totals efficiently
        $totals = $this->calculateCartTotals($cart);
        $newSubtotal = isset($totals['item_subtotals'][$itemKey]) ? 
            number_format($totals['item_subtotals'][$itemKey], 2) : '0.00';

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $totals['subtotal'],
            'new_total' => $totals['subtotal'],
            'new_subtotal' => $newSubtotal,
            'shipping' => $totals['shipping'],
            'final_total' => $totals['final_total'],
            'cart_html' => $this->getCartPopupHtml($cart)
        ]);
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request)
    {
        // Check if user is authenticated for database operations
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to modify cart.',
                'redirect' => route('login')
            ], 401);
        }

        $itemType = $request->input('item_type', 'product');
        $itemId = $request->input('item_id') ?? $request->input('product_id');

        if (!$itemId) {
            return response()->json([
                'success' => false,
                'message' => 'Item ID is required'
            ], 400);
        }

        if ($itemType === 'cooked_food') {
            $itemKey = 'cooked_food_' . $itemId;
        } else {
            $itemKey = 'product_' . $itemId;
        }

        $cart = $this->getCart();

        $itemRemoved = false;
        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            $itemRemoved = true;
        }

        if ($itemRemoved) {
            $this->saveCart($cart);
        }

        // Calculate new totals efficiently
        $totals = $this->calculateCartTotals($cart);

        return response()->json([
            'success' => true,
            'message' => $itemRemoved ? 'Item removed from cart' : 'Item was not in cart',
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'cart_total' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'final_total' => $totals['final_total'],
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
        
        // Apply coupon discount if available
        $discountAmount = $this->couponService->getDiscountAmount($totals['subtotal']);
        
        // Calculate final total: subtotal + shipping - discount
        $finalTotal = max(0, $totals['subtotal'] + $totals['shipping'] - $discountAmount);
        
        // Prepare cart items with calculated subtotals
        foreach ($cart as $itemKey => $item) {
            $item['current_price'] = $item['price']; // Use consistent naming
            $item['subtotal'] = $totals['item_subtotals'][$itemKey];
            $cartItems[] = $item;
        }

        return view('frontend.cart.index', [
            'cartItems' => $cartItems,
            'total' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'finalTotal' => $finalTotal,
            'discountAmount' => $discountAmount,
            'appliedCoupon' => $this->couponService->getAppliedCoupon()
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
                'discount' => 0,
                'finalTotal' => 0,
                'addresses' => $user->addresses,
                'appliedCoupon' => null
            ]);
        }

        // Calculate totals using optimized method
        $totals = $this->calculateCartTotals($cart);
        
        // Get coupon information
        $couponService = app(CouponService::class);
        $appliedCoupon = $couponService->getAppliedCoupon();
        $discountAmount = 0;
        
        if ($appliedCoupon) {
            // Validate coupon before checkout
            $validation = $couponService->validateAppliedCoupon($totals['subtotal']);
            if (!$validation['valid']) {
                session()->flash('error', $validation['message']);
                $appliedCoupon = null;
            } else {
                $discountAmount = $couponService->getDiscountAmount($totals['subtotal']);
            }
        }
        
        // Recalculate final total with discount
        $finalTotal = $totals['subtotal'] + $totals['shipping'] - $discountAmount;
        
        // Prepare cart items for display with proper data structure
        $cartItems = [];
        foreach ($cart as $itemKey => $item) {
            // Handle both product and cooked food items
            $cartItem = [
                'id' => $item['id'],
                'name' => $item['name'],
                'image' => $item['image'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
                'item_type' => $item['item_type'] ?? 'product',
                'category' => $item['category'] ?? 'Pet Product'
            ];
            
            $cartItems[] = $cartItem;
        }

        return view('frontend.cart.checkout', [
            'cartItems' => $cartItems,
            'subtotal' => $totals['subtotal'],
            'shipping' => $totals['shipping'],
            'discount' => $discountAmount,
            'finalTotal' => $finalTotal,
            'addresses' => $user->addresses,
            'appliedCoupon' => $appliedCoupon
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
        
        foreach ($cart as $itemKey => $item) {
            // Ensure required keys exist with safe defaults
            $price = isset($item['price']) ? (float)$item['price'] : 0;
            $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 0;
            
            $itemSubtotal = $price * $quantity;
            $subtotal += $itemSubtotal;
            $itemSubtotals[$itemKey] = $itemSubtotal;
        }
        
        $shipping = $subtotal >= 500 ? 0 : 50;
        $finalTotal = $subtotal + $shipping;
        
        return [
            'subtotal' => $subtotal,
            'item_subtotals' => $itemSubtotals,
            'shipping' => $shipping,
            'final_total' => $finalTotal
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

        foreach ($cart as $itemKey => $item) {
            // Ensure all required keys exist with safe defaults
            $price = isset($item['price']) ? (float)$item['price'] : 0;
            $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
            $name = isset($item['name']) ? $item['name'] : 'Unknown Item';
            $image = isset($item['image']) ? $item['image'] : null;
            $id = isset($item['id']) ? $item['id'] : 0;
            
            $subtotal = $price * $quantity;
            $total += $subtotal;

            $imageUrl = $image ? asset('storage/' . $image) : asset('assets/img/food-1.png');

            // Determine item type and ID for removal
            $itemType = strpos($itemKey, 'cooked_food_') === 0 ? 'cooked_food' : 'product';
            
            $html .= '
                <li class="d-flex align-items-center position-relative">
                    <div class="p-img light-bg">
                        <img src="' . $imageUrl . '" alt="' . htmlspecialchars($name) . '">
                    </div>
                    <div class="p-data">
                        <h3 class="font-semi-bold">' . htmlspecialchars($name) . '</h3>
                        <p class="theme-clr font-semi-bold">' . $quantity . ' x ₹' . number_format($price, 2) . '</p>
                    </div>
                    <a href="javascript:void(0)" class="remove-cart-item" 
                       data-item-id="' . $id . '" 
                       data-item-type="' . $itemType . '"></a>
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

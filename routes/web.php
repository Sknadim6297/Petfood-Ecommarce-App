<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CookedFoodController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages routes
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/details', [PageController::class, 'serviceDetails'])->name('services.details');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/how-we-work', [PageController::class, 'howWeWork'])->name('how-we-work');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/team', [PageController::class, 'team'])->name('team');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/history', [PageController::class, 'history'])->name('history');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{slug}', [BlogController::class, 'category'])->name('blog.category');

// Blog Comments Routes
Route::post('/blog/{blog}/comments', [\App\Http\Controllers\Frontend\BlogCommentController::class, 'store'])->name('blog.comments.store');
Route::delete('/blog/comments/{comment}', [\App\Http\Controllers\Frontend\BlogCommentController::class, 'destroy'])->name('blog.comments.destroy')->middleware('auth');

Route::get('/products/details', [ProductController::class, 'details'])->name('products.details');

// Authentication check for AJAX
Route::get('/api/auth-check', function () {
    // If this is a direct browser request (not AJAX), redirect to home
    if (!request()->ajax() && !request()->wantsJson()) {
        return redirect()->route('home');
    }
    
    return response()->json(['authenticated' => Auth::check()]);
});

// Debug routes for testing
Route::get('/debug/products', function () {
    return response()->json([
        'products' => \App\Models\Product::all(['id', 'name']),
        'user' => Auth::user() ? ['id' => Auth::id(), 'name' => Auth::user()->name] : null,
        'authenticated' => Auth::check()
    ]);
});

// Debug route for checking auth and addresses
Route::get('/debug/user-info', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $user = Auth::user();
    $addresses = \App\Models\Address::where('user_id', $user->id)->get();
    
    return response()->json([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ],
        'addresses_count' => $addresses->count(),
        'addresses' => $addresses
    ]);
});

// Debug route for testing cart total calculation
Route::get('/debug/cart-total', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    // Test the cart total calculation from CouponController
    $couponController = new \App\Http\Controllers\CouponController(app(\App\Services\CouponService::class));
    $reflection = new ReflectionClass($couponController);
    $method = $reflection->getMethod('getCartTotal');
    $method->setAccessible(true);
    $cartTotal = $method->invoke($couponController);
    
    // Also get cart from CartController method
    $cartController = new \App\Http\Controllers\Frontend\CartController(app(\App\Services\CouponService::class));
    $cartReflection = new ReflectionClass($cartController);
    $getCartMethod = $cartReflection->getMethod('getCart');
    $getCartMethod->setAccessible(true);
    $cart = $getCartMethod->invoke($cartController);
    
    // Get calculated totals
    $calculateTotalsMethod = $cartReflection->getMethod('calculateCartTotals');
    $calculateTotalsMethod->setAccessible(true);
    $calculatedTotals = $calculateTotalsMethod->invoke($cartController, $cart);
    
    return response()->json([
        'user_id' => Auth::id(),
        'cart_total_from_coupon_controller' => $cartTotal,
        'cart_items' => $cart,
        'cart_items_count' => count($cart),
        'calculated_totals' => $calculatedTotals,
        'session_cart' => session('cart', []),
        'database_cart' => \App\Models\Cart::where('user_id', Auth::id())->with(['product', 'cookedFood'])->get()
    ]);
});

// Debug route for testing cart item calculations
Route::get('/debug/cart-calculations', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $cartController = new \App\Http\Controllers\Frontend\CartController(app(\App\Services\CouponService::class));
    $cartReflection = new ReflectionClass($cartController);
    $getCartMethod = $cartReflection->getMethod('getCart');
    $getCartMethod->setAccessible(true);
    $cart = $getCartMethod->invoke($cartController);
    
    $itemCalculations = [];
    foreach ($cart as $itemKey => $item) {
        $itemCalculations[$itemKey] = [
            'id' => $item['id'] ?? 'N/A',
            'name' => $item['name'] ?? 'N/A',
            'price' => $item['price'] ?? 0,
            'quantity' => $item['quantity'] ?? 0,
            'subtotal' => ($item['price'] ?? 0) * ($item['quantity'] ?? 0),
            'item_type' => $item['item_type'] ?? 'N/A'
        ];
    }
    
    return response()->json([
        'user_id' => Auth::id(),
        'cart_items' => $cart,
        'item_calculations' => $itemCalculations
    ]);
});

// Debug route for testing order placement
Route::get('/debug/order-items', function () {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $orderController = new \App\Http\Controllers\Frontend\OrderController();
    $reflection = new ReflectionClass($orderController);
    $getCartItemsMethod = $reflection->getMethod('getCartItems');
    $getCartItemsMethod->setAccessible(true);
    $cart = $getCartItemsMethod->invoke($orderController, Auth::id());
    
    return response()->json([
        'user_id' => Auth::id(),
        'cart_items_for_order' => $cart,
        'cart_count' => count($cart),
        'ready_for_order' => !empty($cart)
    ]);
});

Route::get('/debug/test-wishlist/{productId}', function ($productId) {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $product = \App\Models\Product::find($productId);
    if (!$product) {
        return response()->json(['error' => 'Product not found', 'product_id' => $productId]);
    }
    
    try {
        $wishlist = \App\Models\Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $productId
        ]);
        
        return response()->json([
            'success' => true,
            'wishlist' => $wishlist,
            'product' => $product
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

Route::get('/debug/test-cart/{productId}', function ($productId) {
    if (!Auth::check()) {
        return response()->json(['error' => 'Not authenticated']);
    }
    
    $product = \App\Models\Product::find($productId);
    if (!$product) {
        return response()->json(['error' => 'Product not found', 'product_id' => $productId]);
    }
    
    // Test session cart
    $cart = session()->get('cart', []);
    $cart[$productId] = [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'quantity' => 1
    ];
    session()->put('cart', $cart);
    
    return response()->json([
        'success' => true,
        'cart' => $cart,
        'product' => $product
    ]);
});

// Debug route for testing relationships
Route::get('/debug/test-relationships', function () {
    try {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Not logged in']);
        }
        
        $addresses = $user->addresses;
        $cart = $user->carts;
        
        return response()->json([
            'user' => $user->name,
            'addresses_count' => $addresses->count(),
            'cart_count' => $cart->count(),
            'addresses' => $addresses,
            'cart' => $cart
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
});

// Frontend product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product-details/{id}', [ProductController::class, 'showById'])->name('product.details');
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

// Frontend cooked food routes
Route::get('/cooked-foods', [CookedFoodController::class, 'index'])->name('cooked-foods.index');
Route::get('/cooked-food/{slug}', [CookedFoodController::class, 'show'])->name('cooked-food.show');
Route::get('/cooked-food-details/{id}', [CookedFoodController::class, 'showById'])->name('cooked-food.details');
Route::post('/cooked-foods/search', [CookedFoodController::class, 'search'])->name('cooked-foods.search');
Route::get('/cooked-foods/category/{category}', [CookedFoodController::class, 'category'])->name('cooked-foods.category');

// Universal search route
Route::post('/search', [ProductController::class, 'universalSearch'])->name('universal.search');

// Cart routes - require authentication
Route::prefix('cart')->name('cart.')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::match(['PUT', 'PATCH'], '/update', [CartController::class, 'update'])->name('update');
    Route::match(['DELETE', 'POST'], '/remove', [CartController::class, 'remove'])->name('remove');
    Route::match(['DELETE', 'POST'], '/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'getCount'])->name('count');
    Route::get('/popup', [CartController::class, 'getPopup'])->name('popup');
});

// Coupon routes
Route::prefix('coupons')->name('coupons.')->group(function () {
    Route::post('/apply', [CouponController::class, 'apply'])->name('apply');
    Route::post('/remove', [CouponController::class, 'remove'])->name('remove');
    Route::get('/available', [CouponController::class, 'available'])->name('available');
    Route::post('/check', [CouponController::class, 'check'])->name('check');
});

// Wishlist routes - require authentication
Route::prefix('wishlist')->name('wishlist.')->middleware('auth')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add'])->name('add');
    Route::delete('/remove', [WishlistController::class, 'remove'])->name('remove');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    Route::get('/count', [WishlistController::class, 'getCount'])->name('count');
    Route::get('/user-products', [WishlistController::class, 'getUserProducts'])->name('user-products');
    Route::delete('/clear', [WishlistController::class, 'clear'])->name('clear');
});

// Order routes (require authentication)
Route::middleware('auth')->prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    Route::get('/{order}/confirmation', [OrderController::class, 'confirmation'])->name('confirmation');
    Route::get('/{order}/payment', [OrderController::class, 'payment'])->name('payment');
    Route::post('/{order}/process-payment', [OrderController::class, 'processPayment'])->name('process-payment');
});

// Address routes (require authentication)
Route::middleware('auth')->prefix('addresses')->name('addresses.')->group(function () {
    Route::get('/', [AddressController::class, 'index'])->name('index');
    Route::post('/', [AddressController::class, 'store'])->name('store');
    Route::put('/{address}', [AddressController::class, 'update'])->name('update');
    Route::delete('/{address}', [AddressController::class, 'destroy'])->name('destroy');
    Route::post('/{address}/set-default', [AddressController::class, 'setDefault'])->name('set-default');
});

// Checkout routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout/process', [OrderController::class, 'store'])->name('checkout.process');

// Redirect dashboard to home for frontend users
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware('web')->group(function () {
    require base_path('routes/admin.php');
});

require __DIR__ . '/auth.php';

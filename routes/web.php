<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Frontend product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product-details/{id}', [ProductController::class, 'showById'])->name('product.details');
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

// Static pages
Route::view('/about', 'frontend.pages.about')->name('about');
Route::view('/contact', 'frontend.pages.contact')->name('contact');
Route::view('/services', 'frontend.pages.services')->name('services');
Route::view('/service-details', 'frontend.pages.service-details')->name('service.details');
Route::view('/team-details', 'frontend.pages.team-details')->name('team.details');
Route::view('/how-we-works', 'frontend.pages.how-we-works')->name('how.we.works');
Route::view('/history', 'frontend.pages.history')->name('history');
Route::view('/pricing-packages', 'frontend.pages.pricing-packages')->name('pricing.packages');
Route::view('/photo-gallery', 'frontend.pages.photo-gallery')->name('photo.gallery');

// Blog routes
Route::view('/blog', 'frontend.blog.index')->name('blog.index');
Route::view('/blog-details', 'frontend.blog.details')->name('blog.details');

// Cart routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/remove', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'getCount'])->name('count');
    Route::get('/popup', [CartController::class, 'getPopup'])->name('popup');
});

// Wishlist routes
Route::prefix('wishlist')->name('wishlist.')->group(function () {
    Route::get('/', [WishlistController::class, 'index'])->name('index');
    Route::post('/add', [WishlistController::class, 'add'])->name('add');
    Route::delete('/remove', [WishlistController::class, 'remove'])->name('remove');
    Route::post('/toggle', [WishlistController::class, 'toggle'])->name('toggle');
    Route::get('/count', [WishlistController::class, 'getCount'])->name('count');
    Route::get('/user-products', [WishlistController::class, 'getUserProducts'])->name('user-products');
    Route::delete('/clear', [WishlistController::class, 'clear'])->name('clear');
});

// Checkout routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');

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

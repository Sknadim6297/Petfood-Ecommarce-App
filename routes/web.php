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

// Frontend product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product-details/{id}', [ProductController::class, 'showById'])->name('product.details');
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');

// Review routes
Route::post('/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
Route::get('/products/{productId}/reviews', [App\Http\Controllers\ReviewController::class, 'getProductReviews'])->name('reviews.product');

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

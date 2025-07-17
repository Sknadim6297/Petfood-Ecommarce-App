<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Frontend product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/product-details/{id}', [ProductController::class, 'details'])->name('product.details');
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

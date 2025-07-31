<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImageLibraryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CookedFoodController;

// Admin Authentication
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (protected)
Route::middleware('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    
    // Category Management
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    
    // Brand Management
    Route::resource('brands', BrandController::class, ['as' => 'admin']);
    
    // Product Management
    Route::resource('products', ProductController::class, ['as' => 'admin']);
    
    // Review Management
    Route::prefix('reviews')->name('admin.reviews.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('index');
        Route::get('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'show'])->name('show');
        Route::post('/{review}/approve', [App\Http\Controllers\Admin\ReviewController::class, 'approve'])->name('approve');
        Route::post('/{review}/reject', [App\Http\Controllers\Admin\ReviewController::class, 'reject'])->name('reject');
        Route::delete('/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('destroy');
        Route::post('/bulk-approve', [App\Http\Controllers\Admin\ReviewController::class, 'bulkApprove'])->name('bulk-approve');
        Route::post('/bulk-delete', [App\Http\Controllers\Admin\ReviewController::class, 'bulkDelete'])->name('bulk-delete');
    });
    
    // Coupon Management
    Route::prefix('coupons')->name('admin.coupons.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/', [CouponController::class, 'store'])->name('store');
        Route::get('/{coupon}', [CouponController::class, 'show'])->name('show');
        Route::get('/{coupon}/edit', [CouponController::class, 'edit'])->name('edit');
        Route::put('/{coupon}', [CouponController::class, 'update'])->name('update');
        Route::delete('/{coupon}', [CouponController::class, 'destroy'])->name('destroy');
        Route::post('/{coupon}/toggle-status', [CouponController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Cooked Food Management
    Route::prefix('cooked-foods')->name('admin.cooked-foods.')->group(function () {
        Route::get('/', [CookedFoodController::class, 'index'])->name('index');
        Route::get('/create', [CookedFoodController::class, 'create'])->name('create');
        Route::post('/', [CookedFoodController::class, 'store'])->name('store');
        Route::get('/{cookedFood}', [CookedFoodController::class, 'show'])->name('show');
        Route::get('/{cookedFood}/edit', [CookedFoodController::class, 'edit'])->name('edit');
        Route::put('/{cookedFood}', [CookedFoodController::class, 'update'])->name('update');
        Route::delete('/{cookedFood}', [CookedFoodController::class, 'destroy'])->name('destroy');
        Route::post('/{cookedFood}/toggle-status', [CookedFoodController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // Cooked Food Management
    Route::prefix('cooked-foods')->name('admin.cooked-foods.')->group(function () {
        Route::get('/', [CookedFoodController::class, 'index'])->name('index');
        Route::get('/create', [CookedFoodController::class, 'create'])->name('create');
        Route::post('/', [CookedFoodController::class, 'store'])->name('store');
        Route::get('/{cookedFood}', [CookedFoodController::class, 'show'])->name('show');
        Route::get('/{cookedFood}/edit', [CookedFoodController::class, 'edit'])->name('edit');
        Route::put('/{cookedFood}', [CookedFoodController::class, 'update'])->name('update');
        Route::delete('/{cookedFood}', [CookedFoodController::class, 'destroy'])->name('destroy');
        Route::post('/{cookedFood}/toggle-status', [CookedFoodController::class, 'toggleStatus'])->name('toggle-status');
    });
    
    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/', function() { return view('admin.users.index'); })->name('admin.users.index');
        Route::get('create', function() { return view('admin.users.create'); })->name('admin.users.create');
    });
    
    // Customer Management
    Route::prefix('customers')->name('admin.customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
        Route::patch('/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])->name('toggle-status');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');
    });
    
    // Order Management
    Route::prefix('orders')->name('admin.orders.')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('index');
        Route::get('/{order}', [AdminOrderController::class, 'show'])->name('show');
        Route::patch('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('update-status');
    });

    // Content Management
    Route::prefix('content')->name('admin.content.')->group(function () {
        // Blog Categories Management
        Route::prefix('blog-categories')->name('blog-categories.')->group(function () {
            Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
            Route::get('/create', [BlogCategoryController::class, 'create'])->name('create');
            Route::post('/', [BlogCategoryController::class, 'store'])->name('store');
            Route::get('/{blogCategory}', [BlogCategoryController::class, 'show'])->name('show');
            Route::get('/{blogCategory}/edit', [BlogCategoryController::class, 'edit'])->name('edit');
            Route::put('/{blogCategory}', [BlogCategoryController::class, 'update'])->name('update');
            Route::delete('/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('destroy');
            Route::patch('/{blogCategory}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('toggle-status');
        });

        // Blog Management
        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{blog}', [BlogController::class, 'show'])->name('show');
            Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
            Route::post('/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('toggle-status');
            Route::post('/{blog}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('toggle-featured');
        });

        // Blog Comments Management
        Route::prefix('blog-comments')->name('blog-comments.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\BlogCommentController::class, 'index'])->name('index');
            Route::get('/{comment}', [\App\Http\Controllers\Admin\BlogCommentController::class, 'show'])->name('show');
            Route::post('/{comment}/approve', [\App\Http\Controllers\Admin\BlogCommentController::class, 'approve'])->name('approve');
            Route::post('/{comment}/reject', [\App\Http\Controllers\Admin\BlogCommentController::class, 'reject'])->name('reject');
            Route::delete('/{comment}', [\App\Http\Controllers\Admin\BlogCommentController::class, 'destroy'])->name('destroy');
        });

        // Image Library Management
        Route::prefix('image-library')->name('image-library.')->group(function () {
            Route::get('/', [ImageLibraryController::class, 'index'])->name('index');
            Route::get('/create', [ImageLibraryController::class, 'create'])->name('create');
            Route::post('/', [ImageLibraryController::class, 'store'])->name('store');
            Route::get('/{imageLibrary}', [ImageLibraryController::class, 'show'])->name('show');
            Route::get('/{imageLibrary}/edit', [ImageLibraryController::class, 'edit'])->name('edit');
            Route::put('/{imageLibrary}', [ImageLibraryController::class, 'update'])->name('update');
            Route::delete('/{imageLibrary}', [ImageLibraryController::class, 'destroy'])->name('destroy');
            Route::get('/{imageLibrary}/download', [ImageLibraryController::class, 'download'])->name('download');
            Route::patch('/{imageLibrary}/toggle-status', [ImageLibraryController::class, 'toggleStatus'])->name('toggle-status');
            Route::post('/{imageLibrary}/track-download', [ImageLibraryController::class, 'trackDownload'])->name('track-download');
            Route::post('/{imageLibrary}/view', [ImageLibraryController::class, 'trackView'])->name('track-view');
            Route::post('/bulk-delete', [ImageLibraryController::class, 'bulkDelete'])->name('bulk-delete');
        });
    });
});

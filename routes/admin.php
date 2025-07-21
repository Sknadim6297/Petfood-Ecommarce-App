<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImageLibraryController;

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
    
    // Product Management
    Route::resource('products', ProductController::class, ['as' => 'admin']);
    
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

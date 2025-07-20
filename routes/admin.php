<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\CustomerController;

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
});

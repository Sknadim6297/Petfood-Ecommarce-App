<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

// Admin Authentication
Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Dashboard (protected)
Route::middleware('admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.index');
    
    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/', function() { return view('admin.users.index'); })->name('admin.users.index');
        Route::get('create', function() { return view('admin.users.create'); })->name('admin.users.create');
    });
    
    // Product Management
    Route::prefix('products')->group(function () {
        Route::get('/', function() { return view('admin.products.index'); })->name('admin.products.index');
        Route::get('create', function() { return view('admin.products.create'); })->name('admin.products.create');
    });
    
    // Order Management
    Route::prefix('orders')->group(function () {
        Route::get('/', function() { return view('admin.orders.index'); })->name('admin.orders.index');
    });
});

<?php

use App\Http\Controllers\ProductInController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopkeepersController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CheckLoginId;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/register', [ShopkeepersController::class, 'register'])->name('register');
Route::post('/register', [ShopkeepersController::class, 'store'])->name("store");
Route::get('/login', [ShopkeepersController::class, 'login'])->name('login');
Route::post('/login', [ShopkeepersController::class, 'loginUser'])->name('loginUser');
Route::post('/logout', [ShopkeepersController::class, 'logOut'])->name('logout');

// Protected routes
Route::middleware(CheckLoginId::class)->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductsController::class);
    Route::resource('product-out', ProductOutController::class);
    Route::resource('product-in', ProductInController::class);
    Route::resource('stock-report', StockReportController::class);
});

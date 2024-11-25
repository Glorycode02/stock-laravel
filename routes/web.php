<?php

use App\Http\Controllers\ProductInController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShopkeepersController;
use App\Http\Controllers\StockReportController;
use Illuminate\Support\Facades\Route;


// Route::resource('auth', ShopkeepersController::class);
Route::get('/',[ ProductsController::class, 'index']);
Route::resource('products', ProductsController::class);
Route::resource('product-out', ProductOutController::class);
Route::resource('product-in', ProductInController::class);
Route::resource('stock-report', StockReportController::class);

Route::get('/register', [ShopkeepersController::class, 'register']);
Route::post('/register', [ShopkeepersController::class, 'store'])->name("store");
Route::get('/login', [ShopkeepersController::class, 'login']);
Route::post('/login', [ShopkeepersController::class, 'loginUser'])->name('loginUser');
Route::post('/logout', [ShopkeepersController::class, 'logOut'])->name('logout');

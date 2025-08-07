<?php

use Illuminate\Support\Facades\Route;

// Import semua controller
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseItemController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\StockLogController;
use App\Http\Controllers\SupplierController;

// Route utama
Route::get('/', function () {
    return view('welcome');
});

// Resource routes
Route::resource('/users', UserController::class);
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/purchases', PurchaseController::class);
Route::resource('/purchase-items', PurchaseItemController::class);
Route::resource('/sales', SaleController::class);
Route::resource('/sale-items', SaleItemController::class);
Route::resource('/stock-logs', StockLogController::class);
Route::resource('/suppliers', SupplierController::class);

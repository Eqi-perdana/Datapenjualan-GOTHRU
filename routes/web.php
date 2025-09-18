<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductPriceHistoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanDashboardController;
use App\Http\Controllers\StocklogController;

// resource routes
Route::resource('/products', ProductController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/suppliers', SupplierController::class);
Route::resource('/sales', SaleController::class);
Route::resource('/purchases', PurchaseController::class);
Route::resource('/product_price_history', ProductPriceHistoryController::class);
Route::resource('/stocklogs', StocklogController::class);


// Dashboard Admin
   Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// // Dashboard Karyawan
//     Route::get('/dashboard', [KaryawanDashboardController::class, 'index'])
//         ->name('karyawan.dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// login & logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// auth scaffolding
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);
Route::get('/top-products', [DashboardController::class, 'getTopProducts']);

Route::resource('/category_product', CategoryProductController::class);
Route::resource('/product', ProductController::class);
Route::resource('/transaction', TransactionController::class);


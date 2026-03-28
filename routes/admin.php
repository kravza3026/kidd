<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('orders', OrdersController::class);
Route::resource('customers', CustomersController::class);
Route::resource('invoices', OrdersController::class);

Route::resource('categories', CategoriesController::class);
Route::resource('products', ProductsController::class);

// Route::get('/token/create', function () {
//    $token = auth()->user()->createToken('Test Token ' . rand(0,10));
//
//    return ['token' => $token->plainTextToken];
// })->name('token.create');

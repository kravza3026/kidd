<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

//Route::get('/token/create', function () {
//    $token = auth()->user()->createToken('Test Token ' . rand(0,10));
//
//    return ['token' => $token->plainTextToken];
//})->name('token.create');

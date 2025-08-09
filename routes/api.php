<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Store\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => ['auth:sanctum'],
    'prefix' => 'user'
], function () {

    Route::resource('family', FamilyController::class);

    Route::get('addresses', [AccountController::class, 'addresses'])
        ->name('addresses');

    Route::get('/', fn (Request $r) => $r->user())
        ->name('user');

});

Route::group([
    'middleware' => ['localize']
], function () {

    Route::get('search', [GeneralController::class, 'search'])
        ->name('search');

    Route::get('/favorites',[GeneralController::class, 'favorites'])
        ->name('favorites');

    Route::get('cart', [CartController::class, 'show'])
        ->name('cart.index');
    Route::post('cart', [CartController::class, 'store'])
        ->name('cart.store');
    Route::put('cart/{itemHash}', [CartController::class, 'update'])
        ->name('cart.update');
    Route::delete('cart/{itemHash}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

});

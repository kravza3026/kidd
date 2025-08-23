<?php

use App\Http\Controllers\Api\Account\AddressController;
use App\Http\Controllers\Api\Account\FamilyController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Store\CartController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'middleware' => ['auth:sanctum', 'localize', HandlePrecognitiveRequests::class],
    'prefix' => 'user',
], function () {

    Route::get('/', fn (Request $r) => $r->user())->name('user');

    Route::put('addresses/{address}/default', [AddressController::class, 'default'])
        ->name('addresses.default');
    Route::apiResource('addresses', AddressController::class)->except('show');
    Route::apiResource('family', FamilyController::class)->except('show');

});

Route::group([
    'middleware' => ['localize'],
], function () {

    Route::get('search', [GeneralController::class, 'search'])
        ->name('search');

    Route::get('/favorites', [GeneralController::class, 'favorites'])
        ->name('favorites');

    Route::get('regions', [GeneralController::class, 'regions'])
        ->name('regions');
    Route::get('cities', [GeneralController::class, 'cities'])
        ->name('cities');

    Route::apiResource('cart', CartController::class);
    Route::get('cart', [CartController::class, 'show'])
        ->name('cart');
    //    Route::post('cart', [CartController::class, 'store'])
    //        ->name('cart.store');
    //    Route::put('cart/{itemHash}', [CartController::class, 'update'])
    //        ->name('cart.update');
    //    Route::delete('cart/{itemHash}', [CartController::class, 'destroy'])
    //        ->name('cart.destroy');

});

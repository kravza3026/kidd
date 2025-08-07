<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Store\CartController;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/user/addresses', function (Request $request) {
        $user = $request->user();
        $user->load('addresses');
        $user->load('addresses.region');

        $response = [
            'addresses' => $user->addresses,
            'regions' => Region::get(['id', 'name']),
        ];

        return response($response, 200);

    });

    Route::get('/user', fn (Request $r) => $r->user())->name('user');

});

Route::get('search', [HomeController::class, 'search'])
    ->middleware('localize')
    ->name('search');

Route::get('cart', [CartController::class, 'show'])
    ->name('cart.show');
Route::post('cart', [CartController::class, 'store'])
    ->name('cart.store');
Route::put('cart/{itemHash}', [CartController::class, 'update'])
    ->name('cart.update');
Route::delete('cart/{itemHash}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

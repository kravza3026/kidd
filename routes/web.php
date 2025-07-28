<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect', 'localeSessionRedirect', 'localeCookieRedirect']
], function () {

    require __DIR__.'/auth.php';

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('search', [HomeController::class, 'search'])
        ->name('search');

    Route::get('catalog/', [ProductsController::class, 'index'])
        ->name('products.index');
    Route::get('catalog/{category}', [ProductsController::class, 'index'])
        ->name('products.category.index');
    Route::get(LaravelLocalization::transRoute('catalog/{category}/{product}'), [ProductsController::class, 'show'])->scopeBindings()
        ->name('products.show');


    Route::get('cart', [CartController::class, 'index'])
        ->name('cart');
    Route::post('cart', [CartController::class, 'store'])
        ->name('cart.store');
    Route::put('cart/{itemHash}', [CartController::class, 'update'])
        ->name('cart.update');
    Route::delete('cart/{itemHash}', [CartController::class, 'destroy'])
        ->name('cart.destroy');


    Route::group([
//        'middleware' => 'cache.headers:public;max_age=60000;etag' // TODO - Production enable
    ], function () {
        Route::get(LaravelLocalization::transRoute('routes.topline.locations'), [PageController::class, 'locations'])
            ->name('locations');
        Route::get(LaravelLocalization::transRoute('routes.topline.careers'), [PageController::class, 'careers'])
            ->name('careers');
        Route::get(LaravelLocalization::transRoute('routes.topline.terms'), [PageController::class, 'terms'])
            ->name('terms');
        Route::get(LaravelLocalization::transRoute('routes.menu.about'), [PageController::class, 'about'])
            ->name('about');
        Route::get(LaravelLocalization::transRoute('routes.menu.help'), [PageController::class, 'help'])
            ->name('help');
        Route::get(LaravelLocalization::transRoute('routes.menu.contacts'), [PageController::class, 'contacts'])
            ->name('contacts');
    });

});

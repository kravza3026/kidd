<?php

use App\Http\Controllers\Account\AddressesController;
use App\Http\Controllers\Account\FamilyController;
use App\Http\Controllers\Account\FavoritesController;
use App\Http\Controllers\Account\OrdersController;
use App\Http\Controllers\Account\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Store\ProductsController;
use Illuminate\Support\Facades\Route;



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect', 'localeSessionRedirect']
], function () {

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::group([
//        'middleware' => 'cache.headers:public;max_age=60000;etag' // TODO - Production enable
    ], function () {
        Route::get(LaravelLocalization::transRoute('routes.topline.locations'), [PageController::class, 'locations'])->name('locations');
        Route::get(LaravelLocalization::transRoute('routes.topline.careers'), [PageController::class, 'careers'])->name('careers');
        Route::get(LaravelLocalization::transRoute('routes.topline.terms'), [PageController::class, 'terms'])->name('terms');
        Route::get(LaravelLocalization::transRoute('routes.menu.about'), [PageController::class, 'about'])->name('about');
        Route::get(LaravelLocalization::transRoute('routes.menu.help'), [PageController::class, 'help'])->name('help');
        Route::get(LaravelLocalization::transRoute('routes.menu.contacts'), [PageController::class, 'contacts'])->name('contacts');
    });

    Route::get('catalog/', [ProductsController::class, 'index'])
        ->name('products.index');
    Route::get('catalog/{category}', [ProductsController::class, 'index'])
        ->name('products.category.index');
    Route::get('catalog/{category}/{product}', [ProductsController::class, 'show'])->scopeBindings()
        ->name('products.show');

    Route::group([
        'middleware' => ['auth', 'verified'],
        'prefix' => 'account',
    ], function () {
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::resource('family', FamilyController::class)->only(['create', 'store', 'edit', 'show', 'update', 'destroy']);
        Route::resource('favorites', FavoritesController::class)->only(['index', 'store', 'destroy']);
        Route::resource('orders', OrdersController::class)->only(['index', 'show']);
        Route::resource('addresses', AddressesController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    });

    require __DIR__.'/auth.php';

});

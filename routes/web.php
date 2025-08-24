<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\Pages\ContactsController;
use App\Http\Controllers\Store\Pages\LocationsController;
use App\Http\Controllers\Store\Pages\VacanciesApplicationController;
use App\Http\Controllers\Store\Pages\VacanciesController;
use App\Http\Controllers\Store\PagesController;
use App\Http\Controllers\Store\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect', 'localeSessionRedirect', 'localeCookieRedirect'],
], function () {

    Route::get('/', [HomeController::class, 'index'])
        ->name('home');

    Route::get('search', [PagesController::class, 'search'])
        ->name('search'); // TODO - Implement search page/view

    Route::get('favorites', [PagesController::class, 'favorites']);

    Route::get('catalog', [ProductsController::class, 'index'])
        ->name('products.index');
    Route::get(LaravelLocalization::transRoute('catalog/{category}'), [ProductsController::class, 'index'])
        ->name('products.category.index');
    Route::get(LaravelLocalization::transRoute('catalog/{category}/{product}'), [ProductsController::class, 'show'])->scopeBindings()
        ->name('products.show');

    Route::get('cart/checkout', [CheckoutController::class, 'index'])
        ->name('checkout.index');

    Route::get('cart/checkout/previous/{step}', [CheckoutController::class, 'previous'])
        ->name('checkout.previous');

    Route::get('cart/checkout/review', [CheckoutController::class, 'review'])
        ->name('checkout.review');

    Route::post('cart/checkout/complete', [CheckoutController::class, 'complete'])
        ->name('checkout.complete');

    Route::post('cart/checkout/shipping', [CheckoutController::class, 'processShipping'])
        ->name('checkout.process.shipping');
    Route::post('cart/checkout/contact', [CheckoutController::class, 'processContact'])
        ->name('checkout.process.contact');
    Route::post('cart/checkout/payment', [CheckoutController::class, 'processPayment'])
        ->name('checkout.process.payment');

    Route::get('cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::group([
        //        'middleware' => 'cache.headers:public;max_age=60000;etag' // TODO - Production enable
    ], function () {

        Route::get(LaravelLocalization::transRoute('routes.topline.locations'), [LocationsController::class, 'index'])
            ->name('locations');

        Route::get(LaravelLocalization::transRoute('routes.topline.careers.careers'), [VacanciesController::class, 'index'])
            ->name('vacancy.index');
        Route::get(LaravelLocalization::transRoute('routes.topline.careers.vacancy.vacancy'), [VacanciesController::class, 'show'])
            ->name('vacancy.show');
        Route::get(LaravelLocalization::transRoute('routes.topline.careers.vacancy.create'), [VacanciesApplicationController::class, 'create'])
            ->name('vacancy.application.create');
        Route::post(LaravelLocalization::transRoute('routes.topline.careers.vacancy.create'), [VacanciesApplicationController::class, 'store'])
            ->name('vacancy.application.store');

        Route::get(LaravelLocalization::transRoute('routes.topline.terms'), [PagesController::class, 'terms'])
            ->name('terms');
        Route::get(LaravelLocalization::transRoute('routes.menu.about'), [PagesController::class, 'about'])
            ->name('about');
        Route::get(LaravelLocalization::transRoute('routes.menu.help'), [PagesController::class, 'help'])
            ->name('help');
        Route::get(LaravelLocalization::transRoute('routes.menu.contacts'), [ContactsController::class, 'index'])
            ->name('contacts');
        Route::post(LaravelLocalization::transRoute('routes.menu.contacts'), [ContactsController::class, 'store'])
            ->name('contacts.store');

        Route::get(LaravelLocalization::transRoute('routes.footer.size-chart'), [PagesController::class, 'size_chart'])
            ->name('size-chart');
    });

});

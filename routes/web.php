<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])
    ->name('home');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localizationRedirect', 'localeSessionRedirect']
], function () {

    Route::get(LaravelLocalization::transRoute('routes.menu.about'), [HomeController::class, 'about'])
        ->name('about');
    Route::get(LaravelLocalization::transRoute('routes.menu.help'), [HomeController::class, 'help'])
        ->name('help');
    Route::get(LaravelLocalization::transRoute('routes.menu.contacts'), [HomeController::class, 'contacts'])
        ->name('contacts');

});

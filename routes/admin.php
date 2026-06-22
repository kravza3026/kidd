<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Admin\OrdersController;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Customers;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products;
use Illuminate\Support\Facades\Route;

/**
 * Register the four full-page Livewire admin routes for a resource, bound by `id`
 * (admin never resolves the translatable slug used on the storefront) and gated behind
 * the resource's Pennant module flag. Index/Form (create+edit)/Show conventions.
 *
 * @param  class-string  $namespace  e.g. App\Livewire\Admin\Products
 */
if (! function_exists('livewireResource')) {
    function livewireResource(string $uri, string $param, string $module, string $namespace): void
    {
        Route::middleware("module:{$module}")->group(function () use ($uri, $param, $namespace) {
            Route::livewire($uri, "{$namespace}\\Index")->name("{$uri}.index");
            Route::livewire("{$uri}/create", "{$namespace}\\Form")->name("{$uri}.create");
            Route::livewire("{$uri}/{{$param}:id}/edit", "{$namespace}\\Form")->name("{$uri}.edit");
            Route::livewire("{$uri}/{{$param}:id}", "{$namespace}\\Show")->name("{$uri}.show");
        });
    }
}

Route::livewire('/', Dashboard::class)->name('home');

livewireResource('categories', 'category', 'category', Categories::class);
livewireResource('products', 'product', 'product', Products::class);
livewireResource('customers', 'customer', 'customer', Customers::class);

// Not yet rebuilt as full CRUD — converted to Livewire as each is implemented.
Route::resource('orders', OrdersController::class);
Route::resource('invoices', OrdersController::class);

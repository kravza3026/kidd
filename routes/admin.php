<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * Register the seven RESTful admin routes for a resource, bound by `id` (admin never
 * resolves the translatable slug used on the storefront) and gated behind the
 * resource's Pennant module flag.
 */
$adminResource = function (string $uri, string $controller, string $module): void {
    $param = Str::singular($uri);

    Route::middleware("module:{$module}")->group(function () use ($uri, $controller, $param) {
        Route::get($uri, [$controller, 'index'])->name("{$uri}.index");
        Route::get("{$uri}/create", [$controller, 'create'])->name("{$uri}.create");
        Route::post($uri, [$controller, 'store'])->name("{$uri}.store");
        Route::get("{$uri}/{{$param}:id}", [$controller, 'show'])->name("{$uri}.show");
        Route::get("{$uri}/{{$param}:id}/edit", [$controller, 'edit'])->name("{$uri}.edit");
        Route::put("{$uri}/{{$param}:id}", [$controller, 'update'])->name("{$uri}.update");
        Route::delete("{$uri}/{{$param}:id}", [$controller, 'destroy'])->name("{$uri}.destroy");
    });
};

Route::livewire('/', Dashboard::class)->name('home');

// Categories — migrated to Livewire (id-bound, module-gated). Reference implementation.
Route::middleware('module:category')->group(function () {
    Route::livewire('categories', Categories\Index::class)->name('categories.index');
    Route::livewire('categories/create', Categories\Form::class)->name('categories.create');
    Route::livewire('categories/{category:id}/edit', Categories\Form::class)->name('categories.edit');
    Route::livewire('categories/{category:id}', Categories\Show::class)->name('categories.show');
});

// Not yet rebuilt as full CRUD — converted to Livewire as each is implemented.
Route::resource('orders', OrdersController::class);
Route::resource('customers', CustomersController::class);
Route::resource('invoices', OrdersController::class);
Route::resource('products', ProductsController::class);

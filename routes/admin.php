<?php

/** @noinspection PhpMultipleClassDeclarationsInspection */

use App\Livewire\Admin\Brands;
use App\Livewire\Admin\CareInstructions;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Cities;
use App\Livewire\Admin\Colors;
use App\Livewire\Admin\Companies;
use App\Livewire\Admin\ContactInquiries;
use App\Livewire\Admin\Customers;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Fabrics;
use App\Livewire\Admin\Genders;
use App\Livewire\Admin\Locations;
use App\Livewire\Admin\Orders\Index;
use App\Livewire\Admin\Orders\Show;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\Regions;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Seasons;
use App\Livewire\Admin\Sizes;
use App\Livewire\Admin\Tags;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Vacancies;
use App\Livewire\Admin\VacancyApplications;
use App\Livewire\Admin\Warehouses;
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

if (! function_exists('livewireInbox')) {
    /**
     * Read-only "inbox" resources: index + show only (storefront-submitted records).
     *
     * @param  class-string  $namespace
     */
    function livewireInbox(string $uri, string $param, string $module, string $namespace): void
    {
        Route::middleware("module:{$module}")->group(function () use ($uri, $param, $namespace) {
            Route::livewire($uri, "{$namespace}\\Index")->name("{$uri}.index");
            Route::livewire("{$uri}/{{$param}:id}", "{$namespace}\\Show")->name("{$uri}.show");
        });
    }
}

if (! function_exists('livewireTaxonomy')) {
    /**
     * Simple taxonomy resources: index + create/edit only (no detail page).
     *
     * @param  class-string  $namespace
     */
    function livewireTaxonomy(string $uri, string $param, string $module, string $namespace): void
    {
        Route::middleware("module:{$module}")->group(function () use ($uri, $param, $namespace) {
            Route::livewire($uri, "{$namespace}\\Index")->name("{$uri}.index");
            Route::livewire("{$uri}/create", "{$namespace}\\Form")->name("{$uri}.create");
            Route::livewire("{$uri}/{{$param}:id}/edit", "{$namespace}\\Form")->name("{$uri}.edit");
        });
    }
}

Route::livewire('/', Dashboard::class)->name('home');

livewireResource('categories', 'category', 'category', Categories::class);
livewireResource('products', 'product', 'product', Products::class);
livewireResource('customers', 'customer', 'customer', Customers::class);

// Catalog taxonomy (simple translatable resources).
livewireTaxonomy('brands', 'brand', 'brand', Brands::class);
livewireTaxonomy('seasons', 'season', 'season', Seasons::class);
livewireTaxonomy('fabrics', 'fabric', 'fabric', Fabrics::class);
livewireTaxonomy('genders', 'gender', 'gender', Genders::class);
livewireTaxonomy('colors', 'color', 'color', Colors::class);
livewireTaxonomy('sizes', 'size', 'size', Sizes::class);
livewireTaxonomy('care-instructions', 'careInstruction', 'careInstruction', CareInstructions::class);
livewireTaxonomy('tags', 'tag', 'tag', Tags::class);

// Orders — list + detail with status management (admin order-builder is a follow-up).
Route::middleware('module:order')->group(function () {
    Route::livewire('orders', Index::class)->name('orders.index');
    Route::livewire('orders/{order:id}', Show::class)->name('orders.show');
});

// Content & ops.
livewireResource('vacancies', 'vacancy', 'vacancy', Vacancies::class);
livewireTaxonomy('companies', 'company', 'company', Companies::class);
livewireTaxonomy('warehouses', 'warehouse', 'warehouse', Warehouses::class);
livewireTaxonomy('locations', 'location', 'location', Locations::class);
livewireTaxonomy('regions', 'region', 'region', Regions::class);
livewireTaxonomy('cities', 'city', 'city', Cities::class);
livewireInbox('contact-inquiries', 'inquiry', 'contactInquire', ContactInquiries::class);
livewireInbox('vacancy-applications', 'application', 'vacancyApplication', VacancyApplications::class);

// Platform.
livewireTaxonomy('users', 'user', 'user', Users::class);
livewireTaxonomy('roles', 'role', 'role', Roles::class);
Route::middleware('module:audit')->group(function () {
    Route::livewire('audit', App\Livewire\Admin\Audit\Index::class)->name('audit.index');
});

// Living style guide — no permission gate beyond admin access; a build/design reference.
Route::livewire('design', App\Livewire\Admin\Design\Index::class)->name('design.index');

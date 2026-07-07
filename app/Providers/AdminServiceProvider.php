<?php

namespace App\Providers;

use App\Support\AdminResources;
use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register a Pennant feature per admin module, resolved from config/admin.php.
     *
     * The closure ignores the scope so a module is globally on/off rather than
     * per-user, and defaults to enabled. Routes and sidebar links check these via
     * the `module` middleware and the `@feature('admin.{resource}')` Blade directive.
     */
    public function boot(): void
    {
        foreach (array_keys(AdminResources::RESOURCES) as $module) {
            Feature::define("admin.{$module}", fn (): bool => (bool) config("admin.modules.{$module}", true));
        }
    }
}

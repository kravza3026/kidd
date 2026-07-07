<?php

use App\Support\AdminResources;

return [

    /*
    |--------------------------------------------------------------------------
    | Admin modules
    |--------------------------------------------------------------------------
    |
    | Each admin-managed resource is exposed as a Pennant feature named
    | "admin.{resource}" (see App\Providers\AdminServiceProvider). The boolean
    | here is the default state of that module — flip one to false (or set the
    | matching ADMIN_MODULE_* env var) to hide a module's nav links and routes
    | without removing code. All modules are enabled by default.
    |
    */

    'modules' => collect(array_keys(AdminResources::RESOURCES))
        ->mapWithKeys(fn (string $key): array => [
            $key => env('ADMIN_MODULE_'.strtoupper($key), true),
        ])
        ->all(),

    /*
    |--------------------------------------------------------------------------
    | Inventory
    |--------------------------------------------------------------------------
    |
    | Stock at or below this quantity marks a variant as "low stock" and (once
    | wired in Phase 7) triggers a LowStockAlert notification to admins.
    |
    */

    'low_stock_threshold' => (int) env('ADMIN_LOW_STOCK_THRESHOLD', 5),

];

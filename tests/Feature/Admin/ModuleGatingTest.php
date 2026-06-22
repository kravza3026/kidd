<?php

use App\Support\AdminResources;
use Laravel\Pennant\Feature;

it('enables every admin module by default', function () {
    foreach (array_keys(AdminResources::RESOURCES) as $module) {
        expect(Feature::active("admin.{$module}"))->toBeTrue("admin.{$module} should default on");
    }
});

it('deactivates a module when its config flag is false', function () {
    config(['admin.modules.product' => false]);

    expect(Feature::active('admin.product'))->toBeFalse()
        ->and(Feature::active('admin.category'))->toBeTrue();
});

it('404s a route guarded by a disabled module', function () {
    config(['admin.modules.product' => false]);

    Route::middleware('module:product')->get('/__module-test', fn () => 'ok');

    $this->get('/__module-test')->assertNotFound();
});

it('allows a route when its module is enabled', function () {
    Route::middleware('module:category')->get('/__module-test-on', fn () => 'ok');

    $this->get('/__module-test-on')->assertOk()->assertSee('ok');
});

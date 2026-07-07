<?php

use App\Models\Order;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    Pdf::fake();
});

it('streams a downloadable invoice for an admin', function () {
    actingAsAdmin();
    $order = Order::factory()->create();

    $this->get(route('admin.orders.invoice', $order->id));

    Pdf::assertRespondedWithPdf(fn ($pdf) => $pdf->isDownload()
        && $pdf->viewName === 'store.account.orders.invoice'
        && str_contains($pdf->downloadName, 'invoice_'));
});

it('forbids a role without order view permission', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $order = Order::factory()->create();

    $this->get(route('admin.orders.invoice', $order->id))->assertForbidden();
});

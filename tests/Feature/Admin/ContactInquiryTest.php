<?php

use App\Livewire\Admin\ContactInquiries\Index;
use App\Livewire\Admin\ContactInquiries\Show;
use App\Models\ContactInquire;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
});

it('lists inquiries for an admin', function () {
    actingAsAdmin();
    $inquiry = ContactInquire::factory()->create();

    $this->get(route('admin.contact-inquiries.index'))->assertOk()->assertSeeLivewire(Index::class);
    Livewire::test(Index::class)->assertSee($inquiry->email);
});

it('shows an inquiry message', function () {
    actingAsAdmin();
    $inquiry = ContactInquire::factory()->create(['message' => 'Please call me back']);

    Livewire::test(Show::class, ['inquiry' => $inquiry])->assertSee('Please call me back');
});

it('deletes an inquiry', function () {
    actingAsAdmin();
    $inquiry = ContactInquire::factory()->create();

    Livewire::test(Index::class)->call('delete', $inquiry->id);

    expect(ContactInquire::find($inquiry->id))->toBeNull();
});

it('lets HR view inquiries but forbids a seller', function () {
    $hr = User::factory()->create();
    $hr->assignRole('hr');
    $this->actingAs($hr);
    $this->get(route('admin.contact-inquiries.index'))->assertOk();

    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);
    $this->get(route('admin.contact-inquiries.index'))->assertForbidden();
});

it('404s when the inquiries module is disabled', function () {
    actingAsAdmin();
    config(['admin.modules.contactInquire' => false]);

    $this->get(route('admin.contact-inquiries.index'))->assertNotFound();
});

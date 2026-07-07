<?php

use App\Livewire\Admin\Settings\Edit;
use App\Models\User;
use App\Settings\NotificationSettings;
use App\Settings\StoreSettings;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

it('seeds store settings with defaults from config', function () {
    expect(app(StoreSettings::class)->facebook_url)->toBe(config('services.social_links.facebook'));
});

it('renders the settings screen for an admin', function () {
    actingAsAdmin();

    $this->get(route('admin.settings.edit'))
        ->assertOk()
        ->assertSeeLivewire(Edit::class)
        ->assertSee('Social links');
});

it('saves store settings', function () {
    actingAsAdmin();

    Livewire::test(Edit::class)
        ->set('facebook_url', 'https://facebook.com/kidd.new')
        ->set('contact_email', 'hello@kidd.md')
        ->call('save')
        ->assertHasNoErrors();

    $settings = app(StoreSettings::class);
    expect($settings->facebook_url)->toBe('https://facebook.com/kidd.new')
        ->and($settings->contact_email)->toBe('hello@kidd.md');
});

it('validates url and email fields', function () {
    actingAsAdmin();

    Livewire::test(Edit::class)
        ->set('facebook_url', 'not-a-url')
        ->set('contact_email', 'not-an-email')
        ->call('save')
        ->assertHasErrors(['facebook_url', 'contact_email']);
});

it('saves notification toggles', function () {
    actingAsAdmin();

    Livewire::test(Edit::class)
        ->set('notify_low_stock', false)
        ->set('notify_new_order', false)
        ->call('save')
        ->assertHasNoErrors();

    $settings = app(NotificationSettings::class);
    expect($settings->notify_low_stock)->toBeFalse()
        ->and($settings->notify_new_order)->toBeFalse()
        ->and($settings->notify_new_inquiry)->toBeTrue();
});

it('forbids a role without settings permission', function () {
    $seller = User::factory()->create();
    $seller->assignRole('seller');
    $this->actingAs($seller);

    $this->get(route('admin.settings.edit'))->assertForbidden();
});

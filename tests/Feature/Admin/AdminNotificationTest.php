<?php

use App\Enums\StockMovementType;
use App\Livewire\Admin\NotificationBell;
use App\Models\ContactInquire;
use App\Models\Order;
use App\Models\User;
use App\Models\VacancyApplication;
use App\Models\Warehouse;
use App\Notifications\Admin\LowStockAlert;
use App\Notifications\Admin\NewContactInquiry;
use App\Notifications\Admin\NewJobApplication;
use App\Notifications\Admin\NewOrderPlaced;
use App\Services\InventoryService;
use App\Settings\NotificationSettings;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Spatie\Permission\PermissionRegistrar;

beforeEach(function () {
    $this->seed([RolesSeeder::class, PermissionsSeeder::class]);
    app(PermissionRegistrar::class)->forgetCachedPermissions();
    app()->setLocale('en');
});

function staffUser(string $role): User
{
    $user = User::factory()->create();
    $user->assignRole($role);

    return $user;
}

it('notifies the order audience when an order is placed', function () {
    Notification::fake();
    $manager = staffUser('manager');
    $hr = staffUser('hr');

    $order = Order::factory()->create();

    Notification::assertSentTo($manager, NewOrderPlaced::class);
    Notification::assertNotSentTo($hr, NewOrderPlaced::class);
});

it('notifies staff of a new contact inquiry', function () {
    Notification::fake();
    $admin = staffUser('admin');

    ContactInquire::factory()->create();

    Notification::assertSentTo($admin, NewContactInquiry::class);
});

it('notifies HR of a new job application', function () {
    Notification::fake();
    $hr = staffUser('hr');
    $seller = staffUser('seller');

    VacancyApplication::factory()->create();

    Notification::assertSentTo($hr, NewJobApplication::class);
    Notification::assertNotSentTo($seller, NewJobApplication::class);
});

it('alerts staff once when stock crosses the low threshold', function () {
    Notification::fake();
    $manager = staffUser('manager');
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $service = app(InventoryService::class);

    $service->record($variant, $warehouse, StockMovementType::Receipt, 7); // above threshold (5)
    $service->record($variant, $warehouse, StockMovementType::Sale, -3);    // 4 — crosses below

    Notification::assertSentToTimes($manager, LowStockAlert::class, 1);
});

it('does not alert when stock stays above the threshold', function () {
    Notification::fake();
    $manager = staffUser('manager');
    $variant = makeVariant();
    $warehouse = Warehouse::factory()->create();
    $service = app(InventoryService::class);

    $service->record($variant, $warehouse, StockMovementType::Receipt, 20);
    $service->record($variant, $warehouse, StockMovementType::Sale, -2); // still 18

    Notification::assertNotSentTo($manager, LowStockAlert::class);
});

it('does not notify when the type is disabled in settings', function () {
    Notification::fake();
    app(NotificationSettings::class)->fill(['notify_new_order' => false])->save();
    $manager = staffUser('manager');

    Order::factory()->create();

    Notification::assertNotSentTo($manager, NewOrderPlaced::class);
});

it('shows unread notifications in the bell and marks them read', function () {
    $admin = actingAsAdmin();
    Order::factory()->create(); // stored to DB (sync queue, null broadcast)

    expect($admin->unreadNotifications()->count())->toBe(1);

    Livewire::test(NotificationBell::class)
        ->assertSee('New order')
        ->call('markAllRead');

    expect($admin->fresh()->unreadNotifications()->count())->toBe(0);
});

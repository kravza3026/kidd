<?php

use App\Enums\OrderStatus;
use App\Enums\ReturnReason;
use App\Livewire\Admin\OrderReturns\Index as ReturnsIndex;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderReturn;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\User;
use App\Notifications\Admin\NewReturnRequest;
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

/**
 * Build a delivered order owned by the given user, with two items.
 */
function deliveredOrderFor(User $user, int $status = 5): Order
{
    $customer = Customer::factory()->create(['user_id' => $user->id]);
    $order = Order::withoutEvents(fn () => Order::factory()->create([
        'customer_id' => $customer->id,
        'status' => $status,
    ]));
    $variant = ProductVariant::factory()->create([
        'color_id' => Color::factory(),
        'size_id' => Size::factory(),
    ]);
    OrderItem::factory()->count(2)->create([
        'order_id' => $order->id,
        'product_variant_id' => $variant->id,
    ]);

    return $order->load('items');
}

it('lets the owner submit a return for a delivered order', function () {
    Notification::fake();
    $user = User::factory()->create();
    $order = deliveredOrderFor($user);
    $itemIds = $order->items->pluck('id')->all();

    $this->actingAs($user)
        ->post(route('orders.return.store', $order), [
            'items' => $itemIds,
            'reason' => ReturnReason::WrongSize->value,
            'comment' => 'The jacket runs small.',
        ])
        ->assertRedirect(route('orders.track', $order));

    $return = OrderReturn::sole();
    expect($return->order_id)->toBe($order->id)
        ->and($return->reason)->toBe(ReturnReason::WrongSize)
        ->and($return->item_ids)->toBe($itemIds)
        ->and($return->comment)->toBe('The jacket runs small.');
});

it('notifies the admin audience of a new return request', function () {
    Notification::fake();
    $admin = User::factory()->create();
    $admin->assignRole('admin');

    $user = User::factory()->create();
    $order = deliveredOrderFor($user);

    $this->actingAs($user)->post(route('orders.return.store', $order), [
        'items' => $order->items->pluck('id')->all(),
        'reason' => ReturnReason::Defective->value,
    ])->assertRedirect();

    Notification::assertSentTo($admin, NewReturnRequest::class);
});

it('forbids requesting a return for an order that is not delivered', function () {
    $user = User::factory()->create();
    $order = deliveredOrderFor($user, status: OrderStatus::Processed->value);

    $this->actingAs($user)->post(route('orders.return.store', $order), [
        'items' => $order->items->pluck('id')->all(),
        'reason' => ReturnReason::WrongSize->value,
    ])->assertForbidden();

    expect(OrderReturn::count())->toBe(0);
});

it('forbids requesting a return for an order owned by someone else', function () {
    $owner = User::factory()->create();
    $order = deliveredOrderFor($owner);
    $stranger = User::factory()->create();

    $this->actingAs($stranger)->post(route('orders.return.store', $order), [
        'items' => $order->items->pluck('id')->all(),
        'reason' => ReturnReason::WrongSize->value,
    ])->assertForbidden();
});

it('requires at least one item and a reason', function () {
    $user = User::factory()->create();
    $order = deliveredOrderFor($user);

    $this->actingAs($user)->post(route('orders.return.store', $order), [])
        ->assertSessionHasErrors(['items', 'reason']);
});

it('shows the admin returns inbox to a seller but forbids hr', function () {
    Notification::fake();
    $return = OrderReturn::factory()->create();

    $seller = User::factory()->create();
    $seller->assignRole('seller');
    Livewire::actingAs($seller)->test(ReturnsIndex::class)->assertOk();

    $hr = User::factory()->create();
    $hr->assignRole('hr');
    Livewire::actingAs($hr)->test(ReturnsIndex::class)->assertForbidden();
});

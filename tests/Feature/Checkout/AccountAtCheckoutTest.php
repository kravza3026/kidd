<?php

use App\Models\City;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Region;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use LukePOLO\LaraCart\Facades\LaraCart;

// Checkout hardcodes company_id = 1 (single-tenant TODO); ensure it exists with that id.
beforeEach(function () {
    Company::unguarded(fn () => Company::factory()->create(['id' => 1]));
});

/**
 * Populate the cart and return a complete set of review-step checkout data.
 *
 * @return array<string, mixed>
 */
function checkoutData(array $overrides = []): array
{
    $region = Region::factory()->create();
    $city = City::factory()->create(['region_id' => $region->id]);
    $variant = makeVariant();

    LaraCart::emptyCart();
    LaraCart::add(
        itemID: $variant->product,
        price: 5000,
        qty: 1,
        options: ['variant' => $variant, 'price' => 5000],
    );

    return array_merge([
        'contact_first_name' => 'Guest',
        'contact_last_name' => 'Buyer',
        'contact_email' => 'guest@example.test',
        'contact_phone' => '+37360111222',
        'shipping_method' => 1,
        'payment_method' => 1,
        'shipping_region' => $region->id,
        'shipping_city' => $city->id,
        'shipping_street_name' => 'Str. A',
        'shipping_building' => '1',
        'shipping_postal_code' => 'MD-2001',
        'shipping_apartment' => null,
        'shipping_entrance' => null,
        'shipping_floor' => null,
        'shipping_intercom' => null,
        'billing_region' => $region->id,
        'billing_city' => $city->id,
        'billing_street_name' => 'Str. A',
        'billing_building' => '1',
        'billing_postal_code' => 'MD-2001',
        'billing_apartment' => null,
    ], $overrides);
}

it('creates a passwordless account, logs in, and emails a set-password link when the guest opts in', function () {
    Notification::fake();
    $data = checkoutData();

    $this->withSession(['checkout_step' => 'review', 'checkout_data' => $data])
        ->post(route('checkout.complete'), ['create_account' => 1])
        ->assertRedirect(route('orders.index'));

    $user = User::where('email', 'guest@example.test')->first();
    expect($user)->not->toBeNull()
        ->and(Customer::where('email', 'guest@example.test')->value('user_id'))->toBe($user->id)
        ->and(Order::count())->toBe(1);

    $this->assertAuthenticatedAs($user);
    Notification::assertSentTo($user, ResetPassword::class);
});

it('checks out as a guest with no account when not opted in', function () {
    $data = checkoutData(['contact_email' => 'guest2@example.test']);

    $this->withSession(['checkout_step' => 'review', 'checkout_data' => $data])
        ->post(route('checkout.complete'), ['create_account' => 0])
        ->assertRedirect(route('home'));

    expect(User::where('email', 'guest2@example.test')->exists())->toBeFalse()
        ->and(Order::count())->toBe(1);
    $this->assertGuest();
});

it('does not create a duplicate account when the email already exists', function () {
    Notification::fake();
    User::factory()->create(['email' => 'taken@example.test']);
    $data = checkoutData(['contact_email' => 'taken@example.test']);

    $this->withSession(['checkout_step' => 'review', 'checkout_data' => $data])
        ->post(route('checkout.complete'), ['create_account' => 1]);

    expect(User::where('email', 'taken@example.test')->count())->toBe(1);
    Notification::assertNothingSent();
});

@extends('store.checkout.layouts.checkout')

@use('App\Enums\PaymentMethod')
@use('App\Enums\ShippingMethod')

@section('checkout-form')
    <a
        href="{{ route('checkout.previous', ['step' => 'contact']) }}"
        class="mb-8 grid grid-cols-17 items-start gap-x-2 font-medium"
    >
        <p
            class="bg-olive col-span-1 flex size-8 items-center justify-center rounded-full text-sm font-bold text-white"
        >
            <img height="12" width="12" src="{{ Vite::image('icons/checked_white.svg') }}" alt="checkmark icon" />
        </p>
        <div class="col-span-15 text-2xl font-bold">
            <p>
                {{ __('checkout.steps.shipping') }}
            </p>
            <p class="text-base font-normal opacity-60">
                <b>{{ ShippingMethod::tryFrom($checkoutData['shipping_method'])->label() }}</b>
                {{ __('checkout.shipping_to') }}
                <span class="inline leading-8 font-medium">
                    {{ $checkoutData['shipping_postal_code'] }}
                    {{ $regions->where('id', '=', $checkoutData['shipping_region'])->first()->name }},
                    {{ \App\Models\City::where('id', '=', $checkoutData['shipping_city'])->first()->name }},
                    {{ $checkoutData['shipping_street_name'] }}
                    {{ $checkoutData['shipping_building'] }}
                    {{ $checkoutData['shipping_apartment'] ? 'ap. '.$checkoutData['shipping_apartment'] : '' }}

                    @if ($checkoutData['shipping_apartment'])
                        ({{ $checkoutData['shipping_entrance'] ? 'sc. '.$checkoutData['shipping_entrance'] : '' }}
                        {{ $checkoutData['shipping_floor'] ? ', et. '.$checkoutData['shipping_floor'] : '' }}
                        {{ $checkoutData['shipping_intercom'] ? ', int. '.$checkoutData['shipping_intercom'] : '' }})
                    @endif
                </span>
            </p>
        </div>
        <div class="col-span-1 flex h-full items-end justify-end">
            <p class="border-light-border flex size-8 items-center justify-center rounded-full border">
                <img class="rotate-180 opacity-20" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="arrow" />
            </p>
        </div>
    </a>
    <hr class="border-light-border mb-8" />
    <a
        href="{{ route('checkout.previous', ['step' => 'payment']) }}"
        class="mb-8 grid grid-cols-17 items-start gap-x-2 font-medium"
    >
        <p
            class="bg-olive col-span-1 flex size-8 items-center justify-center rounded-full text-sm font-bold text-white"
        >
            <img height="12" width="12" src="{{ Vite::image('icons/checked_white.svg') }}" alt="checkmark icon" />
        </p>
        <div class="col-span-15 text-2xl font-bold">
            <p>
                {{ __('checkout.steps.contacts') }}
            </p>
            <p class="text-base font-normal opacity-60">
                <span class="flex items-center gap-x-4 leading-8 font-medium">
                    {{ $checkoutData['contact_first_name'] }}
                    {{ $checkoutData['contact_last_name'] }}
                    <span class="border-light-border h-4 border-r"></span>
                    {{ $checkoutData['contact_phone'] }}
                    <span class="border-light-border h-4 border-r"></span>
                    {{ $checkoutData['contact_email'] }}
                </span>

                {{-- Regular shipping to mun. Chișinău, or. Chișinău, str. Alba Iulia 75, MD-2071 --}}
            </p>
        </div>
        <div class="col-span-1 flex h-full items-end justify-end">
            <p class="border-light-border flex size-8 items-center justify-center rounded-full border">
                <img class="rotate-180 opacity-20" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="arrow" />
            </p>
        </div>
    </a>
    <hr class="border-light-border mb-8" />
    <div class="mb-8 grid grid-cols-17 items-center">
        <p
            class="bg-olive col-span-1 flex size-8 items-center justify-center rounded-full text-sm font-bold text-white"
        >
            3
        </p>
        <p class="col-span-16 text-2xl font-bold">
            {{ __('checkout.steps.payment') }}
        </p>
    </div>
    <form
        x-data="{ method: 'card' }"
        action="{{ route('checkout.process.payment') }}"
        method="POST"
        class="space-y-6"
    >
        @csrf
        <div class="grid grid-cols-17 items-center space-y-6 gap-x-2">
            <div class="col-span-16 col-start-2">
                <h2 class="text-sm font-medium">
                    {{ __('checkout.payment.form.payment_method') }}
                </h2>
            </div>
            <div class="col-span-16 col-start-2">
                <div class="grid min-h-10 grid-cols-4 gap-2">
                    <div class="relative">
                        <input
                            type="radio"
                            name="payment_method"
                            value="{{ PaymentMethod::CashOrCard->value }}"
                            @checked(isset($checkoutData['payment_method']) && $checkoutData['payment_method'] == PaymentMethod::CashOrCard->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="payment_method_card"
                            x-model="method"
                        />

                        <label
                            for="payment_method_card"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <span
                                class="border-olive absolute top-2 right-2 z-20 block size-4 rounded-full border-1 p-0.5"
                            >
                                <span class="marker peer-checked:bg-olive block h-[10px] w-[10px] rounded-full"></span>
                            </span>
                        </label>
                        <div
                            class="border-light-border peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <img
                                class="imgOutline size-12 py-3"
                                src="{{ Vite::image('icons/truck_outline.svg') }}"
                                alt=""
                            />
                            <img
                                class="imgGradient hidden size-12 py-3"
                                src="{{ Vite::image('icons/gradients/g_car.svg') }}"
                                alt=""
                            />
                            <p class="mt-1 flex items-center gap-x-2 font-bold">
                                {{ __('checkout.payment.form.payment_methods.cash_card_at_delivery') }}
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.payment.form.payment_methods.cash_card_at_delivery_desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="payment_method"
                            value="{{ PaymentMethod::BankTransfer->value }}"
                            @checked(isset($checkoutData['payment_method']) && $checkoutData['payment_method'] == PaymentMethod::BankTransfer->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="payment_method_transfer"
                            x-model="method"
                        />

                        <label
                            for="payment_method_transfer"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <span
                                class="border-olive absolute top-2 right-2 z-20 block size-4 rounded-full border-1 p-0.5"
                            >
                                <span class="marker peer-checked:bg-olive block h-[10px] w-[10px] rounded-full"></span>
                            </span>
                        </label>
                        <div
                            class="border-light-border peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <img
                                class="imgOutline size-12 py-3"
                                src="{{ Vite::image('icons/lightning.svg') }}"
                                alt=""
                            />
                            <img
                                class="imgGradient hidden size-12 py-3"
                                src="{{ Vite::image('icons/gradients/q_lightning.svg') }}"
                                alt=""
                            />
                            <p class="mt-1 flex items-center gap-x-2 font-bold">
                                {{ __('checkout.payment.form.payment_methods.bank_transfer') }}
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.payment.form.payment_methods.bank_transfer_desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="payment_method"
                            value="{{ PaymentMethod::OnlinePayment->value }}"
                            @checked(isset($checkoutData['payment_method']) && $checkoutData['payment_method'] == PaymentMethod::OnlinePayment->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="payment_method_online"
                            x-model="method"
                        />

                        <label
                            for="payment_method_online"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <div class="border-olive absolute top-2 right-2 z-20 size-4 rounded-full border-1 p-0.5">
                                <p class="marker peer-checked:bg-olive h-[10px] w-[10px] rounded-full"></p>
                            </div>
                        </label>
                        <div
                            class="border-light-border peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <img class="imgOutline size-12 py-3" src="{{ Vite::image('icons/present.svg') }}" alt="" />
                            <img
                                class="imgGradient hidden size-12 py-3"
                                src="{{ Vite::image('icons/gradients/g_present.svg') }}"
                                alt=""
                            />
                            <p class="mt-1 flex items-center gap-x-2 font-bold">
                                {{ __('checkout.payment.form.payment_methods.card_online') }}
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.payment.form.payment_methods.card_online_desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="payment_method"
                            value="{{ PaymentMethod::PaymentTerminal->value }}"
                            @checked(isset($checkoutData['payment_method']) && $checkoutData['payment_method'] == PaymentMethod::PaymentTerminal->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="payment_method_terminal"
                            x-model="method"
                        />

                        <label
                            for="payment_method_terminal"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <div class="border-olive absolute top-2 right-2 z-20 size-4 rounded-full border-1 p-0.5">
                                <p class="marker peer-checked:bg-olive h-[10px] w-[10px] rounded-full"></p>
                            </div>
                        </label>
                        <div
                            class="border-light-border peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <img class="imgOutline size-12 py-3" src="{{ Vite::image('icons/present.svg') }}" alt="" />
                            <img
                                class="imgGradient hidden size-12 py-3"
                                src="{{ Vite::image('icons/gradients/g_present.svg') }}"
                                alt=""
                            />
                            <p class="mt-1 flex items-center gap-x-2 font-bold">
                                {{ __('checkout.payment.form.payment_methods.terminal') }}
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.payment.form.payment_methods.terminal_desc') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payment Methods -->

        <div class="grid grid-cols-17">
            <div class="col-span-16 col-start-2">
                <div
                    x-data="{
                        checked: false,
                        postalCode:
                            '{{ old('shipping_postal_code', $checkoutData['shipping_postal_code'] ?? '') }}',
                        shippingBuilding:
                            '{{ old('shipping_building', $checkoutData['shipping_building'] ?? '') }}',
                        shippingStreet:
                            '{{ old('shipping_street_name', $checkoutData['shipping_street_name'] ?? '') }}',
                    }"
                    id="card-details"
                    class="space-y-4"
                    x-show="method == 1"
                >
                    <div class="border-light-border space-y-4 rounded-2xl border">
                        <div class="bg-light-orange grid grid-cols-12 items-center justify-between rounded-2xl p-4">
                            <h2 class="col-span-4 text-base font-bold">Billing address</h2>
                            <div class="col-span-8">
                                <div class="relative flex w-full items-center justify-end gap-x-2">
                                    <div class="flex items-center gap-x-2">
                                        <x-ui.checkbox x-model="checked" class="bg-white"></x-ui.checkbox>
                                        <p class="text-sm">Same as shipping</p>
                                    </div>
                                    <div class="relative w-1/2">
                                        @auth
                                            <button
                                                type="button"
                                                class="border-light-border focus:border-olive focus:ring-olive flex w-full cursor-pointer items-center justify-between rounded-xl border bg-white px-4 py-2 text-left shadow-sm focus:ring"
                                                id="saved_addresses"
                                            >
                                                <span class="flex items-center gap-x-2">
                                                    <span class="opacity-40">
                                                        <img
                                                            src="{{ Vite::image('icons/marker_outline.svg') }}"
                                                            alt=""
                                                        />
                                                    </span>
                                                    <span
                                                        x-text="
                                                            checked
                                                                ? shippingStreet
                                                                : ' {{ __('checkout.shipping.form.saved_addresses_placeholder') }}'
                                                        "
                                                        id="selected-option"
                                                    ></span>
                                                </span>
                                                <span>
                                                    <img
                                                        src="{{ Vite::image('/icons/select-arrows_o.svg') }}"
                                                        alt=""
                                                    />
                                                </span>
                                            </button>

                                            <ul
                                                class="absolute z-10 mt-2 hidden w-full rounded-xl border border-gray-200 bg-white shadow-lg"
                                                id="saved_addresses-options"
                                            >
                                                @foreach (auth()->user()->billingAddresses as $address)
                                                    {{-- {{old('saved_address', $checkoutData['saved_address'])}} --}}
                                                    {{-- {{$address->label}} --}}
                                                    <li
                                                        data-shipping-region="{{ $address->region_id }}"
                                                        data-shipping-city="{{ $address->city_id }}"
                                                        data-shipping-street-name="{{ $address->street_name }}"
                                                        data-shipping-building="{{ $address->building }}"
                                                        data-shipping-postal-code="{{ $address->postal_code }}"
                                                        data-shipping-apartment="{{ $address->apartment }}"
                                                        data-shipping-floor="{{ $address->floor }}"
                                                        data-shipping-entrance="{{ $address->entrance }}"
                                                        data-shipping-intercom="{{ $address->intercom }}"
                                                        data-selected="{{ old('saved_address', $checkoutData['saved_address'] ?? '') == $address->label ? 'true' : 'false' }}"
                                                        class="saved-address relative m-1 flex cursor-pointer items-center gap-x-2 rounded-2xl"
                                                    >
                                                        <input
                                                            id="address-{{ $address->id }}"
                                                            class="peer hidden"
                                                            type="radio"
                                                            name="payment_address"
                                                            value="{{ $address->label }}"
                                                            x-bind:selected="
                                                                checked &&
                                                                    '{{ old('saved_address', $checkoutData['saved_address'] ?? '') == $address->label ? 'true' : 'false' }}'
                                                            "
                                                        />
                                                        <label
                                                            class="hover:bg-light-orange m-1 w-full cursor-pointer rounded-2xl px-4 py-2"
                                                            for="address-{{ $address->id }}"
                                                        >
                                                            <span
                                                                class="marker flex w-full items-center justify-start gap-x-2"
                                                            >
                                                                <p
                                                                    class="border-light-border flex size-7 items-center justify-center rounded-full border"
                                                                >
                                                                    <img
                                                                        class="hidden"
                                                                        src="{{ Vite::image('icons/checked_white.svg') }}"
                                                                        alt="checkbox"
                                                                    />
                                                                </p>

                                                                {{ $address->label }}
                                                            </span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 p-4">
                            <div class="col-span-6 mt-3">
                                <label for="shipping_region" class="text-charcoal block text-sm font-medium">
                                    {{ __('checkout.shipping.form.shipping_region') }}
                                </label>
                                <select
                                    required
                                    name="shipping_region"
                                    id="shipping_region"
                                    class="focus:border-olive focus:ring-olive mt-3 w-full rounded-xl border border-gray-200 bg-white p-3 transition-colors"
                                >
                                    <option value="">
                                        {{ __('checkout.shipping.form.shipping_region_placeholder') }}
                                    </option>
                                    @foreach ($regions as $region)
                                        <option
                                            value="{{ $region->id }}"
                                            x-bind:selected="
                                                checked &&
                                                    '{{ old('shipping_region', $checkoutData['shipping_region'] ?? '') }}' ==
                                                        '{{ $region->id }}'
                                            "
                                        >
                                            {{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shipping_region')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-span-6 mt-3">
                                <label for="shipping_city" class="text-charcoal block text-sm font-medium">
                                    {{ __('checkout.shipping.form.shipping_city') }}
                                </label>
                                <select
                                    required
                                    name="shipping_city"
                                    id="shipping_city"
                                    class="focus:border-olive focus:ring-olive mt-3 w-full rounded-xl border border-gray-200 bg-white p-3 transition-colors"
                                >
                                    <option value="0">
                                        {{ __('checkout.shipping.form.shipping_city_placeholder') }}
                                    </option>
                                    @foreach ($regions->where('id', '=', $checkoutData['shipping_region'] ?? '9')->first()?->cities as $city)
                                        <option
                                            value="{{ $city->id }}"
                                            x-bind:selected="
                                                checked &&
                                                    '{{ old('shipping_city', $checkoutData['shipping_city'] ?? '') }}' ==
                                                        '{{ $city->id }}'
                                            "
                                        >
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shipping_city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-ui.input-label
                                :customClass="'col-span-6'"
                                for="shipping_street_name"
                                name="shipping_street_name"
                                :label="__('checkout.shipping.form.shipping_street_name')"
                                required
                                autocomplete="street"
                                x-bind:value="checked ? shippingStreet : ''"
                            />

                            <x-ui.input-label
                                :customClass="'col-span-3'"
                                :placeholder="'Building number'"
                                for="shipping_building"
                                name="shipping_building"
                                :label="__('checkout.shipping.form.shipping_building')"
                                required
                                autocomplete="building"
                                x-bind:value="checked ? shippingBuilding : ''"
                            />

                            <x-ui.input-label
                                :customClass="'col-span-3'"
                                :placeholder="'Postal code'"
                                id="postal_code"
                                for="shipping_postal_code"
                                name="shipping_postal_code"
                                :label="__('checkout.shipping.form.shipping_postal_code')"
                                required
                                autocomplete="postal_code"
                                x-bind:value="checked ? postalCode : ''"
                            />
                        </div>
                    </div>
                </div>
                <div id="transfer-details" class="space-y-4" x-show="method === 2">
                    <h2 class="text-lg font-bold">Transfer</h2>
                </div>
                <div id="online-details" class="space-y-4" x-show="method === 3">
                    <h2 class="text-lg font-bold">Online</h2>
                </div>
                <div id="terminal-details" class="space-y-4" x-show="method === 4">
                    <h2 class="text-lg font-bold">Terminal</h2>
                </div>

                <div class="flex items-center justify-start pt-8">
                    <x-ui.button as="button" class="mt-0 px-15 !py-3" right_icon="true" type="submit">
                        Place the order
                    </x-ui.button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cardDetails = document.getElementById('card-details');
            const paymentInputs = document.querySelectorAll('input[name="payment_method"]');

            function toggleCardDetails() {
                const selectedMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
                cardDetails.style.display = selectedMethod === '3' ? 'block' : 'none';
            }

            paymentInputs.forEach((input) => {
                input.addEventListener('change', toggleCardDetails);
            });

            toggleCardDetails();
        });
    </script>
@endpush

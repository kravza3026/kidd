@extends('store.checkout.layouts.checkout')
@php
    $progressWidth = '25%';
    $step = 'Shipping'
@endphp
@use('App\Enums\ShippingMethod')
@section('checkout-form')

    <div class="pb-section grid grid-cols-17 gap-4">
        <div class="col-span-1 hidden lg:flex items-start justify-start">
            <p class="bg-olive flex size-8 items-center justify-center rounded-full text-sm font-bold text-white">1</p>
        </div>
        <div class="col-span-17 lg:col-span-16">
            <div class="hidden lg:block mb-8">
                <h1 class="text-3xl font-bold">
                    {{ __('checkout.steps.shipping') }}
                </h1>
            </div>

            <form action="{{ route('checkout.process.shipping') }}" method="POST" class="space-y-6">
                @csrf

                <label for="shipping_method" class="text-charcoal mb-2 block text-xl font-bold lg:font-medium">
                    {{ __('checkout.shipping.form.shipping_method') }}
                </label>
                <div class="grid min-h-10 grid-cols-1 lg:grid-cols-3 gap-4">

                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ ShippingMethod::Regular }}"
                            @checked(! isset($checkoutData['shipping_method']) || $checkoutData['shipping_method'] == ShippingMethod::Regular->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_method_regular"
                        />

                        <label
                            for="shipping_method_regular"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <span class="border-olive flex justify-center items-center absolute top-1/3 lg:top-2 right-4 lg:right-2 z-20 size-6 lg:size-4 rounded-full border-1 ">
                                <span class="marker block peer-checked:bg-olive size-3.5 lg:h-[10px] lg:w-[10px] rounded-full"></span>
                            </span>
                        </label>
                        <div
                            class="border-light-border flex lg:flex-col peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <div>
                                <img
                                    class="imgOutline size-12 py-3"
                                    src="{{ Vite::image('icons/gradients/g_car.svg') }}"
                                    alt=""
                                />
                                <img
                                    class="imgGradient hidden size-12 py-3"
                                    src="{{ Vite::image('icons/olive/truck_outline.svg') }}"
                                    alt=""
                                />
                            </div>
                            <div>
                                <p class="mt-1 flex items-center gap-x-2 font-bold">
                                    {{ __('checkout.shipping.form.shipping_methods.regular.title') }}
                                    <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +{{ config('laracart.delivery_prices.regular') }} {{ __('general.mdl') }}
                                </span>
                                </p>
                                <p class="text-sm opacity-40">
                                    {{ __('checkout.shipping.form.shipping_methods.regular.desc') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ ShippingMethod::Express }}"
                            @checked(isset($checkoutData['shipping_method']) && $checkoutData['shipping_method'] == ShippingMethod::Express->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_express"
                        />
                        <label
                            for="shipping_express"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <span class="border-olive flex justify-center items-center absolute top-1/3 lg:top-2 right-4 lg:right-2 z-20 size-6 lg:size-4 rounded-full border-1 ">
                                <span class="marker block peer-checked:bg-olive size-3.5 lg:h-[10px] lg:w-[10px] rounded-full"></span>
                            </span>
                        </label>
                        <div
                            class="border-light-border flex lg:flex-col peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <div>
                                <img
                                    class="imgOutline size-12 py-3"
                                    src="{{ Vite::image('icons/gradients/g_lightning.svg') }}"
                                    alt=""
                                />
                                <img
                                    class="imgGradient hidden size-12 py-3"
                                    src="{{ Vite::image('icons/olive/lightning.svg') }}"
                                    alt=""
                                />
                            </div>
                            <div>
                                <p class="mt-1 flex items-center gap-x-2 font-bold">
                                    {{ __('checkout.shipping.form.shipping_methods.express.title') }}
                                    <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +{{ config('laracart.delivery_prices.expres') }} {{ __('general.mdl') }}
                                </span>
                                </p>
                                <p class="text-sm opacity-40">
                                    {{ __('checkout.shipping.form.shipping_methods.express.desc') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ ShippingMethod::Gift }}"
                            @checked(isset($checkoutData['shipping_method']) && $checkoutData['shipping_method'] == ShippingMethod::Gift->value)
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_gift"
                        />

                        <label
                            for="shipping_gift"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                             <span class="border-olive flex justify-center items-center absolute top-1/3 lg:top-2 right-4 lg:right-2 z-20 size-6 lg:size-4 rounded-full border-1 ">
                                <span class="marker block peer-checked:bg-olive size-3.5 lg:h-[10px] lg:w-[10px] rounded-full"></span>
                            </span>
                        </label>
                        <div
                            class="border-light-border flex lg:flex-col peer-checked:border-olive peer-checked:bg-light-orange relative rounded-2xl border-2 bg-white p-3 duration-300 peer-checked:[&_.imgGradient]:block peer-checked:[&_.imgOutline]:hidden"
                        >
                            <div>
                                <img
                                    class="imgOutline size-12 py-3"
                                    src="{{ Vite::image('icons/gradients/g_present.svg') }}"
                                    alt=""
                                />
                                <img
                                    class="imgGradient hidden size-12 py-3"
                                    src="{{ Vite::image('icons/olive/present.svg') }}"
                                    alt=""
                                />
                            </div>
                            <div>
                                <p class="mt-1 flex items-center gap-x-2 font-bold">
                                    {{ __('checkout.shipping.form.shipping_methods.gift.title') }}
                                    <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +{{ config('laracart.delivery_prices.gift') }} {{ __('general.mdl') }}
                                </span>
                                </p>
                                <p class="text-sm opacity-40">
                                    {{ __('checkout.shipping.form.shipping_methods.gift.desc') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    id="shipping_2_description"
                    class="shipping-block bg-light-orange grid hidden grid-cols-1 lg:grid-cols-12 items-center gap-6 rounded-2xl p-4"
                >
                    <div class="col-span-2">
                        <img src="{{ Vite::image('common/box_size.png') }}" alt="box size" />
                    </div>
                    <div class="col-span-10">
                        <p class="text-lg font-bold">
                            {{ __('checkout.shipping.form.shipping_methods.gift.details.title') }}
                        </p>
                        <p class="text-sm leading-7">
                            {!! __('checkout.shipping.form.shipping_methods.gift.details.description') !!}
                        </p>
                    </div>
                </div>
                <div
                    id="shipping_3_description"
                    class="shipping-block bg-light-orange grid hidden grid-cols-1 lg:grid-cols-12 items-center gap-6 rounded-2xl p-4"
                >
                    <div class="col-span-2">
                        <img src="{{ Vite::image('common/delivery_expr.png') }}" alt="box size" />
                    </div>
                    <div class="col-span-10">
                        <p class="text-lg font-bold">
                            {{ __('checkout.shipping.form.shipping_methods.express.details.title') }}
                        </p>
                        <p class="text-sm leading-7">
                            {{ __('checkout.shipping.form.shipping_methods.express.details.description') }}
                        </p>
                    </div>
                </div>
                <div class="border-light-border space-y-4 rounded-2xl border">
                    <div class="lg:bg-light-orange grid grid-cols-1 lg:grid-cols-12 items-center justify-between rounded-t-2xl mb-0 lg:mb-2 p-4 pb-0 lg:pb-4">
                        <h2 class="col-span-8 text-base font-bold py-3 lg:py-0">
                            {{ __('checkout.shipping.shipping_title') }}
                        </h2>
                        <div class="col-span-1 lg:col-span-4">
                            <div class="relative w-full">
                                @auth
                                    <span class="lg:hidden">
                                        {{ __('checkout.shipping.form.saved_addresses') }}
                                    </span>
                                    <button
                                        type="button"
                                        class="border-light-border mt-3 lg:mt-0  focus:border-olive flex w-full cursor-pointer items-center justify-between rounded-xl border bg-white px-3 py-2 text-left text-sm shadow-sm ring-0"
                                        id="saved_addresses"
                                    >
                                        <span class="flex items-center gap-x-2">
                                            <span class="opacity-40">
                                                <img src="{{ Vite::image('icons/marker_outline.svg') }}" alt="" />
                                            </span>
                                            <span id="selected-option">
                                                {{ old('saved_address', $checkoutData['saved_address'] ?? __('checkout.shipping.form.saved_addresses_placeholder')) }}
                                            </span>
                                        </span>
                                        <span>
                                            <img src="{{ Vite::image('icons/select-arrows_o.svg') }}" alt="" />
                                        </span>
                                    </button>

                                    <ul
                                        class="absolute z-10 mt-2 hidden w-full rounded-xl border border-gray-200 bg-white shadow-lg"
                                        id="saved_addresses-options"
                                    >
                                        @foreach (auth()->user()->shippingAddresses as $address)
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
                                                    {{ old('saved_address', $checkoutData['saved_address'] ?? '') == $address->label ? 'checked' : '' }}
                                                    id="address-{{ $address->id }}"
                                                    class="peer hidden"
                                                    type="radio"
                                                    name="saved_address"
                                                    value="{{ $address->label }}"
                                                />
                                                <label
                                                    class="hover:bg-light-orange m-1 w-full cursor-pointer rounded-2xl px-4 py-2"
                                                    for="address-{{ $address->id }}"
                                                >
                                                    <span class="marker flex w-full items-center justify-start gap-x-2">
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
                    <div class="grid grid-cols-12 gap-4 p-4">
                        <div class="col-span-12 lg:col-span-6 mt-0 lg:mt-3">


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
                                        {{ old('shipping_region', $checkoutData['shipping_region'] ?? '') == $region->id ? 'selected' : '' }}
                                    >
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipping_region')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-12 lg:col-span-6 mt-0 lg:mt-3">
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
                                        {{ old('shipping_city', $checkoutData['shipping_city'] ?? '') == $city->id ? 'selected' : '' }}
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
                            :customClass="'col-span-12 lg:col-span-6 !mt-0 lg:!mt-3'"
                            for="shipping_street_name"
                            value="{{ old('shipping_street_name', $checkoutData['shipping_street_name'] ?? '') }}"
                            name="shipping_street_name"
                            :label="__('checkout.shipping.form.shipping_street_name')"
                            :placeholder="__('checkout.shipping.form.shipping_street_name_placeholder')"
                            required
                            autocomplete="street"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            :placeholder="__('checkout.shipping.form.shipping_building_placeholder')"
                            for="shipping_building"
                            value="{{ old('shipping_building', $checkoutData['shipping_building'] ?? '') }}"
                            name="shipping_building"
                            :label="__('checkout.shipping.form.shipping_building')"
                            required
                            autocomplete="building"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            :placeholder="__('checkout.shipping.form.shipping_postal_code_placeholder')"
                            id="shipping_postal_code"
                            for="shipping_postal_code"
                            value="{{ old('shipping_postal_code', $checkoutData['shipping_postal_code'] ?? '') }}"
                            name="shipping_postal_code"
                            :label="__('checkout.shipping.form.shipping_postal_code')"
                            required
                            autocomplete="postal_code"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_entrance_placeholder')"
                            for="shipping_entrance"
                            value="{{ old('shipping_entrance', $checkoutData['shipping_entrance'] ?? '') }}"
                            name="shipping_entrance"
                            :label="__('checkout.shipping.form.shipping_entrance')"
                            autocomplete="shipping_entrance"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_floor_placeholder')"
                            for="shipping_floor"
                            value="{{ old('shipping_floor', $checkoutData['shipping_floor'] ?? '') }}"
                            name="shipping_floor"
                            :label="__('checkout.shipping.form.shipping_floor')"
                            autocomplete="shipping_floor"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_apartment_placeholder')"
                            for="shipping_apartment"
                            value="{{ old('shipping_apartment', $checkoutData['shipping_apartment'] ?? '') }}"
                            name="shipping_apartment"
                            :label="__('checkout.shipping.form.shipping_apartment')"
                            autocomplete="shipping_apartment"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-6 lg:col-span-3 !mt-0 lg:!mt-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_intercom_placeholder')"
                            for="shipping_intercom"
                            value="{{ old('shipping_intercom', $checkoutData['shipping_intercom'] ?? '') }}"
                            name="shipping_intercom"
                            :label="__('checkout.shipping.form.shipping_intercom')"
                            autocomplete="shipping_intercom"
                        />
                    </div>
                </div>

                @error(['shipping_method', 'saved_address', 'shipping_street_name', 'shipping_building', 'shipping_postal_code', 'shipping_region', 'shipping_city', 'shipping_entrance', 'shipping_floor',
                    'shipping_apartment', 'shipping_intercom'])
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <div class="flex justify-start pt-2">
                    <x-ui.button as="button" class="w-full sm:w-auto px-15 !py-3" right_icon="false" type="submit">
                        {{ __('checkout.continue') }}
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
    <div class="hidden lg:block">

        <hr class="border-light-border my-6" />
        <div class="flex items-center gap-x-4 font-medium">
            <p
                class="border-charcoal/30 flex size-8 items-center justify-center rounded-full border-2 text-sm font-bold opacity-30"
            >
                2
            </p>
            <p class="text-2xl">
                {{ __('checkout.steps.contacts') }}
            </p>
        </div>
        <hr class="border-light-border my-6" />
        <div class="flex items-center gap-x-4 font-medium">
            <p
                class="border-charcoal/30 flex size-8 items-center justify-center rounded-full border-2 text-sm font-bold opacity-30"
            >
                3
            </p>
            <p class="text-2xl">
                {{ __('checkout.steps.payment') }}
            </p>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radios = document.querySelectorAll('input[name="shipping_method"]');
            const blocks = document.querySelectorAll('.shipping-block');

            radios.forEach((radio) => {
                radio.addEventListener('change', function () {
                    blocks.forEach((b) => b.classList.add('hidden'));
                    const selected = document.getElementById(`shipping_${this.value}_description`);
                    if (selected) {
                        selected.classList.remove('hidden');
                    }
                });
            });

            const checked = document.querySelector('input[name="shipping_method"]:checked');
            if (checked) {
                document.getElementById(`shipping_${checked.value}_description`)?.classList.remove('hidden');
            }
        });
    </script>
@endpush

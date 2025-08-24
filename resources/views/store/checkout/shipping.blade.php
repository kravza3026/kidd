@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="pb-section grid grid-cols-17 gap-4">
        <div class="col-span-1 flex items-start justify-start">
            <p class="bg-olive flex size-8 items-center justify-center rounded-full text-sm font-bold text-white">1</p>
        </div>
        <div class="col-span-16">
            <div class="mb-8">
                <h1 class="text-3xl font-bold">
                    {{ __('checkout.steps.shipping') }}
                </h1>
            </div>

            <form action="{{ route('checkout.process.shipping') }}" method="POST" class="space-y-6">
                @csrf

                <label for="shipping_method" class="text-charcoal mb-2 block text-sm font-medium">
                    {{ __('checkout.shipping.form.shipping_method') }}
                </label>
                <div class="grid min-h-10 grid-cols-3 gap-4">
                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ App\Enums\ShippingMethod::Regular }}"
                            checked
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_method_regular"
                        />

                        <label
                            for="shipping_method_regular"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <div class="border-olive absolute top-2 right-2 z-20 size-4 rounded-full border-1 p-0.5">
                                <p class="marker peer-checked:bg-olive h-[10px] w-[10px] rounded-full"></p>
                            </div>
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
                                {{ __('checkout.shipping.form.shipping_methods.regular.title') }}
                                <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +50 lei
                                </span>
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.shipping.form.shipping_methods.regular.desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ App\Enums\ShippingMethod::Gift }}"
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_gift"
                        />

                        <label
                            for="shipping_gift"
                            class="peer-checked:[&_.marker]:bg-olive absolute inset-0 z-10 bg-transparent"
                        >
                            <div class="border-olive absolute top-2 right-2 z-20 size-4 rounded-full border-1 p-0.5">
                                <p class="marker peer-checked:bg-olive h-[10px] w-[10px] rounded-full"></p>
                            </div>
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
                                {{ __('checkout.shipping.form.shipping_methods.gift.title') }}
                                <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +100 lei
                                </span>
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.shipping.form.shipping_methods.gift.desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <input
                            type="radio"
                            name="shipping_method"
                            value="{{ App\Enums\ShippingMethod::Express }}"
                            class="peer absolute top-2 right-2 z-10 hidden"
                            id="shipping_express"
                        />

                        <label
                            for="shipping_express"
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
                                {{ __('checkout.shipping.form.shipping_methods.express.title') }}
                                <span class="bg-olive rounded-4xl px-2 py-0.5 text-xs font-bold text-white">
                                    +150 lei
                                </span>
                            </p>
                            <p class="text-sm opacity-40">
                                {{ __('checkout.shipping.form.shipping_methods.express.desc') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-light-border space-y-4 rounded-2xl border">
                    <div class="bg-light-orange grid grid-cols-12 items-center justify-between rounded-2xl p-4">
                        <h2 class="col-span-8 text-base font-bold">
                            {{ __('checkout.shipping.shipping_title') }}
                        </h2>
                        <div class="col-span-4">
                            <div class="relative w-full">
                                @auth
                                    <button
                                        type="button"
                                        class="border-light-border focus:border-olive focus:ring-olive flex w-full cursor-pointer items-center justify-between rounded-xl border bg-white px-4 py-2 text-left shadow-sm focus:ring"
                                        id="saved_addresses"
                                    >
                                        <span id="selected-option">
                                            {{ old('saved_address', $checkoutData['saved_address'] ?? __('checkout.shipping.form.saved_addresses_placeholder')) }}
                                        </span>
                                        <span>
                                            <img src="{{ Vite::image('/icons/select-arrows_o.svg') }}" alt="" />
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
                                                                alt=""
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
                            :customClass="'col-span-6'"
                            for="shipping_street_name"
                            value="{{ old('shipping_street_name', $checkoutData['shipping_street_name'] ?? '') }}"
                            name="shipping_street_name"
                            :label="__('checkout.shipping.form.shipping_street_name')"
                            :placeholder="__('checkout.shipping.form.shipping_street_name_placeholder')"
                            required
                            autocomplete="street"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
                            :placeholder="__('checkout.shipping.form.shipping_building_placeholder')"
                            for="shipping_building"
                            value="{{ old('shipping_building', $checkoutData['shipping_building'] ?? '') }}"
                            name="shipping_building"
                            :label="__('checkout.shipping.form.shipping_building')"
                            required
                            autocomplete="building"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
                            :placeholder="__('checkout.shipping.form.shipping_postal_code_placeholder')"
                            id="postal_code"
                            for="shipping_postal_code"
                            value="{{ old('shipping_postal_code', $checkoutData['shipping_postal_code'] ?? '') }}"
                            name="shipping_postal_code"
                            :label="__('checkout.shipping.form.shipping_postal_code')"
                            required
                            autocomplete="postal_code"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_entrance_placeholder')"
                            for="shipping_entrance"
                            value="{{ old('shipping_entrance', $checkoutData['shipping_entrance'] ?? '') }}"
                            name="shipping_entrance"
                            :label="__('checkout.shipping.form.shipping_entrance')"
                            autocomplete="shipping_entrance"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_floor_placeholder')"
                            for="shipping_floor"
                            value="{{ old('shipping_floor', $checkoutData['shipping_floor'] ?? '') }}"
                            name="shipping_floor"
                            :label="__('checkout.shipping.form.shipping_floor')"
                            autocomplete="shipping_floor"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
                            optional
                            :placeholder="__('checkout.shipping.form.shipping_apartment_placeholder')"
                            for="shipping_apartment"
                            value="{{ old('shipping_apartment', $checkoutData['shipping_apartment'] ?? '') }}"
                            name="shipping_apartment"
                            :label="__('checkout.shipping.form.shipping_apartment')"
                            autocomplete="shipping_apartment"
                        />

                        <x-ui.input-label
                            :customClass="'col-span-3'"
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
                    <x-ui.button as="button" class="px-15 !py-3" right_icon="false" type="submit">
                        {{ __('checkout.continue') }}
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>

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

    <script>
        const selectButton = document.getElementById('saved_addresses');
        const optionsList = document.getElementById('saved_addresses-options');
        const selectedOption = document.getElementById('selected-option');

        // Тогл відкриття списку
        selectButton.addEventListener('click', () => {
            optionsList.classList.toggle('hidden');
        });

        // Клік по опції
        optionsList.querySelectorAll('li.saved-address').forEach((option) => {
            option.addEventListener('click', () => {
                selectedOption.textContent = option.textContent.trim();
                optionsList.classList.add('hidden');
                console.log(option.dataset.shippingPostcode);

                // 3. Підставити дані в інпути
                if (option.dataset.shippingIntercom) {
                    document.getElementById('shipping_intercom').value = option.dataset.shippingIntercom;
                } else {
                    document.getElementById('shipping_intercom').value = '';
                }

                if (option.dataset.shippingFloor) {
                    document.getElementById('shipping_floor').value = option.dataset.shippingFloor;
                } else {
                    document.getElementById('shipping_floor').value = '';
                }

                if (option.dataset.shippingEntrance) {
                    document.getElementById('shipping_entrance').value = option.dataset.shippingEntrance;
                } else {
                    document.getElementById('shipping_entrance').value = '';
                }

                if (option.dataset.shippingApartment) {
                    document.getElementById('shipping_apartment').value = option.dataset.shippingApartment;
                } else {
                    document.getElementById('shipping_apartment').value = '';
                }

                if (option.dataset.shippingPostalCode) {
                    document.getElementById('postal_code').value = option.dataset.shippingPostalCode;
                } else {
                    document.getElementById('postal_code').value = '';
                }

                if (option.dataset.shippingBuilding) {
                    document.getElementById('shipping_building').value = option.dataset.shippingBuilding;
                } else {
                    document.getElementById('shipping_building').value = '';
                }

                if (option.dataset.shippingStreetName) {
                    document.getElementById('shipping_street_name').value = option.dataset.shippingStreetName;
                } else {
                    document.getElementById('shipping_street_name').value = '';
                }

                if (option.dataset.shippingCity) {
                    document.getElementById('shipping_city').value = option.dataset.shippingCity;
                } else {
                    document.getElementById('shipping_city').value = '';
                }

                if (option.dataset.shippingRegion) {
                    document.getElementById('shipping_region').value = option.dataset.shippingRegion;
                } else {
                    document.getElementById('shipping_region').value = '';
                }

                // 4. Активувати radio (якщо треба)
                const radio = option.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;
            });
        });

        document.addEventListener('click', (e) => {
            if (!selectButton.contains(e.target) && !optionsList.contains(e.target)) {
                optionsList.classList.add('hidden');
            }
        });
    </script>
    <style>
        input[name='saved_address']:checked + label {
            background-color: var(--color-light-orange);
        }

        input[name='saved_address']:checked + label img {
            display: block;
        }

        input[name='saved_address']:checked + label p {
            background-color: var(--color-olive);
        }
    </style>
@endsection

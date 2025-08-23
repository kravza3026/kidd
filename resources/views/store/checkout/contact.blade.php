@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <a
        href="{{ route('checkout.previous', ['step' => 'contact']) }}"
        class="mb-8 grid grid-cols-17 items-center gap-x-2 font-medium"
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
                <b>{{ ucfirst($checkoutData['shipping_method']) }}</b>
                shipping to
                <span class="inline-block leading-8 font-medium">
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
            2
        </p>
        <p class="col-span-16 text-2xl font-bold">
            {{ __('checkout.steps.contacts') }}
        </p>
    </div>
    <form action="{{ route('checkout.process.contact') }}" method="POST" class="grid grid-cols-17">
        @csrf

        <div class="col-span-16 col-start-2">
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <x-ui.input-label
                            :placeholder="__('checkout.contact.form.first_name_placeholder')"
                            for="first_name"
                            value="{{ old('contact_first_name', $checkoutData['contact_first_name'] ?? '') }}"
                            name="contact_first_name"
                            :label="__('checkout.contact.form.first_name')"
                            autocomplete="first_name"
                        />
                    </div>

                    <div class="col-span-1">
                        <x-ui.input-label
                            :placeholder="__('checkout.contact.form.last_name_placeholder')"
                            for="last_name"
                            value="{{ old('contact_last_name', $checkoutData['contact_last_name'] ?? '') }}"
                            name="contact_last_name"
                            :label="__('checkout.contact.form.last_name')"
                            autocomplete="family-name"
                        />
                    </div>

                    <div class="col-span-1">
                        <x-ui.input-label
                            type="email"
                            name="contact_email"
                            for="contact_email"
                            value="{{ old('contact_email', $checkoutData['contact_email'] ?? '') }}"
                            :label="__('checkout.contact.form.email')"
                            :placeholder="__('checkout.contact.form.email_placeholder')"
                        ></x-ui.input-label>
                    </div>

                    <div class="col-span-1">
                        <x-ui.input-label
                            :placeholder="__('checkout.contact.form.phone_placeholder')"
                            id="phone"
                            for="contact_phone"
                            value="{{ old('contact_phone', $checkoutData['contact_phone'] ?? '') }}"
                            name="contact_phone"
                            :label="__('checkout.contact.form.phone')"
                            autocomplete="phone"
                        />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-start pt-8">
                <x-ui.button as="button" class="mt-0 px-15 !py-3" right_icon="false" type="submit">
                    {{ __('checkout.continue') }}
                </x-ui.button>
            </div>
        </div>
    </form>

    <hr class="border-light-border my-6" />
    <div class="grid grid-cols-17 items-center gap-x-2 font-medium">
        <p
            class="border-charcoal/30 col-span-1 flex size-8 items-center justify-center rounded-full border-2 text-sm font-bold opacity-30"
        >
            3
        </p>
        <p class="col-span-16 text-2xl">
            {{ __('checkout.steps.payment') }}
        </p>
    </div>
    <hr class="border-light-border my-6" />
@endsection

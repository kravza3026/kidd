@extends('store.checkout.layouts.checkout')

@section('checkout-form')
{{--    {{dd(auth()->user()->addresses()->first())}}--}}
    <a href="{{ route('checkout.previous', ['step' => 'contact']) }}" class="grid grid-cols-17 items-center gap-x-2 font-medium mb-8">
        <p class="size-8 col-span-1 bg-olive text-white flex items-center justify-center rounded-full">
            <img src="{{Vite::image('icons/checked_white.svg')}}" alt="">
        </p>
        <div class="text-2xl col-span-15 font-bold">
            <p>Shipping details</p>
            <p class="text-base font-normal opacity-60">Regular shipping to mun. Chișinău, or. Chișinău, str. Alba Iulia 75, MD-2071</p>
        </div>
        <div class="col-span-1 flex h-full justify-end items-end">
            <p class="size-8 flex items-center justify-center rounded-full border border-light-border">
                <img class="rotate-180 opacity-20" src="{{Vite::image('icons/top_arrow.svg')}}" alt="arrow">
            </p>
        </div>
    </a>

    <hr class="border-light-border mb-8">
    <div class="grid grid-cols-17 items-center mb-8">
            <p class="size-8 col-span-1 rounded-full bg-olive text-white flex items-center justify-center">1</p>
            <p class="col-span-16 text-2xl font-bold">Contact information</p>
    </div>
    <form action="{{ route('checkout.process', ['step' => 'contact']) }}" method="POST" class="grid grid-cols-17">
        @csrf

        <div class="col-span-16 col-start-2">
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <x-ui.input-label :placeholder="'Enter first name'" for="first_name" value="{{ old('contact_first_name', $checkoutData['contact_first_name'] ?? '') }}" :type="'text'" name="contact_first_name" :label="__('First name')"  autocomplete="first_name"/>
                        @error('contact_first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <x-ui.input-label :placeholder="'Enter your surname'" for="last_name" value="{{ old('contact_last_name', $checkoutData['contact_last_name'] ?? '') }}" :type="'text'" name="contact_last_name" :label="__('Last name')"  autocomplete="family-name"/>
                        @error('contact_last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-1">

                        <x-ui.input-label type="email" name="contact_email" for="contact_email" value="{{ old('contact_email', $checkoutData['contact_email'] ?? '') }}"  :label="__('E-mail address')"  placeholder="Enter email address"> </x-ui.input-label>
                        @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <x-ui.input-label :placeholder="'Enter your phone number'" for="phone" value="{{ old('contact_last_name', $checkoutData['contact_phone'] ?? '') }}" :type="'text'" name="contact_phone" :label="__('Phone number')"  autocomplete="phone"/>
                        @error('contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="flex justify-start items-center pt-8">
                <x-ui.button as="button" class="px-15 !py-3 mt-0" right_icon="false"  type="submit">Continue</x-ui.button>
            </div>
        </div>
    </form>
    <hr class="border-light-border my-4">
    <div class="grid grid-cols-17 items-center gap-x-2 font-medium">
        <p class="size-8 col-span-1 opacity-30 border-2 border-charcoal/30 flex items-center justify-center rounded-full">3</p>
        <p class="text-2xl col-span-16">Payment details</p>
    </div>
    <hr class="border-light-border my-4">

@endsection

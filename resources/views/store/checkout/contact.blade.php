@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Contact Information</h1>
        <p class="text-sm text-charcoal/60 mt-2">Please enter your contact details</p>
    </div>

    <form action="{{ route('checkout.process', ['step' => 'contact']) }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="contact_first_name" class="block text-sm font-medium text-charcoal">
                        First Name
                    </label>
                    <input type="text" name="contact_first_name" id="contact_first_name"
                           value="{{ old('contact_first_name', $checkoutData['contact_first_name'] ?? '') }}"
                           class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                           placeholder="Enter first name">
                    @error('contact_first_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="contact_last_name" class="block text-sm font-medium text-charcoal">
                        Last Name
                    </label>
                    <input type="text" name="contact_last_name" id="contact_last_name"
                           value="{{ old('contact_last_name', $checkoutData['contact_last_name'] ?? '') }}"
                           class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                           placeholder="Enter last name">
                    @error('contact_last_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-charcoal">
                    Email Address
                </label>
                <input type="email" name="contact_email" id="contact_email"
                       value="{{ old('contact_email', $checkoutData['contact_email'] ?? '') }}"
                       class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                       placeholder="Enter email address">
                @error('contact_email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_phone" class="block text-sm font-medium text-charcoal">
                    Phone Number
                </label>
                <input type="tel" name="contact_phone" id="contact_phone"
                       value="{{ old('contact_phone', $checkoutData['contact_phone'] ?? '') }}"
                       class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                       placeholder="Enter phone number">
                @error('contact_phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-between items-center pt-8">
            <a href="{{ route('checkout.previous', ['step' => 'contact']) }}"
               class="flex items-center gap-2 text-sm text-charcoal/60 hover:text-charcoal transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Shipping
            </a>
            <button type="submit"
                    class="bg-olive text-white px-6 py-3 rounded-xl hover:bg-olive-dark focus:outline-none focus:ring-2 focus:ring-olive focus:ring-offset-2 transition-colors">
                Continue to Payment
            </button>
        </div>
    </form>
@endsection

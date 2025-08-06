@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Shipping Information</h1>
        <p class="text-sm text-charcoal/60 mt-2">Please enter your shipping details</p>
    </div>

    <form action="{{ route('checkout.process', ['step' => 'shipping']) }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <div>
                <label for="shipping_address" class="block text-sm font-medium text-charcoal">
                    Street Address
                </label>
                <input type="text" name="shipping_address" id="shipping_address"
                       value="{{ old('shipping_address', $checkoutData['shipping_address'] ?? '') }}"
                       class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                       placeholder="Enter your street address">
                @error('shipping_address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="shipping_city" class="block text-sm font-medium text-charcoal">
                        City
                    </label>
                    <input type="text" name="shipping_city" id="shipping_city"
                           value="{{ old('shipping_city', $checkoutData['shipping_city'] ?? '') }}"
                           class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                           placeholder="Enter city">
                    @error('shipping_city')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="shipping_postcode" class="block text-sm font-medium text-charcoal">
                        Postal Code
                    </label>
                    <input type="text" name="shipping_postcode" id="shipping_postcode"
                           value="{{ old('shipping_postcode', $checkoutData['shipping_postcode'] ?? '') }}"
                           class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive placeholder-gray-400 transition-colors"
                           placeholder="Enter postal code">
                    @error('shipping_postcode')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="shipping_country" class="block text-sm font-medium text-charcoal">
                    Country
                </label>
                <select name="shipping_country" id="shipping_country"
                        class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive bg-white transition-colors">
                    <option value="">Select a country</option>
                    <option value="RO" {{ (old('shipping_country', $checkoutData['shipping_country'] ?? '') == 'RO') ? 'selected' : '' }}>
                        Romania
                    </option>
                    <option value="MD" {{ (old('shipping_country', $checkoutData['shipping_country'] ?? '') == 'MD') ? 'selected' : '' }}>
                        Moldova
                    </option>
                </select>
                @error('shipping_country')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end pt-8">
            <button type="submit"
                    class="bg-olive text-white px-6 py-3 rounded-xl hover:bg-olive-dark focus:outline-none focus:ring-2 focus:ring-olive focus:ring-offset-2 transition-colors">
                Continue to Contact
            </button>
        </div>
    </form>
@endsection

@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="grid grid-cols-17 gap-4">
        <div class="col-span-1 flex justify-start items-start">
            <p class="size-8 rounded-full bg-olive text-white flex items-center justify-center">1</p>
        </div>
        <div class="col-span-15">
            <div class="mb-8">
                <h1 class="text-3xl font-bold">Shipping details</h1>
            </div>

            <form action="{{ route('checkout.process', ['step' => 'shipping']) }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-3 gap-4 min-h-10">
                    <div class="relative">
                        <input type="radio" name="shipping_m" class="peer hidden absolute right-2 top-2 z-10" id="shipping_m">

                        <label for="shipping_m" class="inset-0 bg-transparent z-10 absolute peer-checked:[&_.marker]:bg-olive">
                            <div class="size-4  absolute right-2 top-2 z-20 rounded-full border-1 border-olive p-0.5">
                                <p class="marker peer-checked:bg-olive rounded-full w-[10px] h-[10px]"></p>
                            </div>
                        </label>
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3" src="{{Vite::image('icons/truck_outline.svg')}}" alt="">
                            <p class="font-bold flex items-center gap-x-2 mt-1">Regular <span class="bg-olive text-white px-2 py-0.5 rounded-4xl font-bold text-xs">+50 lei</span></p>
                            <p class="text-sm opacity-40">3–14 business days</p>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="radio" name="shipping_m" class="peer hidden absolute right-2 top-2 z-10" id="shipping_m_2">

                        <label for="shipping_m_2" class="inset-0 bg-transparent z-10 absolute peer-checked:[&_.marker]:bg-olive">
                            <div class="size-4  absolute right-2 top-2 z-20 rounded-full border-1 border-olive p-0.5">
                                <p class="marker peer-checked:bg-olive rounded-full w-[10px] h-[10px]"></p>
                            </div>
                        </label>
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3" src="{{Vite::image('icons/truck_outline.svg')}}" alt="">
                            <p class="font-bold flex items-center gap-x-2 mt-1">Regular <span class="bg-olive text-white px-2 py-0.5 rounded-4xl font-bold text-xs">+50 lei</span></p>
                            <p class="text-sm opacity-40">3–14 business days</p>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="radio" name="shipping_m" class="peer hidden absolute right-2 top-2 z-10" id="shipping_m_3">

                        <label for="shipping_m_3" class="inset-0 bg-transparent z-10 absolute peer-checked:[&_.marker]:bg-olive">
                            <div class="size-4  absolute right-2 top-2 z-20 rounded-full border-1 border-olive p-0.5">
                                <p class="marker peer-checked:bg-olive rounded-full w-[10px] h-[10px]"></p>
                            </div>
                        </label>
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3" src="{{Vite::image('icons/truck_outline.svg')}}" alt="">
                            <p class="font-bold flex items-center gap-x-2 mt-1">Regular <span class="bg-olive text-white px-2 py-0.5 rounded-4xl font-bold text-xs">+50 lei</span></p>
                            <p class="text-sm opacity-40">3–14 business days</p>
                        </div>
                    </div>
                </div>
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
                        <label for="shipping_region" class="block text-sm font-medium text-charcoal">
                            Country
                        </label>
                        <select name="shipping_region" id="shipping_region"
                                class="mt-2 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive bg-white transition-colors">
                            <option value="">Select a country</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}"
                                    {{ old('shipping_region', $checkoutData['shipping_region'] ?? '') == $region->id ? 'selected' : '' }}>
                                    {{ $region->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('shipping_region')
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
            </form></div>
    </div>


@endsection

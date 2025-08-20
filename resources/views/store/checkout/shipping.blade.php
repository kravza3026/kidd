@extends('store.checkout.layouts.checkout')

@section('checkout-form')
    <div class="grid grid-cols-17 gap-4 pb-section">
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
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:[&_.imgOutline]:hidden peer-checked:[&_.imgGradient]:block peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3 size-12 imgOutline" src="{{Vite::image('icons/truck_outline.svg')}}" alt="">
                            <img class="py-3 size-12 imgGradient hidden" src="{{Vite::image('icons/gradients/g_car.svg')}}" alt="">
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
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:[&_.imgOutline]:hidden peer-checked:[&_.imgGradient]:block peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3 size-12 imgOutline" src="{{Vite::image('icons/lightning.svg')}}" alt="">
                            <img class="py-3 size-12 imgGradient hidden" src="{{Vite::image('icons/gradients/q_lightning.svg')}}" alt="">
                            <p class="font-bold flex items-center gap-x-2 mt-1">Gift <span class="bg-olive text-white px-2 py-0.5 rounded-4xl font-bold text-xs">+100 lei</span></p>
                            <p class="text-sm opacity-40">3–7 business days</p>
                        </div>
                    </div>
                    <div class="relative">
                        <input type="radio" name="shipping_m" class="peer hidden absolute right-2 top-2 z-10" id="shipping_m_3">

                        <label for="shipping_m_3" class="inset-0 bg-transparent z-10 absolute peer-checked:[&_.marker]:bg-olive">
                            <div class="size-4  absolute right-2 top-2 z-20 rounded-full border-1 border-olive p-0.5">
                                <p class="marker peer-checked:bg-olive rounded-full w-[10px] h-[10px]"></p>
                            </div>
                        </label>
                        <div class="p-3 relative rounded-2xl  border-2 border-light-border peer-checked:[&_.imgOutline]:hidden peer-checked:[&_.imgGradient]:block peer-checked:border-olive peer-checked:bg-light-orange bg-white duration-300">
                            <img class="py-3 size-12 imgOutline" src="{{Vite::image('icons/present.svg')}}" alt="">
                            <img class="py-3 size-12 imgGradient hidden" src="{{Vite::image('icons/gradients/g_present.svg')}}" alt="">
                            <p class="font-bold flex items-center gap-x-2 mt-1">Express <span class="bg-olive text-white px-2 py-0.5 rounded-4xl font-bold text-xs">+150 lei</span></p>
                            <p class="text-sm opacity-40">1–3 business days</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4 border border-light-border rounded-2xl">
                    <h2 class="p-4 font-bold text-base bg-light-orange rounded-2xl">Shipping address</h2>
                    <div class="p-4 grid grid-cols-12 gap-4">
                        <div class="col-span-6 mt-3">
                            <label for="shipping_region" class="block text-sm font-medium text-charcoal">
                                Region
                            </label>
                            <select required name="shipping_region" id="shipping_region"
                                    class="mt-3 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive bg-white transition-colors">
                                <option value="">Select region</option>
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
                        <div class="col-span-6 mt-3">
                            <label for="shipping_region" class="block text-sm font-medium text-charcoal">
                                Localty
                            </label>
                            <select required name="shipping_region" id="shipping_region"
                                    class="mt-3 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive bg-white transition-colors">
                                <option value="">Select localty</option>
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
                        <x-ui.input-label required :customClass="'col-span-6'" for="street" value="" :type="'text'" name="street" :label="__('Street')" required autocomplete="street"/>
                        <x-ui.input-label required :customClass="'col-span-3'" :placeholder="'Building number'" for="building" value="" :type="'text'" name="building" :label="__('Building')" required autocomplete="building"/>
                        <x-ui.input-label required :customClass="'col-span-3'" :placeholder="'Postal code'" for="postal_code" value="" :type="'text'" name="postal_code" :label="__('Postal code')" required autocomplete="postal_code"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Entrance number'" for="entrance" value="" :type="'text'" name="entrance" :label="__('Entrance')" required autocomplete="entrance"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Floor number'" for="floor" value="" :type="'text'" name="floor" :label="__('Floor')" required autocomplete="floor"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Apartment number'" for="apartment" value="" :type="'text'" name="apartment" :label="__('Apartment')" required autocomplete="apartment"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Intercom code'" for="intercom" value="" :type="'text'" name="intercom" :label="__('Intercom')" required autocomplete="intercom"/>

                    </div>
                </div>


                <div class="flex justify-start pt-2">
                    <x-ui.button class="px-15" right_icon="false"  type="submit">Continue</x-ui.button>

                </div>
            </form>
            <hr class="border-light-border my-4">
            <div class="flex items-center gap-x-2 font-medium">
                <p class="size-10 opacity-30 border-2 border-charcoal/30 flex items-center justify-center rounded-full">2</p>
                <p class="text-2xl">Contact information</p>
            </div>
            <hr class="border-light-border my-4">
            <div class="flex items-center gap-x-2 font-medium">
                <p class="size-10 opacity-30 border-2 border-charcoal/30 flex items-center justify-center rounded-full">3</p>
                <p class="text-2xl">Payment details</p>
            </div>
        </div>
    </div>


@endsection

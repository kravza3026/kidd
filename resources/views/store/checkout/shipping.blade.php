@extends('store.checkout.layouts.checkout')

@section('checkout-form')
{{--    {{dd(auth()->user()->addresses()->first())}}--}}


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
                        <input type="radio" name="shipping_m" checked class="peer hidden absolute right-2 top-2 z-10" id="shipping_m">

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
                    <div class="p-4 bg-light-orange rounded-2xl grid grid-cols-12 items-center justify-between">
                        <h2 class=" font-bold text-base col-span-8">Shipping address</h2>
                        <div class="col-span-4">
                            <div class="relative w-full">

                                <button type="button"
                                    class="w-full flex justify-between items-center cursor-pointer rounded-xl border border-light-border bg-white px-4 py-2 text-left shadow-sm focus:border-olive focus:ring focus:ring-olive"
                                    id="custom-select-button"
                                >
                                    <span id="selected-option">{{ old('saved_address', $checkoutData['saved_address'] ?? 'Select address') }} </span>
                                    <span><img src="{{Vite::image('/icons/select-arrows_o.svg')}}" alt=""></span>
                                </button>

                                <ul
                                    class="absolute z-10 mt-2 w-full rounded-xl border border-gray-200 bg-white shadow-lg hidden"
                                    id="custom-select-options"
                                >

                                    @foreach(auth()->user()->addresses as $address)
{{--                                        {{old('saved_address', $checkoutData['saved_address'])}}--}}
{{--                                        {{$address->label}}--}}
                                        <li
                                            data-shipping-city = "{{ $address->city->name}}"
                                            data-shipping-region = "{{ $address->region_id }}"
                                            data-shipping-address = "{{ $address->street_name }}"
                                            data-shipping-building = "{{ $address->building }}"
                                            data-shipping-postcode = "{{ $address->postal_code }}"
                                            data-shipping-apartment = "{{ $address->apartment }}"
                                            data-shipping-floor = "{{ $address->floor }}"
                                            data-shipping-entrance = "{{ $address->entrance }}"
                                            data-selected="{{ old('saved_address', $checkoutData['saved_address'] ?? '') == $address->label ? 'true' : 'false' }}"

                                            class="saved-address relative flex gap-x-2 items-center m-1  rounded-2xl cursor-pointer">
                                            <input
                                                {{ old('saved_address', $checkoutData['saved_address'] ?? '') == $address->label ? 'checked' : '' }}
                                                id="address-{{$address->id}}" class="hidden peer" type="radio" name="saved_address" value="{{ $address->label }}">
                                            <label class="cursor-pointer hover:bg-light-orange w-full px-4 py-2 rounded-2xl m-1" for="address-{{$address->id}}">
                                                <span class="marker w-full flex  gap-x-2 items-center justify-start">

                                                        <p class=" border border-light-border rounded-full size-7 flex  items-center justify-center">
                                                            <img class="hidden" src="{{Vite::image('icons/checked_white.svg')}}" alt="">
                                                        </p>
                                                    {{$address->label}}

                                                </span>
                                            </label>


                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
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
                            <label for="shipping_city" class="block text-sm font-medium text-charcoal">
                                Localty
                            </label>
                            <select required name="shipping_city" id="shipping_city"
                                    class="mt-3 w-full p-3 border border-gray-200 rounded-xl focus:border-olive focus:ring-olive bg-white transition-colors">
                                <option value="">Select localty</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}"
                                        {{ old('shipping_city', $checkoutData['shipping_city'] ?? '') == $region->id ? 'selected' : '' }}>
                                        {{ $region->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shipping_region')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-ui.input-label required :customClass="'col-span-6'" for="street" value="{{ old('shipping_address', $checkoutData['shipping_address'] ?? '') }}" :type="'text'" name="shipping_address" :label="__('Street')" required autocomplete="street"/>
                        <x-ui.input-label required :customClass="'col-span-3'" :placeholder="'Building number'" for="building" value="{{ old('contact_last_name', $checkoutData['shipping_building'] ?? '') }}" :type="'text'" name="shipping_building" :label="__('Building')" required autocomplete="building"/>
                        <x-ui.input-label required :customClass="'col-span-3'" :placeholder="'Postal code'" for="postal_code" value="{{ old('contact_last_name', $checkoutData['shipping_postcode'] ?? '') }}" :type="'text'" name="shipping_postcode" :label="__('Postal code')" required autocomplete="postal_code"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Entrance number'" for="entrance" value="" :type="'text'" name="entrance" :label="__('Entrance')"  autocomplete="entrance"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Floor number'" for="floor" value="" :type="'text'" name="floor" :label="__('Floor')"  autocomplete="floor"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Apartment number'" for="apartment" value="" :type="'text'" name="apartment" :label="__('Apartment')"  autocomplete="apartment"/>
                        <x-ui.input-label :customClass="'col-span-3'" optional :placeholder="'Intercom code'" for="intercom" value="" :type="'text'" name="intercom" :label="__('Intercom')"  autocomplete="intercom"/>

                    </div>
                </div>


                <div class="flex justify-start pt-2">
                    <x-ui.button as="button" class="px-15 !py-3" right_icon="false"  type="submit">Continue</x-ui.button>

                </div>
            </form>
            <hr class="border-light-border my-4">
            <div class="flex items-center gap-x-2 font-medium">
                <p class="size-8 opacity-30 border-2 border-charcoal/30 flex items-center justify-center rounded-full">2</p>
                <p class="text-2xl">Contact information</p>
            </div>
            <hr class="border-light-border my-4">
            <div class="flex items-center gap-x-2 font-medium">
                <p class="size-8 opacity-30 border-2 border-charcoal/30 flex items-center justify-center rounded-full">3</p>
                <p class="text-2xl">Payment details</p>
            </div>
        </div>
    </div>

<script>
    const selectButton = document.getElementById('custom-select-button');
    const optionsList = document.getElementById('custom-select-options');
    const selectedOption = document.getElementById('selected-option');

    // Тогл відкриття списку
    selectButton.addEventListener('click', () => {
        optionsList.classList.toggle('hidden');
    });

    // Клік по опції
    optionsList.querySelectorAll('li.saved-address').forEach(option => {
        option.addEventListener('click', () => {
            selectedOption.textContent = option.textContent.trim();
            optionsList.classList.add('hidden');
            console.log(option.dataset.shippingPostcode)
            // 3. Підставити дані в інпути
            if (option.dataset.shippingPostcode) {
                document.getElementById('shipping_postcode').value = option.dataset.shippingPostcode;
            }
            if (option.dataset.shippingBuilding) {
                document.getElementById('shipping_building').value = option.dataset.shippingBuilding;
            }
            if (option.dataset.shippingAddress) {
                document.getElementById('shipping_address').value = option.dataset.shippingAddress;
            }
            if (option.dataset.shippingCity) {
                document.getElementById('shipping_city').value = option.dataset.shippingCity;
            }
            if (option.dataset.shippingRegion) {
                document.getElementById('shipping_region').value = option.dataset.shippingRegion;
            }
            if (option.dataset.shippingEntrance) {
                document.getElementById('entrance').value = option.dataset.shippingEntrance;
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
    input[name="saved_address"]:checked + label {
        background-color: var(--color-light-orange);
    }

    input[name="saved_address"]:checked + label img {
        display: block;
    }

    input[name="saved_address"]:checked + label p {
        background-color: var(--color-olive);
    }

</style>
@endsection

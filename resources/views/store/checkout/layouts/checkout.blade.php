<x-app-layout>
    <div class="py-section relative container mx-auto">
        <div class="fixed lg:hidden top-[72px] left-0 h-1 w-full bg-white z-10">
            <div class="progress bg-olive h-full duration-500" style="width: {{ $progressWidth ?? '0%' }}"></div>
        </div>
        <div class="mb-5 lg:mb-16 opacity-80 lg:opacity-100">
            <h1 class="text-3xl lg:text-5xl font-bold flex items-center gap-x-3">
                {{ __('checkout.page_title') }}
                <span class="lg:hidden opacity-10 text-[8px]">&#11044; </span>
                <span>{{$step}}</span>
            </h1>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1fr_450px]">
            <!-- Left Column - Form -->
            <div class="order-2 lg:order-1">
                @yield('checkout-form')
            </div>

            <div class="hidden lg:block order-1 lg:order-2">
                @include('store.checkout.layouts.summary')
            </div>
        </div>
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

                // список відповідностей: data-атрибут → id інпута
                const fieldsMap = {
                    shippingIntercom: 'shipping_intercom',
                    shippingFloor: 'shipping_floor',
                    shippingEntrance: 'shipping_entrance',
                    shippingApartment: 'shipping_apartment',
                    shippingPostalCode: 'shipping_postal_code',
                    shippingBuilding: 'shipping_building',
                    shippingStreetName: 'shipping_street_name',
                    shippingCity: 'shipping_city',
                    shippingRegion: 'shipping_region',
                    billingIntercom: 'billing_intercom',
                    billingFloor: 'billing_floor',
                    billingEntrance: 'billing_entrance',
                    billingApartment: 'billing_apartment',
                    billingPostalCode: 'billing_postal_code',
                    billingBuilding: 'billing_building',
                    billingStreetName: 'billing_street_name',
                    billingCity: 'billing_city',
                    billingRegion: 'billing_region',
                };

                Object.entries(fieldsMap).forEach(([dataKey, inputId]) => {
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.value = option.dataset[dataKey] || '';
                    }
                });

                // Активувати radio (якщо є)
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
</x-app-layout>

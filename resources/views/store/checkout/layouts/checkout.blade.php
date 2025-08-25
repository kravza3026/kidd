<x-app-layout>
    <div class="py-section container mx-auto">
        <div class="mb-16">
            <h1 class="text-5xl font-bold">
                {{ __('checkout.page_title') }}
            </h1>
        </div>

        <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1fr_450px]">
            <!-- Left Column - Form -->
            <div class="order-2 lg:order-1">
                @yield('checkout-form')
            </div>

            <div class="order-1 lg:order-2">
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
                    shippingPostalCode: 'postal_code',
                    shippingBuilding: 'shipping_building',
                    shippingStreetName: 'shipping_street_name',
                    shippingCity: 'shipping_city',
                    shippingRegion: 'shipping_region',
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

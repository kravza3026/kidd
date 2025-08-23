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
</x-app-layout>

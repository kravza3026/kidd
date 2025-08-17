<x-app-layout>
    <div class="lg:max-w-5xl mx-auto bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white lg:shadow sm:rounded-xl">
            @include('store.account.nav')
            <div data-vue-component="Addresses" class="p-4 lg:p-10"></div>

            @unless ($user->shippingAddresses()->count())
            <div class="flex flex-col justify-center items-center my-12 py-12">
                <div class="flex justify-center items-center -mb-6">
                    <img src="{{ Vite::image('common/empty_addresses.jpg') }}" alt=""/>
                </div>
                <h3 class="flex justify-center items-center font-extrabold text-lg text-gray-900">
                    {{-- // TODO - Translate.--}}
                    {{ __('No saved addresses') }}
                </h3>
            </div>
            @endunless
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="lg:max-w-5xl mx-auto bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white lg:shadow sm:rounded-xl">
            @include('store.account.nav')
            <div data-vue-component="Addresses" class="p-4 lg:p-10"></div>
        </div>
    </div>
</x-app-layout>

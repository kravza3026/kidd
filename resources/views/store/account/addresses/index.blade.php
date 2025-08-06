@php use Money\Money; @endphp
<x-app-layout>
    <div class="max-w-5xl mx-auto min-h-[calc(100vh-50px)] bg-white sm:bg-transparent sm:pt-16 sm:pb-20  mx-aut">
        <div class="bg-white">
            @include('store.account.nav')

           <div data-vue-component="Addresses" class="p-10"></div>
        </div>
    </div>
</x-app-layout>

@php use Money\Money; @endphp
<x-app-layout>
    <div class="container mx-auto min-h-[calc(100vh-50px)] bg-white sm:bg-transparent sm:pt-16 sm:pb-20  mx-aut">
        <div class="bg-white">
            <div class="max-w-5xl mx-auto min-h-[calc(100vh-50px)] bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
                <div class="bg-white shadow sm:rounded-xl">
                    @include('store.account.nav')

                   <div data-vue-component="Addresses" class="p-10"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
{{--        <script src="https://unpkg.com/htmx.org@1.9.2" />--}}
    @endpush

</x-app-layout>

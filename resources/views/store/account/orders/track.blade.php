<x-app-layout>
    {{--    {{dd($order)}}--}}
    <div class="mx-auto max-w-5xl p-2 grid grid-cols-12 items-start gap-4 bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="col-span-12 lg:col-span-7 space-y-4">
            <div class="border border-light-border rounded-2xl shadow py-4">
                @include('store.account.orders.components._tracking-head')

                <div class="relative space-y-8">
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2  absolute inset-0 px-4 mt-6">
                        <div class="col-span-2  h-full flex relative  justify-center">
                            <div class="flex justify-center w-1 h-full relative bg-light-border">
                            <span class="inline-block  absolute bottom-0 w-0.5 h-[7%]"
                                  style="background: linear-gradient(0deg,rgba(168, 186, 102, 1) 60%, rgba(168, 186, 102, 0.1) 100%);"
                            ></span>
                                {{--        TODO progress in percent                    --}}
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2  flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Delivered' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Delivered' ? '/icons/white/rubine.svg' : '/icons/rubine_outline.svg') }}"
                                    alt="delivered"
                                    class="{{ $order->status->name === 'Delivered' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15 ">
                            <p class="font-bold text-base">Package delivered to client</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>
                    {{-- Waiting --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2  flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Waiting' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Waiting' ? '/icons/white/user.svg' : '/icons/user.svg') }}"
                                    alt="waiting"
                                    class="{{ $order->status->name === 'Waiting' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15 ">
                            <p class="font-bold text-base">Waiting for the client to pick up the package</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Local postal office --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2  flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'LocalPost' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'LocalPost' ? '/icons/white/marker.svg' : '/icons/marker_outline.svg') }}"
                                    alt="local post"
                                    class="{{ $order->status->name === 'LocalPost' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="font-bold text-base">Local postal office received parcel for final delivery</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Warehouse --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2 flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Warehouse' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Warehouse' ? '/icons/white/car.svg' : '/icons/car_outline.svg') }}"
                                    alt="warehouse"
                                    class="{{ $order->status->name === 'Warehouse' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="font-bold text-base">Package departed the seller's warehouse</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Carrier --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2  flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Carrier' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Carrier' ? '/icons/white/home.svg' : '/icons/home_outline.svg') }}"
                                    alt="carrier"
                                    class="{{ $order->status->name === 'Carrier' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15 ">
                            <p class="font-bold text-base">Package has been assigned to a carrier</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Assembled --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2  flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Assembled' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Assembled' ? '/icons/white/shirt.svg' : '/icons/shirt_outline.svg') }}"
                                    alt="assembled"
                                    class="{{ $order->status->name === 'Assembled' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15 ">
                            <p class="font-bold text-base">Your order has been assembled</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Processed --}}
                    <div class="grid grid-cols-12 lg:grid-cols-17 gap-x-2 px-4">
                        <div class="col-span-2 flex relative justify-center">
                            <div
                                class="size-10 {{ $order->status->name === 'Processed' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                                <img
                                    src="{{ Vite::image($order->status->name === 'Processed' ? '/icons/white/check.svg' : '/icons/check_outline.svg') }}"
                                    alt="processed"
                                    class="{{ $order->status->name === 'Processed' ? '' : 'opacity-40' }}"
                                >
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="font-bold text-base">Order processed by seller</p>
                            <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>


                </div>
            </div>
            @include('store.account.orders.components._response')
        </div>

        <div class="col-span-12 lg:col-span-5  space-y-4">
            @include('store.account.orders.components._return')
            @include('store.account.orders.components._warranty')
            @include('store.account.orders.components._questions')


        </div>
    </div>


</x-app-layout>

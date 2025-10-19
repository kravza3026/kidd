<x-app-layout>
    <div class="mx-auto grid max-w-5xl grid-cols-12 items-start gap-4 bg-white p-2 sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="col-span-12 space-y-4 lg:col-span-7">
            <div class="border-light-border rounded-2xl border py-4 shadow">
                @include('store.account.orders.components._tracking-head')

                <div class="relative space-y-8">
                    <div class="absolute inset-0 mt-6 grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex h-full justify-center">
                            <div class="bg-light-border relative flex h-full w-1 justify-center">
                                <span
                                    class="absolute bottom-0 inline-block h-[7%] w-0.5"
                                    style="
                                        background: linear-gradient(
                                            0deg,
                                            rgba(168, 186, 102, 1) 60%,
                                            rgba(168, 186, 102, 0.1) 100%
                                        );
                                    "
                                ></span>
                                {{-- TODO progress in percent --}}
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Delivered' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Delivered' ? 'icons/white/rubine.svg' : 'icons/rubine_outline.svg') }}"
                                    alt="delivered"
                                    class="{{ $order->status->name === 'Delivered' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Package delivered to client</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>
                    {{-- Waiting --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Waiting' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Waiting' ? 'icons/white/user.svg' : 'icons/user.svg') }}"
                                    alt="waiting"
                                    class="{{ $order->status->name === 'Waiting' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Waiting for the client to pick up the package</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Local postal office --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'LocalPost' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'LocalPost' ? 'icons/white/marker.svg' : 'icons/marker_outline.svg') }}"
                                    alt="local post"
                                    class="{{ $order->status->name === 'LocalPost' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Local postal office received parcel for final delivery</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Warehouse --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Warehouse' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Warehouse' ? 'icons/white/car.svg' : 'icons/car_outline.svg') }}"
                                    alt="warehouse"
                                    class="{{ $order->status->name === 'Warehouse' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Package departed the seller's warehouse</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Carrier --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Carrier' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Carrier' ? 'icons/white/home.svg' : 'icons/home_outline.svg') }}"
                                    alt="carrier"
                                    class="{{ $order->status->name === 'Carrier' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Package has been assigned to a carrier</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Assembled --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Assembled' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Assembled' ? 'icons/white/shirt.svg' : 'icons/shirt_outline.svg') }}"
                                    alt="assembled"
                                    class="{{ $order->status->name === 'Assembled' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Your order has been assembled</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>

                    {{-- Processed --}}
                    <div class="grid grid-cols-12 gap-x-2 px-4 lg:grid-cols-17">
                        <div class="relative col-span-2 flex justify-center">
                            <div
                                class="{{ $order->status->name === 'Processed' ? 'bg-olive' : 'bg-light-border' }} relative z-10 flex size-10 items-center justify-center rounded-full"
                            >
                                <img
                                    src="{{ Vite::image($order->status->name === 'Processed' ? 'icons/white/check.svg' : 'icons/check_outline.svg') }}"
                                    alt="processed"
                                    class="{{ $order->status->name === 'Processed' ? '' : 'opacity-40' }}"
                                />
                            </div>
                        </div>
                        <div class="col-span-10 lg:col-span-15">
                            <p class="text-base font-bold">Order processed by seller</p>
                            <p class="text-sm opacity-40">17 Apr 2023 at 12:58</p>
                        </div>
                    </div>
                </div>
            </div>
            @include('store.account.orders.components._response')
        </div>

        <div class="col-span-12 space-y-4 lg:col-span-5">
            @include('store.account.orders.components._return')
            @include('store.account.orders.components._warranty')
            @include('store.account.orders.components._questions')
        </div>
    </div>
</x-app-layout>

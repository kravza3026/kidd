<x-app-layout>
{{--    {{dd($order)}}--}}
    <div class="mx-auto max-w-5xl grid grid-cols-12 gap-x-4 bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="col-span-7 border border-light-border rounded-2xl shadow py-4">
            <div class="flex items-start gap-x-4 px-4">
                <a href="/" class="p-3 border border-light-border rounded-full">
                    <img class="size-3 opacity-40" src="{{Vite::image('/icons/back.svg')}}" alt="icon arrow left">
                </a>
                <div class="space-y-2">
                    <div class="flex gap-x-2 items-center">
                        <p class="font-bold text-2xl">Order tracking</p>
                        <span class="opacity-10 text-[4px]">⬤</span>
                        <p class="font-bold text-olive text-2xl">#{{$order->id}}</p>
                        <span class="inline-block text-white text-[12px] font-bold bg-olive px-3 py-1 rounded-2xl">{{ $order->status->name }}</span>
                    </div>
                    <div class="flex gap-x-2 items-center">
                        <p class="text-sm opacity-40 leading-[-2%]">Tracking code:</p>
                        <div id="copyBtn" class=" flex items-center gap-x-2 cursor-pointer">
                            <p id="copy" class="underline font-bold text-sm">UE239931833HK</p>
                            <img class="size-4 opacity-40" src="{{Vite::image('/icons/olive/copy.svg')}}" alt="icon arrow left">
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-light-border">

            <div class="relative space-y-8">
                <div class="grid grid-cols-12 gap-x-2  absolute inset-0 px-4 mt-6">
                    <div class="col-span-2  h-full flex relative  justify-center">
                        <div class="flex justify-center w-1 h-full relative bg-light-border">
                            <span class="inline-block  absolute bottom-0 w-0.5 h-[5%]"
                            style="background: linear-gradient(0deg,rgba(168, 186, 102, 1) 60%, rgba(168, 186, 102, 0.1) 100%);"
                            ></span>
{{--        TODO progress in percent                    --}}
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Delivered' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Delivered' ? '/icons/white/rubine.svg' : '/icons/rubine_outline.svg') }}"
                                alt="delivered"
                                class="{{ $order->status->name === 'Delivered' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10 ">
                        <p class="font-bold text-base">Package delivered to client</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>
                {{-- Waiting --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Waiting' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Waiting' ? '/icons/white/user.svg' : '/icons/user.svg') }}"
                                alt="waiting"
                                class="{{ $order->status->name === 'Waiting' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10 ">
                        <p class="font-bold text-base">Waiting for the client to pick up the package</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Local postal office --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'LocalPost' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'LocalPost' ? '/icons/white/marker.svg' : '/icons/marker_outline.svg') }}"
                                alt="local post"
                                class="{{ $order->status->name === 'LocalPost' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10">
                        <p class="font-bold text-base">Local postal office received parcel for final delivery</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Warehouse --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2 flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Warehouse' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Warehouse' ? '/icons/white/car.svg' : '/icons/car_outline.svg') }}"
                                alt="warehouse"
                                class="{{ $order->status->name === 'Warehouse' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10">
                        <p class="font-bold text-base">Package departed the seller's warehouse</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Carrier --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Carrier' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Carrier' ? '/icons/white/home.svg' : '/icons/home_outline.svg') }}"
                                alt="carrier"
                                class="{{ $order->status->name === 'Carrier' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10 ">
                        <p class="font-bold text-base">Package has been assigned to a carrier</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Assembled --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Assembled' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Assembled' ? '/icons/white/shirt.svg' : '/icons/shirt_outline.svg') }}"
                                alt="assembled"
                                class="{{ $order->status->name === 'Assembled' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10 ">
                        <p class="font-bold text-base">Your order has been assembled</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Processed --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2 flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Processed' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Processed' ? '/icons/white/check.svg' : '/icons/check_outline.svg') }}"
                                alt="processed"
                                class="{{ $order->status->name === 'Processed' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10">
                        <p class="font-bold text-base">Order processed by seller</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

                {{-- Delivered --}}
                <div class="grid grid-cols-12 gap-x-2 px-4">
                    <div class="col-span-2  flex relative justify-center">
                        <div class="size-10 {{ $order->status->name === 'Delivered' ? 'bg-olive' : 'bg-light-border' }} rounded-full flex justify-center items-center relative z-10">
                            <img
                                src="{{ Vite::image($order->status->name === 'Delivered' ? '/icons/white/rubine.svg' : '/icons/rubine_outline.svg') }}"
                                alt="delivered"
                                class="{{ $order->status->name === 'Delivered' ? '' : 'opacity-40' }}"
                            >
                        </div>
                    </div>
                    <div class="col-span-10">
                        <p class="font-bold text-base">Package delivered to client</p>
                        <p class="opacity-40 text-sm">17 Apr 2023 at 12:58</p>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-span-5 grid gap-y-4">
            <div class="border border-light-border space-y-4 rounded-2xl p-3 shadow">
                <div>
                    <p class="font-bold text-2xl">Return information</p>
                    <p class="text-sm">Product doesn't match of fit? You can contact us for return within 14 days of receiving it!</p>
                </div>
                <x-ui.button as="a" left_icon="false" right_icon="false"  class=" font-bold text-sm">
                    <img class="size-5" src="{{Vite::image('/icons/return.svg')}}" alt="icon return">
                    Ask for return</x-ui.button>
            </div>
            <div class="border border-light-border space-y-4 rounded-2xl p-3 shadow">
                <p class="font-bold text-2xl">Frequent questions</p>
                <div>
                    <p class="text-sm">Can I change my delivery address after I have placed my order?</p>
                    <p class="opacity-40 text-[12px]">Last updated 2 days ago</p>
                </div>
                <div>
                    <p class="text-sm">What happens if I'm out and miss my delivery?</p>
                    <p class="opacity-40 text-[12px]">Last updated 2 weeks ago</p>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>

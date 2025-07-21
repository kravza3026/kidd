<x-app-layout>
    <div class="max-w-7xl w-full mx-auto">
        <div class="w-full px-4 py-5 sm:pt-10 pb-16 lg:px-8">
            <h2 class="mb-4 inline-block relative text-5xl font-bold leading-[62px] tracking-[-2%] text-charcoal/80">
                My Cart
                <x-ui.badge class="absolute text-white text-xl font-bold size-7 rounded-full -right-10 top-0 bg-olive">{{ $count ?? 0 }}</x-ui.badge>
            </h2>


            <div class="w-full flex gap-x-16">
                <div class="w-full flex grow basis-full shrink-1 mt-4">
                    <div class="flex flex-col space-y-6 w-full last:[&>div]:border-b-0">
                        <input type="checkbox" name="cart_product[]" id="check_all" value="all" class="shrink-0 border-gray-300 rounded text-olive focus:ring-dark-olive">
                        @forelse($items as $item)
                            @include('store.cart.partials.product-row')
                        @empty
                            <p>No products found</p>
                        @endforelse

                    </div>
                </div>
                <div class="w-full grow-0 flex-shrink-0 basis-[340px] flex border border-[#eeeeee]/70 rounded-xl shadow-lg">
                    <div class="text-nowrap w-full p-6">
                        <h4 class="flex pb-6 w-full text-2xl text-gray-800 font-bold leading-6 tracking-[-2%]">
                            Order summary
                        </h4>

                        <div class="flex w-full flex-col py-6 border-y border-dark-snow space-y-4 divide-y divide-dotted divide-black/50">
                            <div class="flex w-full justify-between">
                                <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                                    Products
                                </span>
                                <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                    {{ $sub_total }} lei
                                </span>
                            </div>

                            @if($count)
                                @foreach($coupons ?? [] as $coupon)
                                    <div class="flex w-full justify-between">
                                    <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                                        {{ $coupon->options['description'] }}
                                    </span>
                                        <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                        - {{ round($coupon->discounted/100) }} lei
                                    </span>
                                    </div>
                                @endforeach

                                @foreach($fees ?? [] as $fee)
                                    <div class="flex w-full justify-between">
                                    <span class="font-normal text-base tracking-[-2%] text-charcoal/40">
                                        {{ $fee->options['description'] }}
                                    </span>
                                        <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                        {{ $fee->amount/100 }} lei
                                    </span>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="flex w-full pt-6 justify-between">
                            <span class="font-medium text-base tracking-[-2%] text-charcoal">
                                Grand total
                            </span>
                            <span class="font-extrabold text-base tracking-[-2%] text-charcoal">
                                {{ $total }} lei
                            </span>
                        </div>

                        <div class="flex w-full pt-6">
                            <x-primary-button hx-get="{{ url('cart.index') }}" hx-target="#cart" hx-swap="outerHTML" class="!w-full">
                                Continue to checkout
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-2 size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>
                                </svg>
                            </x-primary-button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

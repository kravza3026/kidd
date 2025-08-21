@use('Money\Currency;use Money\Money; use Money\Currencies\ISOCurrencies; use Money\Formatter\IntlMoneyFormatter')
<div class="order-1 lg:order-2">

    <div class=" bg-white shadow rounded-2xl p-6">
        <h2 class="text-2xl font-bold mb-6">{{ __('Products') }}</h2>

        <!-- Order Items -->
        <div class="space-y-4 max-h-[40vh] overflow-y-auto">
            @foreach($items as $item)
                <div class="grid grid-cols-12 items-start gap-2">
                    <div class="bg-light-orange rounded-xl p-2 w-[72px] h-[72px] col-span-3">
                        <img src="{{ Vite::image($item->model->main_image) }}" alt="{{ $item->model->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 col-span-6">
                        <p class="font-bold truncate">{{ $item->model->name }}</p>
                        <div class="flex gap-2 text-sm text-charcoal/60">

                            <p class="size-4 rounded-full border border-light-border" style="background-color: {{ $item->variant->color->hex }}"></p>
                            <span class="truncate">{{ $item->variant->color->name }}</span>
                            <span>|</span>
                            <span>{{ $item->variant->size->name }}</span>
                        </div>
                        <p class="text-sm font-bold">×{{ $item->qty }}</p>

                    </div>
                    <div class="flex justify-between col-span-2">
                        <span class="font-bold text-olive text-nowrap">{{ $item->price / 100}} lei</span>
                    </div>
                </div>
            @endforeach
        </div>

        <hr class="my-6 border-light-border">
        <!-- Order Totals -->
        <div class="space-y-3 ">
            <p class="text-2xl font-bold">Discount code</p>
            <p class="text-sm">New customer? <a class="text-olive font-bold" href="/login">Sign up</a> to get a 25% discount</p>
            <form class="flex items-center gap-x-4 " action="">
                <input type="text" class="w-2/3 border border-light-border h-12 px-4 rounded-xl" placeholder="Enter code">
                <x-primary-button as="button" class="px-15 !py-4" right_icon="false"  type="submit">Apply</x-primary-button>
            </form>
            <hr class="my-6 border-light-border">
            <p class="text-2xl font-bold">Order summary</p>
            @foreach($fees as $fee)
                <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-bold">
                    {{ $fee->options['description'] }}
                </span>
                    <span class="font-bold">
                    {{ $fee->amount / 100 }} MDL
                </span>
                </div>
            @endforeach
            @foreach($coupons as $coupon)
                <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    {{ $coupon->options['description'] }} [<i class="font-bold">{{ $coupon->code }}</i>]
                </span>
                    <span class="font-bold">

                    -{{ round(($coupon->discounted) / 100, 0, PHP_ROUND_HALF_EVEN) }} MDL
                </span>
                </div>
            @endforeach
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60">{{ __('checkout.products') }}</span>
                <span class="font-bold">{{ $sub_total }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60">{{ __('checkout.shipment_cost') }}</span>
                <span class="font-bold">{{ $fee_sub_total }}</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60">{{ __('checkout.discount') }}</span>
                <span class="font-bold">{{ $total_discount }}</span>
            </div>
            <hr class="my-2 border-light-border">
            <div class="flex justify-between text-base font-bold pt-3">
                <span>{{ __('checkout.grand_total') }}</span>
                <span>{{ $total }} lei</span>
            </div>
        </div>
    </div>
    <div class="mt-6 gradient_r-b_dark min-h-50 w-full !rounded-2xl relative">
        <span class="absolute inset-0 bg-charcoal/20 rounded-2xl"></span>
        <div class="relative text-white z-10 p-4">
            <p class="text-2xl">Discount on delivery cost</p>
            <p class="text-sm">Add goods worth more than 465 lei
                and get discount on delivery</p>
            <div class="progress relative mt-5">
                <div class="flex w-full text-sm mb-2">
                    <p class=" bg-white flex items-center rounded-full px-0 py-0.5">
                        <span class="inline-block text-sm font-bold bg-gradient-to-r gradient_r-b_dark bg-clip-text text-transparent brightness-80">
                            1035 lei
                        </span></p>
                    <span class="w-[calc(45%-5rem)] !max-w-[60%]"></span>
                    <p class="relative border-2 font-bold border-white rounded-2xl px-2 py-0.5 flex items-center ">+465 lei</p>
                </div>
                <div class="relative w-full h-1.5 bg-white/20 rounded-full">
                    <span class="absolute top-0 left-0 h-1.5 bg-white w-[45%] rounded-full"></span>
                </div>
            </div>
        </div>
    </div>

</div>

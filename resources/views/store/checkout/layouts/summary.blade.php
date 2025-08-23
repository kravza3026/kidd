@use('Money\Currency;use Money\Money; use Money\Currencies\ISOCurrencies; use Money\Formatter\IntlMoneyFormatter')
<div class="rounded-2xl bg-white p-6 shadow">
    <h2 class="mb-6 text-2xl font-bold">{{ __('Products') }}</h2>

    <!-- Order Items -->
    <div class="max-h-[40vh] space-y-4 overflow-y-auto">
        @foreach ($items as $item)
            <div class="grid grid-cols-12 items-start gap-2">
                <div class="bg-light-orange col-span-3 h-[72px] w-[72px] rounded-xl p-2">
                    <img
                        src="{{ Vite::image($item->model->main_image) }}"
                        alt="{{ $item->model->name }}"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="col-span-6 flex-1">
                    <p class="truncate font-bold">{{ $item->model->name }}</p>
                    <div class="text-charcoal/60 flex gap-2 text-sm">
                        <p
                            class="border-light-border size-4 rounded-full border"
                            style="background-color: {{ $item->variant->color->hex }}"
                        ></p>
                        <span class="truncate">{{ $item->variant->color->name }}</span>
                        <span>|</span>
                        <span>{{ $item->variant->size->name }}</span>
                    </div>
                    <p class="text-sm font-bold">×{{ $item->qty }}</p>
                </div>
                <div class="col-span-2 flex justify-between">
                    <span class="text-olive font-bold text-nowrap">{{ $item->price / 100 }} lei</span>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="border-light-border my-6" />
    <!-- Order Totals -->
    <div class="space-y-3">
        <p class="text-2xl font-bold">Discount code</p>
        <p class="text-sm">
            New customer?
            <a class="text-olive font-bold" href="/login">Sign up</a>
            to get a 25% discount
        </p>
        <form class="flex items-center gap-x-4" action="">
            <input type="text" class="border-light-border h-12 w-2/3 rounded-xl border px-4" placeholder="Enter code" />
            <x-primary-button as="button" class="px-15 !py-4" right_icon="false" type="submit">Apply</x-primary-button>
        </form>
        <hr class="border-light-border my-6" />
        <p class="text-2xl font-bold">Order summary</p>
        @foreach ($fees as $fee)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-bold">
                    {{ $fee->options['description'] }}
                </span>
                <span class="font-bold">{{ $fee->amount / 100 }} MDL</span>
            </div>
        @endforeach

        @foreach ($coupons as $coupon)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    {{ $coupon->options['description'] }} [
                    <i class="font-bold">{{ $coupon->code }}</i>
                    ]
                </span>
                <span class="font-bold">-{{ round(($coupon->discounted) / 100, 0, PHP_ROUND_HALF_EVEN) }} MDL</span>
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
        <hr class="border-light-border my-2" />
        <div class="flex justify-between pt-3 text-base font-bold">
            <span>{{ __('checkout.grand_total') }}</span>
            <span>{{ $total }} lei</span>
        </div>
    </div>
</div>
<div class="gradient_r-b_dark relative mt-6 min-h-50 w-full !rounded-2xl">
    <span class="bg-charcoal/20 absolute inset-0 rounded-2xl"></span>
    <div class="relative z-10 p-4 text-white">
        <p class="text-2xl">Discount on delivery cost</p>
        <p class="text-sm">Add goods worth more than 465 lei and get discount on delivery</p>
        <div class="progress relative mt-5">
            <div class="mb-2 flex w-full text-sm">
                <p class="flex items-center rounded-full bg-white px-0 py-0.5">
                    <span
                        class="gradient_r-b_dark inline-block bg-gradient-to-r bg-clip-text text-sm font-bold text-transparent brightness-80"
                    >
                        1035 lei
                    </span>
                </p>
                <span class="w-[calc(45%-5rem)] !max-w-[60%]"></span>
                <p class="relative flex items-center rounded-2xl border-2 border-white px-2 py-0.5 font-bold">
                    +465 lei
                </p>
            </div>
            <div class="relative h-1.5 w-full rounded-full bg-white/20">
                <span class="absolute top-0 left-0 h-1.5 w-[45%] rounded-full bg-white"></span>
            </div>
        </div>
    </div>
</div>

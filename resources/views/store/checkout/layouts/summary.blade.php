@use('Money\Currency;use Money\Money; use Money\Currencies\ISOCurrencies; use Money\Formatter\IntlMoneyFormatter')
<div class="rounded-2xl bg-white p-6 shadow">
    <h2 class="mb-6 text-2xl font-bold">{{ __('checkout.summary.sections.products.title') }}</h2>

    <!-- Order Items -->
    <div class="max-h-[40vh] space-y-4 overflow-y-auto">
        @foreach ($items as $item)
            <div class="flex items-start gap-3">
                <div class="bg-light-orange h-[72px] w-[72px] rounded-xl p-2">
                    <img
                        src="{{ Vite::image($item->model->main_image) }}"
                        alt="{{ $item->model->name }}"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="flex flex-1 flex-col gap-y-1">
                    <p class="font-medium text-pretty">{{ $item->model->name }}</p>
                    <div class="text-charcoal/60 flex items-center gap-x-2 text-sm">
                        <div class="flex items-center gap-x-1">
                            <span
                                class="border-light-border size-4 rounded-full border shadow-xs"
                                style="background-color: {{ $item->variant->color->hex }}"
                            ></span>
                            <span class="truncate">{{ $item->variant->color->name }}</span>
                        </div>
                        <span>|</span>
                        <span>{{ $item->variant->size->name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <p class="flex items-center text-sm font-bold">×{{ $item->qty }}</p>
                        <div class="flex items-center gap-x-1.5">
                            <span class="text-dark/60 font-light text-nowrap line-through">
                                {{ __('general.price', ['price' => number_format(Money::MDL($item->variant->price_online)->getAmount() / 100, 2)]) }}
                            </span>
                            <span class="text-olive font-bold text-nowrap">
                                {{ __('general.price', ['price' => number_format(Money::MDL($item->variant->price_final)->getAmount() / 100, 2)]) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="border-light-border my-6" />
    <!-- Order Totals -->
    <div class="space-y-3">
        <p class="text-2xl font-bold">
            {{ __('checkout.summary.sections.discount.title') }}
        </p>
        <p class="text-sm">
            {!! __('checkout.summary.sections.discount.not_registered.text', ['href' => route('register'), 'amount' => 10]) !!}
        </p>
        <form class="flex items-center gap-x-3" action="">
            <input
                type="text"
                class="border-light-border h-12 flex-1 rounded-xl border px-4"
                placeholder="{{ __('checkout.summary.sections.discount.code_placeholder') }}"
            />
            <x-primary-button as="button" class="w-auto px-6 !py-3 !leading-5" right_icon="false" type="submit">
                {{ __('checkout.summary.sections.discount.apply_btn') }}
            </x-primary-button>
        </form>
        <hr class="border-light-border my-6" />
        <p class="text-2xl font-bold">
            {{ __('checkout.summary.sections.summary.title') }}
        </p>

        <div class="flex justify-between text-sm font-medium">
            <span class="text-charcoal/60">{{ __('checkout.summary.sections.summary.subtotal') }}</span>
            <span class="font-bold">
                {{ __('general.price', ['price' => number_format($sub_total, 2)]) }}
            </span>
        </div>

        @foreach ($fees as $fee)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    {{-- {{ $fee->options['description'] }} --}}
                    {{ __('checkout.summary.sections.summary.shipping') }}
                </span>
                <span class="font-bold">
                    {{ __('general.price', ['price' => number_format($fee->amount / 100, 2)]) }}
                </span>
            </div>
        @endforeach

        {{-- <div class="flex justify-between text-sm"> --}}
        {{-- <span class="text-charcoal/60">{{ __('checkout.summary.sections.summary.shipping') }}</span> --}}
        {{-- <span class="font-bold"> --}}
        {{-- {{ __('general.price', ['price' => round(Money::MDL(intval($fee->amount))->getAmount() / 100, 0, PHP_ROUND_HALF_EVEN)]) }} --}}
        {{-- </span> --}}
        {{-- </div> --}}

        @foreach ($coupons as $coupon)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    {{ $coupon->options['description'] }} [
                    <i class="font-bold">{{ $coupon->code }}</i>
                    ]
                </span>
                <span class="font-bold">
                    -{{ __('general.price', ['price' => number_format(($coupon->discounted) / 100, 2)]) }}
                </span>
            </div>
        @endforeach

        <hr class="border-light-border my-2" />
        <div class="flex justify-between pt-3 text-base font-bold">
            <span>{{ __('checkout.summary.sections.summary.total') }}</span>
            <span>
                {{ __('general.price', ['price' => number_format($total, 2)]) }}
            </span>
        </div>
    </div>
</div>
<div class="gradient_r-b_dark relative mt-6 min-h-50 w-full !rounded-2xl">
    <span class="bg-charcoal/20 absolute inset-0 rounded-2xl"></span>
    <div class="relative z-10 p-4 text-white">
        <p class="text-2xl">
            {{ __('checkout.summary.sections.delivery_discount.title') }}
        </p>
        <p class="text-sm">
            {{
                __('checkout.summary.sections.delivery_discount.desc', ['amount' => ($total < config('laracart.free_delivery_after')) ? config('laracart.free_delivery_after', 1000) - (int) round(
                    $total,
                    0,
                    PHP_ROUND_HALF_UP
                ) : 0])
            }}
        </p>
        <div class="progress relative mt-5">
            <div class="mb-2 flex w-full text-sm">
                <p class="flex items-center rounded-full bg-white px-0 py-0.5">
                    <span
                        class="gradient_r-b_dark inline-block bg-gradient-to-r bg-clip-text text-sm font-bold text-transparent brightness-80"
                    >
                        {{ __('checkout.summary.sections.delivery_discount.price', ['amount' => ($total < config('laracart.free_delivery_after')) ? Money::MDL((int) round($total, 0, PHP_ROUND_HALF_UP))->getAmount() : config('laracart.free_delivery_after')]) }}
                    </span>
                </p>
                {{-- TODO add progress in % --}}
                <span
                    class="-mr-20 max-w-[calc(100%-75px)]"
                    style="
                        width: {{ ($total < config('laracart.free_delivery_after')) ? (int) (round($total, 0, PHP_ROUND_HALF_UP) / 10) : 100 }}%;
                    "
                ></span>
                <p class="relative flex items-center rounded-2xl border-2 border-white px-2 py-0.5 font-bold">
                    +
                    {{
                        __('checkout.summary.sections.delivery_discount.price', ['amount' => ($total < config('laracart.free_delivery_after')) ? config('laracart.free_delivery_after', 1000) - (int) round(
                            $total,
                            0,
                            PHP_ROUND_HALF_UP
                        ) : 0])
                    }}
                </p>
            </div>
            <div class="relative h-1.5 w-full rounded-full bg-white/20">
                <span
                    class="absolute top-0 left-0 h-1.5 rounded-full bg-white"
                    style="
                        width: {{ ($total < config('laracart.free_delivery_after')) ? (int) (round($total, 0, PHP_ROUND_HALF_UP) / 10) : 100 }}%;
                    "
                ></span>
            </div>
        </div>
    </div>
</div>

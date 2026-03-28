@use('Money\Currency;use Money\Money; use Money\Currencies\ISOCurrencies; use Money\Formatter\IntlMoneyFormatter')
<div class="rounded-2xl border-0! bg-white md:p-6 md:shadow">
    <h2 class="mb-6 text-2xl font-bold">{{ __('checkout.summary.sections.products.title') }}</h2>

    <!-- Order Items -->
    <div class="max-h-[44vh] space-y-4 overflow-y-auto rounded-2xl p-4 shadow md:rounded-none md:p-0 md:shadow-none">
        @foreach ($items as $item)
            {!! $item->model->getFirstMedia() !!}
            <div class="flex items-start gap-3">
                <div class="bg-light-orange h-18 w-18 rounded-xl p-2">
                    <img
                        src="{{ $item->model->media[0]->original_url }}"
                        alt="{{ $item->model->name }}"
                        class="h-full w-auto object-cover"
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
                                {{ __('general.price', ['price' => number_format(Money::MDL($item->variant->price_online)->getAmount() / 100, 0)]) }}
                            </span>
                            <span class="text-olive font-bold text-nowrap">
                                {{ __('general.price', ['price' => number_format(Money::MDL($item->variant->price_final)->getAmount() / 100, 0)]) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="border-light-border my-6 hidden md:block" />
    <!-- Order Totals -->
    <div class="mt-6 space-y-3 md:mt-0">
        <p class="text-2xl font-bold">
            {{ __('checkout.summary.sections.discount.title') }}
        </p>
        @guest
            <p class="text-sm">
                {!! __('checkout.summary.sections.discount.not_registered.text', ['href' => route('register'), 'amount' => 10]) !!}
            </p>
        @endguest

        <form class="grid w-full grid-cols-1 gap-y-5" action="">
            <div class="flex w-auto items-center justify-between gap-x-3">
                <input
                    type="text"
                    class="border-light-border h-12 w-full min-w-auto rounded-xl border px-5"
                    placeholder="{{ __('checkout.summary.sections.discount.code_placeholder') }}"
                />
                <x-primary-button
                    as="button"
                    class="!w-auto !min-w-fit !px-7 !py-3 !leading-5"
                    right_icon="false"
                    type="submit"
                >
                    {{ __('checkout.summary.sections.discount.apply_btn') }}
                </x-primary-button>
            </div>

            <div
                class="border-light-border flex h-14 w-full items-center justify-between gap-x-3 rounded-xl border bg-[#F8F7F2] px-5"
            >
                <span>SUMMER10</span>
                <span
                    class="gradient_r-b_dark mask-b-to-[#000] !px-1.5 !py-0.5 text-xs leading-4 font-extrabold tracking-[-2%] text-white"
                >
                    -25%
                </span>
            </div>
        </form>
        <hr class="border-light-border my-6" />
        <p class="text-2xl font-bold">
            {{ __('checkout.summary.sections.summary.title') }}
        </p>

        <div class="flex justify-between text-sm font-medium">
            <span class="text-charcoal/60">{{ __('checkout.summary.sections.summary.subtotal') }}</span>
            <span class="font-bold">
                {{ __('general.price', ['price' => number_format($sub_total, 0)]) }}
            </span>
        </div>

        @foreach ($fees as $fee)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    {{-- {{ $fee->options['description'] }} --}}
                    {{ __('checkout.summary.sections.summary.shipping') }}
                </span>
                <span class="font-bold">
                    {{ __('general.price', ['price' => number_format($fee->amount / 100, 0)]) }}
                </span>
            </div>
        @endforeach

        @foreach ($coupons as $coupon)
            <div class="flex justify-between text-sm">
                <span class="text-charcoal/60 font-medium">
                    <i class="font-bold">{{ $coupon->code }}</i>
                </span>
                <span class="font-bold">
                    - {{ __('general.price', ['price' => number_format(($coupon->discounted) / 100, 0)]) }}
                </span>
            </div>
        @endforeach

        <hr class="border-light-border my-2" />
        <div class="flex items-center justify-between pt-3 text-base font-bold">
            <span>{{ __('checkout.summary.sections.summary.total') }}</span>
            <span>
                {{ __('general.price', ['price' => number_format($total, 0)]) }}
            </span>
        </div>
    </div>
</div>
<div class="gradient_r-b_dark relative mt-6 min-h-50 w-full !rounded-2xl">
    <span class="bg-charcoal/20 absolute inset-0 rounded-2xl"></span>
    <div class="relative z-[5] p-4 text-white">
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
                <span
                    class="-mr-20 max-w-[calc(100%-85px)]"
                    style="
                        width: {{ $total > 250 && ($total < config('laracart.free_delivery_after')) ? (int) (round($total, 0, PHP_ROUND_HALF_UP) / 10) : 90 }}%;
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

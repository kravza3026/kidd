<div class="border-light-border accordion-item my-2 rounded-2xl border">
    <input type="checkbox" @checked($loop->first) id="order_{{ $order->id }}" class="peer hidden" />
    <label
        for="order_{{ $order->id }}"
        class="bg-light-orange relative hidden cursor-pointer items-center rounded-2xl p-6 duration-300 peer-checked:rounded-b-none lg:grid lg:grid-cols-12 peer-checked:[&_.accordion-arrow]:rotate-0"
    >
        <div class="col-span-3 text-base text-inherit">
            {!! __('order.table_row.order_number') !!}
            <span class="font-bold">{{ $order->order_number }}</span>
        </div>
        <span class="col-span-2 text-xs">
            <span class="bg-olive rounded-full px-2 py-1 font-bold text-white capitalize">
                {{ $order->status->label() }}
            </span>
        </span>
        <span class="col-span-1 text-base">{{ $order->items->sum('quantity') }}</span>
        <span class="col-span-2 text-base">
            {{ $order->placed_at->isoFormat('DD MMM YYYY') }}
        </span>
        <span class="col-span-2 text-base">
            {{ $order->delivered_at ? $order->delivered_at->isoFormat('DD MMM YYYY') : '—' }}
        </span>
        <span class="text-olive col-span-2 text-base font-bold">
            {{ __('order.table_row.price', ['price' => (int) round($order->total_amount / 100, 2, PHP_ROUND_HALF_UP)]) }}
        </span>

        <span
            class="border-light-border absolute right-6 flex h-8 w-8 items-center justify-center rounded-full border bg-white p-2"
        >
            <img
                class="accordion-arrow rotate-180 opacity-40 transition-transform duration-300"
                src="{{ Vite::image('icons/top_arrow.svg') }}"
                alt="arrow up"
            />
        </span>
    </label>

    <label
        for="order_{{ $order->id }}"
        class="accordion-header border-light-border peer-checked:[&_.accordion-arrow]:text-olive block rounded-2xl border p-0 duration-300 peer-checked:!rounded-b-none lg:hidden peer-checked:[&_.accordion-arrow]:rotate-0 peer-checked:[&_.accordionTitle]:rounded-b-none"
    >
        <!-- arbitrary variant для svg -->
        <span class="accordionTitle bg-light-orange relative grid grid-cols-3 items-center rounded-2xl p-6">
            <span class="col-span-2">
                <span class="flex items-center gap-x-2 font-bold">
                    <span class="text-xl">
                        <span class="font-bold">{{ $order->order_number }}</span>
                    </span>
                    <span class="bg-olive size-4 rounded-full"></span>
                </span>
                <span class="py-1 text-sm leading-0 opacity-40">
                    {{ __('order.table_heading.placed_at_date', ['date' => $order->placed_at->isoFormat('DD MMM YYYY')]) }}
                </span>
            </span>
            <span class="col-span-1 flex items-center justify-end gap-x-2 font-bold">
                <span class="text-olive font-bold">
                    {{ __('order.table_row.price', ['price' => (int) round($order->total_amount / 100, 0, PHP_ROUND_HALF_UP)]) }}
                </span>
                <span>
                    <svg
                        class="accordion-arrow rotate-0 transition-transform duration-300"
                        width="14"
                        height="8"
                        viewBox="0 0 14 8"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M12.3346 6.66668L7.0013 1.33334L1.66797 6.66668"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </span>
        </span>
    </label>

    <div
        class="h-0 origin-top scale-y-0 opacity-0 transition-transform duration-300 peer-checked:h-auto peer-checked:scale-y-100 peer-checked:opacity-100"
    >
        <div class="p-3 lg:p-6">
            <div class="grid grid-cols-20 items-center justify-between gap-3 lg:gap-7">
                <p class="col-span-20 m-0 text-lg font-bold lg:col-span-10">
                    {{ __('order.titles.delivery') }}
                </p>
                <div
                    class="order-last col-span-20 flex items-center justify-start lg:order-none lg:col-span-10 lg:justify-end"
                >
                    <a href="{{ route('orders.track', $order) }}" class="inline-flex w-auto items-center font-bold">
                        <div class="border-light-border flex w-full min-w-fit gap-2 rounded-full border px-3 py-2">
                            <img
                                src="{{ Vite::image('icons/olive/truck_active.svg') }}"
                                alt="{{ __('order.delivery.track_button') }}"
                            />
                            <span class="text-olive text-sm">{{ __('order.delivery.track_button') }}</span>
                        </div>
                    </a>
                </div>

                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_region') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->region->name }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_city') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->city->name }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_street_name') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->street_name }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_building') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->building }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_apartment') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->apartment }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_entrance') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->entrance }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_floor') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->floor }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_intercom') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->intercom }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_postal_code') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->shipping->postal_code }}</span>
                </p>

                <p
                    class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:col-start-1 lg:grid"
                >
                    <span class="opacity-40">{{ __('order.delivery.delivery_method') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->shipping_method->label() }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-4 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_tracking') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">PM239931833US</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.delivery.delivery_vendor') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">Poșta Moldovei</span>
                </p>
            </div>
        </div>
        <div class="border-light-border w-full border-y p-3 lg:p-6">
            <div class="grid w-full grid-cols-20 items-center justify-between gap-3 lg:gap-7">
                @auth
                    <p class="col-span-20 m-0 text-lg font-bold lg:col-span-10">
                        {{ __('order.titles.contact') }}
                    </p>
                    <div
                        class="col-span-20 flex w-full items-center justify-start gap-x-2 lg:order-none lg:col-span-10 lg:justify-end"
                    >
                        <a href="{{ route('profile.edit') }}" class="order-last flex w-auto items-center font-bold">
                            <div class="border-light-border flex w-full gap-2 rounded-full border px-3 py-2">
                                <img
                                    src="{{ Vite::image('icons/olive/user_active.svg') }}"
                                    alt="{{ __('order.contact.edit_button') }}"
                                />
                                <span class="text-olive text-sm">{{ __('order.contact.edit_button') }}</span>
                            </div>
                        </a>
                    </div>
                @endauth

                <p class="col-span-20 flex items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.contact.form.first_name') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->first_name }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.contact.form.last_name') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->last_name }}
                    </span>
                </p>
                <p class="text-basee col-span-20 flex min-w-full items-center justify-between lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.contact.form.phone') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->phone }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.contact.form.email') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->email }}
                    </span>
                </p>
            </div>
        </div>
        <div class="w-full p-3 lg:p-6">
            <h2 class="text-lg font-bold">{{ __('order.titles.products') }}</h2>
            <div class="grid grid-cols-1 gap-4 py-2 md:grid-cols-4">
                @foreach ($order->items as $product)
                    @include('store.account.orders.components._order-product-item', compact('product'))
                @endforeach
            </div>
        </div>

        <div class="border-light-border lg:border-t-none w-full border-t p-3 lg:p-6">
            <div class="grid grid-cols-20 items-center justify-start gap-3 lg:gap-7">
                <h2 class="col-span-20 m-0 text-lg font-bold lg:col-span-10">{{ __('order.titles.payment') }}</h2>
                <div class="order-last col-span-20 flex lg:order-none lg:col-span-10 lg:justify-end">
                    <a href="{{ route('orders.invoice', $order) }}" class="flex min-w-fit items-center font-bold">
                        <div class="border-light-border flex w-fit gap-2 rounded-full border px-3 py-2">
                            <img
                                src="{{ Vite::image('icons/olive/print.svg') }}"
                                alt="{{ __('order.payment.print_button') }}"
                            />
                            <span class="text-olive text-sm">{{ __('order.payment.print_button') }}</span>
                            <img class="rotate-180" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="arrow down" />
                        </div>
                    </a>
                </div>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.first_name') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->first_name }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.last_name') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{ $order->customer->last_name }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.payment_method') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="text-end font-bold lg:text-start">
                        {{ $order->payment_method->labelWithDesc() }}
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.coupon_code') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">
                        {{-- TODO - Display discount code/s --}}
                        @forelse ($order->cart_snapshot['coupons'] as $coupon)
                            {{ $coupon['code'] }}
                            <span class="text-dark">
                                (-{{ ! is_int($coupon['value']) ? $coupon['value'] * 100 : $coupon['value'] / 100 }}%)
                            </span>
                        @empty
                            --
                        @endforelse
                    </span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-5 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.billing_postal_code') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="font-bold">{{ $order->billing->postal_code }}</span>
                </p>
                <p class="col-span-20 flex min-w-full items-center justify-between text-base lg:col-span-10 lg:grid">
                    <span class="opacity-40">{{ __('order.payment.billing_address') }}</span>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <span class="text-end font-bold lg:text-start">
                        {{ $order->billing->region->name }}, {{ $order->billing->city->name }},
                        {{ $order->billing->street_name }}
                        {{ $order->billing->building }}
                        {{ $order->billing->apartment ? ',ap.'.$order->billing->apartment : '' }}
                    </span>
                </p>
                <hr class="border-light-border col-span-20 border-b" />
                <div class="col-span-20 flex items-center justify-between">
                    <p class="text-base opacity-40">{{ __('order.totals.subtotal') }}</p>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <p class="text-base font-bold">
                        {{ __('general.price', ['price' => $order->items->sum('total_price') / 100]) }}
                    </p>
                </div>
                <div class="col-span-20 flex items-center justify-between">
                    <p class="text-base opacity-40">{{ __('order.totals.discount') }}</p>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <p class="text-base font-bold">
                        @forelse ($order->cart_snapshot['coupons'] as $coupon)
                            {{ __('order.table_row.price', ['price' => (int) round($coupon['discounted'] / 100, 2, PHP_ROUND_HALF_UP)]) }}
                        @empty
                            -
                        @endforelse
                    </p>
                </div>
                <div class="col-span-20 flex items-center justify-between">
                    <p class="text-base opacity-40">{{ __('order.totals.shipping') }}</p>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <p class="text-base font-bold">
                        {{ __('general.price', ['price' => 5000 / 100]) }}
                    </p>
                </div>
                <div class="col-span-20 flex items-center justify-between">
                    <p class="text-base font-bold">{{ __('order.totals.total') }}</p>
                    <span class="characteristics-dotted mx-2 mt-3 flex-1 opacity-10 lg:hidden"></span>
                    <p class="text-olive text-base font-bold">
                        {{ __('general.price', ['price' => $order->total_amount / 100]) }}
                    </p>
                </div>
            </div>
        </div>

        @if ($order->status->isReturnable())
            <div class="w-full p-3 lg:p-6">
                <div class="bg-light-orange rounded-2xl p-4">
                    <h2 class="text-bold text-2xl font-bold">
                        {{ __('order.return.title') }}
                    </h2>
                    <p class="py-4 text-base opacity-60">
                        {{ __('order.return.description') }}
                    </p>
                    <x-ui.button
                        as="a"
                        class="min-w-fit"
                        href="{{ route('orders.return', $order) }}"
                        left_icon="false"
                        right_icon="false"
                    >
                        <img src="{{ Vite::image('icons/return.svg') }}" alt="return icon" />
                        {{ __('order.return.return_button') }}
                    </x-ui.button>
                </div>
            </div>
        @endif
    </div>
</div>

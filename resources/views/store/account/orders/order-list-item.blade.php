<div class="border-light-border accordion-item my-2 rounded-2xl border">
    <input type="checkbox" checked id="order_{{ $order->id }}" class="peer hidden" />
    <label
        for="order_{{ $order->id }}"
        class="bg-light-orange relative hidden cursor-pointer items-center rounded-2xl p-6 duration-300 lg:grid lg:grid-cols-12 peer-checked:[&_.accordion-arrow]:rotate-180"
    >
        <span class="col-span-3 text-lg font-bold">
            Order #
            <span>{{ $order->order_number }}</span>
        </span>
        <span class="col-span-2 text-xs">
            <span class="bg-olive rounded-full px-2 py-1 font-bold text-white capitalize">
                {{ $order->status }}
            </span>
        </span>
        <span class="col-span-1 text-base">{{ $order->items->sum('quantity') }}</span>
        <span class="col-span-2 text-base">
            {{ $order->placed_at->format('d M Y') }}
        </span>
        <span class="col-span-2 text-base">
            {{ $order->delivery_date ? $order->delivery_date->format('d M Y') : '—' }}
        </span>
        <span class="text-olive col-span-2 text-base font-bold">{{ $order->total_amount / 100 }} lei</span>

        <span
            class="border-light-border absolute right-6 flex h-8 w-8 items-center justify-center rounded-full border bg-white p-2"
        >
            <img
                class="accordion-arrow opacity-40 transition-transform duration-300"
                src="{{ Vite::image('icons/top_arrow.svg') }}"
                alt=""
            />
        </span>
    </label>

    <label
        for="order_{{ $order->id }}"
        class="accordion-header border-light-border peer-checked:[&_.accordion-arrow]:text-olive block rounded-2xl border p-0 duration-300 lg:hidden peer-checked:[&_.accordion-arrow]:rotate-0"
    >
        <!-- arbitrary variant для svg -->
        <span class="bg-light-orange peer-checked:!rounded-b-0 relative grid grid-cols-2 items-center rounded-2xl p-6">
            <span class="col-span-1">
                <span class="flex items-center gap-x-2 font-bold">
                    <span class="text-xl">#874720</span>
                    <span class="bg-olive size-4 rounded-full"></span>
                </span>
                <span class="py-1 text-sm leading-0 opacity-40">Placed 15 Apr 2023</span>
            </span>
            <span class="col-span-1 flex items-center justify-end gap-x-2 font-bold">
                <span class="text-olive font-bold">889 lei</span>
                <span>
                    <svg
                        class="accordion-arrow rotate-180 transition-transform duration-300"
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
        <div class="p-6">
            <div class="flex items-center justify-between font-bold">
                <p class="text-lg">Delivery details</p>
                <a
                    href="{{ route('orders.track', $order) }}"
                    class="border-light-border flex items-center gap-2 rounded-full border px-3 py-2"
                >
                    <img src="{{ Vite::image('icons/truck_active.svg') }}" alt="" />
                    <span class="text-olive text-sm">Track order</span>
                </a>
            </div>
            <div class="mt-6 flex flex-wrap items-center justify-start gap-9">
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Region</span>
                    <span class="font-bold">mun. Chișinău</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Localty</span>
                    <span class="font-bold">or. Chișinău</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Street name</span>
                    <span class="font-bold">str. Alba Iulia</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Building</span>
                    <span class="font-bold">113</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Entrance</span>
                    <span class="font-bold">6</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Floor</span>
                    <span class="font-bold">5</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Appartment</span>
                    <span class="font-bold">314</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Postal code</span>
                    <span class="font-bold">MD-2071</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Intercom</span>
                    <span class="font-bold">314</span>
                </p>
            </div>
            <div class="mt-6 flex flex-wrap items-center justify-start gap-9">
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Delivery metod</span>
                    <span class="font-bold">Regular</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Tracking code</span>
                    <span class="font-bold">UE239931833HK</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Sent with</span>
                    <span class="font-bold">Nova Poshta Moldova</span>
                </p>
            </div>
        </div>
        <div class="border-light-border border-y p-6">
            @auth
                <div class="flex items-center justify-between font-bold">
                    <p class="text-lg">Contact info</p>
                    <a
                        href="{{ route('profile.edit') }}"
                        class="border-light-border flex items-center gap-2 rounded-full border px-3 py-2"
                    >
                        <img src="{{ Vite::image('icons/user_active.svg') }}" alt="" />
                        <span class="text-olive text-sm">Edit profile</span>
                    </a>
                </div>
            @endauth

            <div class="mt-6 flex flex-wrap items-center justify-start gap-9">
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">First name</span>
                    <span class="font-bold">
                        {{ $order->customer->first_name }}
                    </span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Last name</span>
                    <span class="font-bold">
                        {{ $order->customer->last_name }}
                    </span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Phone number</span>
                    <span class="font-bold">
                        {{ $order->customer->phone }}
                    </span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">E-mail address</span>
                    <span class="font-bold">
                        {{ $order->customer->email }}
                    </span>
                </p>
            </div>
        </div>
        <div class="p-1 lg:p-6">
            <h2 class="text-lg font-bold">Products</h2>
            <div class="grid grid-cols-1 gap-4 py-2 lg:grid-cols-4">
                @foreach ($order->items as $product)
                    @include('store.account.orders.order-list-product', compact('product'))
                @endforeach
            </div>
        </div>
        <div class="lg:border-light-border p-0 lg:border-t lg:p-6">
            <div class="flex items-center justify-between font-bold">
                <h2 class="text-lg">Payment details</h2>
                <a
                    href="{{ route('orders.invoice', $order) }}"
                    class="border-light-border flex items-center gap-2 rounded-full border px-3 py-2"
                >
                    <img src="{{ Vite::image('icons/print.svg') }}" alt="" />
                    <span class="text-olive text-sm">Print invoice</span>
                    <img class="rotate-180" src="{{ Vite::image('icons/top_arrow.svg') }}" alt="" />
                </a>
            </div>
            <div class="mt-6 flex flex-wrap items-center justify-start gap-9">
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">First name</span>
                    <span class="font-bold">Dionisie</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Last name</span>
                    <span class="font-bold">Ghețu</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Payment method</span>
                    <span class="font-bold">VISA ××× 4695</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Used coupon</span>
                    <span class="font-bold">
                        SUMMER2023
                        <span>-25%</span>
                    </span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Postal code</span>
                    <span class="font-bold">MD-2071</span>
                </p>
                <p class="grid min-w-1/6 text-base">
                    <span class="opacity-40">Billing address</span>
                    <span class="font-bold">mun. Chișinău, or. Chișinău, str. Alba Iulia 113</span>
                </p>
            </div>
            <hr class="border-light-border mt-6" />
        </div>
        <div class="grid gap-y-4 p-6 pt-0">
            <div class="flex items-center justify-between">
                <p class="text-base opacity-40">Subtotal price</p>
                <p class="text-base font-bold">520 lei</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-base opacity-40">Discount</p>
                <p class="text-base font-bold">-130 lei</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-base opacity-40">Delivery price</p>
                <p class="text-base font-bold">50 lei</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="text-base font-bold">Total price</p>
                <p class="text-olive text-base font-bold">440 lei</p>
            </div>
        </div>
        <div class="px-6">
            <div class="bg-light-orange my-6 rounded-2xl p-6">
                <h2 class="text-bold text-2xl font-bold">Product doesn't match of fit?</h2>
                <p class="py-4 text-base opacity-60">
                    Product doesn't match of fit? You can contact us for return within 14 days of receiving it!
                </p>
                <x-ui.button left_icon="false" right_icon="false">
                    <img src="{{ Vite::image('icons/return.svg') }}" alt="" />
                    Ask for return
                </x-ui.button>
            </div>
        </div>
    </div>
</div>

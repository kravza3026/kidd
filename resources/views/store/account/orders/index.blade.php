<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white shadow sm:rounded-xl">
            @include('store.account.nav')
            <div class="p-6 md:px-10">
                <section>
                    @if ($user->orders_count)
                        <div class="my-2 hidden grid-cols-12 px-6 py-2 font-bold lg:grid">
                            <p class="col-span-3 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.order_number') }}
                            </p>
                            <p class="col-span-2 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.status') }}
                            </p>
                            <p class="col-span-1 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.quantity') }}
                            </p>
                            <p class="col-span-2 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.placed_at') }}
                            </p>
                            <p class="col-span-2 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.delivered_at') }}
                            </p>
                            <p class="col-span-2 text-[10px] uppercase opacity-40">
                                {{ __('order.table_heading.price') }}
                            </p>
                        </div>
                    @endif

                    @forelse ($user->orders->sortByDesc('id') as $order)
                        @include('store.account.orders._order-line', [
                            'order' => $order,
                        ])
                    @empty
                        <div class="my-12 flex flex-col items-center justify-center py-12">
                            <div class="-mb-6 flex items-center justify-center">
                                <img src="{{ Vite::image('common/empty_orders.jpg') }}" alt="order placeholder" />
                            </div>
                            <h3 class="flex items-center justify-center text-lg font-extrabold text-gray-900">
                                {{ __('order.empty.title') }}
                            </h3>
                            <p class="mt-1 mb-6 flex items-center justify-center text-sm text-gray-500">
                                {{ __('order.empty.description') }}
                            </p>
                            <a
                                href="{{ route('products.index') }}"
                                class="focus:bg-green-550 active:bg-green-550 inline-flex w-full cursor-pointer items-center justify-center rounded-xl border border-transparent bg-green-500 py-2.5 text-sm font-semibold text-white transition duration-150 ease-in-out hover:bg-green-600 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:outline-none sm:w-auto sm:px-6 sm:py-2"
                            >
                                {{ __('order.empty.explore_button') }}
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="2.5"
                                    stroke="currentColor"
                                    class="ml-2 size-4"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"
                                    />
                                </svg>
                            </a>
                        </div>
                    @endforelse
                </section>
            </div>
        </div>
    </div>
</x-app-layout>

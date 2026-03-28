<x-admin-layout>
    <ul role="list" class="divide-y divide-gray-100">
        @forelse ($orders as $order)
            <li class="flex items-center justify-between gap-x-6 border-b border-b-gray-300/40 py-3">
                <div class="min-w-0">
                    <div class="flex items-start gap-x-3">
                        <p class="text-sm/6 font-semibold text-gray-600">
                            {{ $order->order_number }}
                            &ldrushar;
                            <a
                                href="route('admin.invoices.show', $orider->invoice)"
                                class="text-dark-olive hover:text-olive"
                            >
                                {{ $order->invoice_number }}
                            </a>
                        </p>
                        <p
                            class="mt-0.5 rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 inset-ring inset-ring-green-600/20"
                        >
                            {{ $order->status->label() }}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 text-xs/5 text-gray-500">
                        <p class="font-light whitespace-nowrap">
                            Amount
                            <strong class="text-light-black/60 font-semibold">
                                {{ number_format($order->total_amount / 100, 2, '.', ',') }} lei
                            </strong>
                        </p>
                        <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                            <circle r="1" cx="1" cy="1" />
                        </svg>
                        <p class="font-light whitespace-nowrap">
                            Items
                            <strong class="text-light-black/60 font-semibold">{{ $order->items->count() }}</strong>
                        </p>
                        <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                            <circle r="1" cx="1" cy="1" />
                        </svg>
                        <p class="font-light whitespace-nowrap">
                            Placed
                            <time class="text-light-black/60 font-semibold" datetime="{{ $order->created_at }}">
                                {{ $order->placed_at->format('d/m/Y \a\t H:i') }}
                            </time>
                        </p>
                        <svg viewBox="0 0 2 2" class="size-0.5 fill-current">
                            <circle r="1" cx="1" cy="1" />
                        </svg>
                        <p class="truncate font-light">
                            Customer
                            <a
                                class="text-dark-olive hover:text-olive font-semibold"
                                href="{{ route('admin.customers.show', $order->customer) }}"
                            >
                                {{ $order->customer->name }}
                            </a>
                        </p>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
                    <a
                        href="{{ route('admin.orders.show', $order) }}"
                        class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:block"
                    >
                        View order
                        <span class="sr-only">{{ $order->order_number }}</span>
                    </a>
                    <el-dropdown class="relative flex-none">
                        <button class="relative block text-gray-500 hover:text-gray-900">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Open options</span>
                            <svg
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                data-slot="icon"
                                aria-hidden="true"
                                class="size-5"
                            >
                                <path
                                    d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"
                                />
                            </svg>
                        </button>
                        <el-menu
                            anchor="bottom end"
                            popover
                            class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in"
                        >
                            <a
                                href="{{ route('admin.orders.edit', $order) }}"
                                class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden"
                            >
                                Edit
                                <span class="sr-only">{{ $order->order_number }}</span>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="block w-full cursor-pointer px-3 py-1 text-left text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden"
                                >
                                    Delete
                                    <span class="sr-only">{{ $order->order_number }}</span>
                                </button>
                            </form>
                        </el-menu>
                    </el-dropdown>
                </div>
            </li>
        @empty
            <div class="text-center">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    aria-hidden="true"
                    class="mx-auto size-12 text-gray-400 dark:text-gray-500"
                >
                    <path
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"
                        stroke-width="2"
                        vector-effect="non-scaling-stroke"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">No orders</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new order.</p>
                <div class="mt-6">
                    <button
                        type="button"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:hover:bg-indigo-400 dark:focus-visible:outline-indigo-500"
                    >
                        <svg
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            data-slot="icon"
                            aria-hidden="true"
                            class="mr-1.5 -ml-0.5 size-5"
                        >
                            <path
                                d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"
                            />
                        </svg>
                        New Order
                    </button>
                </div>
            </div>
        @endforelse
    </ul>
</x-admin-layout>

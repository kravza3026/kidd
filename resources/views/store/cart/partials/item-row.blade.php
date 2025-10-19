<div class="w-full border-b pb-6">
    <form
        class="flex gap-6"
        action="{{ route('cart.destroy', $item->getHash()) }}"
        name="cart_item_{{ $item->getHash() }}"
        method="POST"
    >
        @csrf
        @method('DELETE')
        {{--
            <div class="flex items
            {{--        <div class="inline-flex selector">
        --}}
        {{-- <input type="checkbox" name="cart_product[]" id="{{ $item->getHash() }}" value="{{ @$item->getHash() }}" class="shrink-0 border-gray-300 rounded text-olive focus:ring-dark-olive"/> --}}
        {{-- </div> --}}
        <div class="bg-secondary flex max-w-[100px] rounded-xl">
            <div class="aspect-1 size-[100px]">
                <img width="100px" height="100px" src="{{ Vite::image('products/product_1.webp') }}" alt="test img" />
            </div>
        </div>
        <div class="flex flex-1 flex-col justify-between">
            <div class="flex flex-col gap-2">
                <h5 class="text-charcoal text-xl leading-5 font-medium tracking-[-2%]">
                    {{ $item->options['model']->product->name }}
                </h5>
                <span class="text-charcoal text-base leading-4 font-normal tracking-[-2%]">
                    {{ $item->options['model']->price_final / 100 }} lei
                </span>
            </div>
            <div class="flex items-center justify-stretch gap-x-3">
                <!-- Select -->
                <x-select
                    name="size"
                    label="Product Size"
                    class="flex"
                    :selected="$item->options['model']->size_id"
                    :options="$sizes"
                />

                <!-- End Select -->
                <!-- Select -->
                <x-select
                    name="color"
                    label="Product Color"
                    class="flex"
                    :selected="$item->options['model']->color_id"
                    :options="$colors"
                />
                <!-- End Select -->

                <!-- Input Number -->
                <div class="inline-block w-auto rounded-lg border bg-white px-2 py-1.5" data-hs-input-number="">
                    <div class="flex items-center gap-x-1.5">
                        <button
                            type="button"
                            class="border-dark-snow text-charcoal inline-flex size-5 items-center justify-center gap-x-2 rounded-md border bg-white text-sm font-medium shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                            tabindex="-1"
                            aria-label="Decrease"
                            data-hs-input-number-decrement=""
                        >
                            <svg
                                class="size-3.5 shrink-0"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <input
                            class="text-charcoal w-6 border-0 bg-transparent p-0 text-center text-sm leading-none focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none"
                            style="-moz-appearance: textfield"
                            type="number"
                            aria-roledescription="Number field"
                            value="{{ $item->options['qty'] }}"
                            data-hs-input-number-input=""
                        />
                        <button
                            type="button"
                            class="inline-flex size-5 items-center justify-center gap-x-2 rounded-md border border-gray-200 bg-white text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50"
                            tabindex="-1"
                            aria-label="Increase"
                            data-hs-input-number-increment=""
                        >
                            <svg
                                class="size-3.5 shrink-0"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- End Input Number -->
            </div>
        </div>
        <div class="flex flex-col justify-between">
            <div class="flex justify-end">
                <div class="text-olive text-lg leading-[18px] font-normal tracking-[-2%]">
                    {{ $item->total() / 100 }} lei
                    {{-- {{ $item->price($formatted = true, $taxedItemsOnly = false, $withTax = false) }} --}}
                </div>
            </div>
            <div class="flex justify-end">
                <x-secondary-button
                    class="text-olive !bg-secondary !border-darkest-snow/50 cursor-pointer border px-4 !capitalize !shadow-none"
                    type="submit"
                >
                    <img src="{{ Vite::image('common/trash.svg') }}" alt="" />
                    <span class="ml-2">Delete</span>
                </x-secondary-button>
            </div>
        </div>
    </form>
</div>

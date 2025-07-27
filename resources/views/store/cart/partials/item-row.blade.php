<div class="border-b pb-6 w-full">
    <form class="flex gap-6" action="{{ route('cart.destroy', $item->getHash()) }}" name="cart_item_{{ $item->getHash() }}" method="POST">
        @csrf
        @method('DELETE')
        {{--        <div class="flex items
{{--        <div class="inline-flex selector">--}}
{{--            <input type="checkbox" name="cart_product[]" id="{{ $item->getHash() }}" value="{{ @$item->getHash() }}" class="shrink-0 border-gray-300 rounded text-olive focus:ring-dark-olive"/>--}}
{{--        </div>--}}
        <div class="max-w-[100px] flex bg-secondary rounded-xl">
            <div class="size-[100px] aspect-1">
                <img width="100px" height="100px" src="{{ Vite::image('products/product_1.png') }}" alt="test img"/>
            </div>
        </div>
        <div class="flex flex-1 justify-between flex-col">
            <div class="flex flex-col gap-2">
                <h5 class="text-xl font-medium text-charcoal leading-5 tracking-[-2%]">
                    {{ $item->options['product']->name }}
                </h5>
                <span class="text-base font-normal text-charcoal leading-4 tracking-[-2%]">
                {{ $item->options['model']->price_final / 100 }} lei
            </span>
            </div>
            <div class="flex gap-x-3 justify-stretch items-center">
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
                <div class="w-auto py-1.5 px-2 inline-block bg-white border rounded-lg" data-hs-input-number="">
                    <div class="flex items-center gap-x-1.5">
                        <button type="button"
                                class="size-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-dark-snow bg-white text-charcoal shadow-sm
                                                    hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <input
                            class="p-0 w-6 bg-transparent border-0 text-charcoal text-sm leading-none text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none
                                                [&::-webkit-outer-spin-button]:appearance-none"
                            style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="{{ $item->options['qty'] }}" data-hs-input-number-input="">
                        <button type="button"
                                class="size-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm
                                                    hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                                tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- End Input Number -->
            </div>
        </div>
        <div class="flex justify-between flex-col">
            <div class="flex justify-end">
                <div class="font-normal text-lg leading-[18px] tracking-[-2%] text-olive">
                    {{ $item->total() / 100 }} lei
                    {{--                {{ $item->price($formatted = true, $taxedItemsOnly = false, $withTax = false) }}--}}
                </div>
            </div>
            <div class="flex justify-end">
                <x-secondary-button class="cursor-pointer !capitalize !shadow-none px-4 text-olive !bg-secondary border !border-darkest-snow/50" type="submit">
                    <img src="{{ Vite::image('common/trash.svg') }}" alt="">
                    <span class="ml-2">Delete</span>
                </x-secondary-button>
            </div>
        </div>
    </form>
</div>

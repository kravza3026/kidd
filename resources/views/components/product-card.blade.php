@props([
    'product',
])

<a href="{{ $product->link() }}" class="group cursor-pointer p-1">
    <div
        class="bg-card-bg relative overflow-hidden rounded-xl border border-transparent px-2 py-4 transition-all duration-200 ease-in-out group-hover:border-black/10 group-hover:bg-white hover:overflow-visible"
    >
        <div class="relative flex">
            @if ($product->is_new || $product->has_discount)
                <div class="absolute top-1 left-1 flex items-center gap-2 md:top-2 md:left-2">
                    @if ($product->has_discount)
                        <div
                            class="bg-danger rounded-full px-3 py-1 text-[10px] font-semibold text-white md:text-[12px]"
                        >
                            -{{ $product->variants->first()?->discount_display }}%
                        </div>
                    @endif

                    @if ($product->is_new)
                        <div
                            class="bg-olive rounded-full px-3 py-1 text-[10px] font-semibold text-white md:text-[12px]"
                        >
                            {{ __('product-show.new') }}
                        </div>
                    @endif
                </div>
            @endif

            <div
                class="bg-opacity-90 absolute top-1 right-1 flex items-center gap-1 rounded-full px-2 py-1 text-xs sm:hidden xl:flex"
            >
                <div class="flex items-center gap-2">
                    <div
                        class="group/gender {{ $product->gender->bg_color }} relative flex size-6 items-center justify-center rounded-3xl p-1 shadow-md"
                    >
                        <div class="flex w-4 items-center justify-center">
                            {!! $product->gender->svg !!}
                            <div
                                class="absolute top-full left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300 group-hover/gender:opacity-100"
                            >
                                {{ $product->gender->name }}
                                <div
                                    class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-center gap-1 rounded-3xl border border-black/10 bg-white py-1.5 pr-3 pl-2.5"
                    >
                        <div class="size-3">
                            <img class="w-3" src="{{ Vite::image('icons/size.png') }}" alt="size icon" />
                        </div>
                        <div class="text-xs leading-3 font-bold text-black">
                            {{ $product->variants->min('size.min_age') }}-{{ $product->variants->max('size.max_age') }}M
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex h-full w-full items-center justify-center pt-10 transition-all duration-700 ease-in-out">
                <img
                    src="{{ Vite::image($product->main_image) }}"
                    alt="{{ $product->name }}"
                    class="aspect-square w-full object-contain object-center"
                />
            </div>
        </div>

        <div class="mt-3 flex items-center justify-center gap-2">
            @foreach ($product->variants as $variant)
                @if ($loop->first)
                    <div
                        class="flex h-4 w-4 cursor-pointer items-center justify-center rounded-full border border-gray-300 bg-white p-0"
                    >
                        <span
                            class="h-2 w-2 rounded-full p-0"
                            style="background-color: {{ $variant->color->hex }}"
                        ></span>
                    </div>
                @else
                    <div
                        class="h-2 w-2 cursor-pointer rounded-full"
                        style="background-color: {{ $variant->color->hex }}"
                    ></div>
                @endif
            @endforeach
        </div>
        <div
            class="add_favorite absolute right-4 bottom-4 z-20 h-7 w-7 rounded-full border border-black/10 bg-white p-1 transition-all duration-500 ease-in-out group-hover:bottom-4 group-hover:opacity-100 xl:right-4 xl:bottom-[-20%] xl:h-10 xl:w-10 xl:p-2 xl:opacity-0"
        >
            <img class="" src="{{ Vite::image('icons/add_fav.svg') }}" alt="add to favorite" />
            <div
                class="tooltip absolute top-full left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-3 py-1 text-sm text-white opacity-0 transition-opacity duration-300"
            >
                Save to Favorites
                <div
                    class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                ></div>
            </div>
        </div>
    </div>

    <div class="mt-4 px-4 text-start">
        <div class="bg-opacity-90 hidden items-center gap-1 rounded-full py-1 text-[10px] sm:flex xl:hidden">
            {{-- <img src="{{ $genderIcon }}" alt="gender" class="w-[24px] h-[24px]" /> --}}
            <div
                class="{{ $product->gender->bg_color }} flex size-6 items-center justify-center rounded-3xl p-1 shadow-md"
            >
                <div class="flex w-4 items-center justify-center">
                    {!! $product->gender->svg !!}
                </div>
            </div>
            <div
                class="flex h-[24px] items-center justify-center gap-x-1 rounded-full border border-black/10 bg-white px-2 py-1 text-[12px] font-bold"
            >
                <img src="{{ Vite::image('icons/size.png') }}" alt="size" />
                {{ $product->variants->min('size.min_age') }}-{{ $product->variants->max('size.max_age') }}M
            </div>
        </div>
        <p class="text-charcoal text-sm sm:text-base">{{ $product->name }}</p>
        <p class="text-charcoal text-base font-bold">
            {{ $product->variants()->min('price_final') / 100 }} {{ __('product-show.mdl') }}
            @if ($product->has_discount)
                <span class="text-sm font-light line-through opacity-30">
                    {{ $product->variants()->min('price_online') / 100 }} {{ __('product-show.mdl') }}
                </span>
            @endif
        </p>
    </div>
</a>

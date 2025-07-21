@props([
    'product',
])

<a href="{{ $product->link() }}" class="cursor-pointer group p-1 ">
    <div class="bg-card-bg overflow-hidden group-hover:bg-white border border-transparent group-hover:border-black/10 duration-200 transition-all ease-in-out rounded-xl py-4 px-2 relative ">
        <div class="relative flex">
            @if($product->is_new || $product->has_discount)
                <div class="absolute top-1 md:top-2 left-1 md:left-2 flex items-center gap-2  ">
                    @if($product->has_discount)
                        <div class=" bg-danger text-white text-[10px] md:text-[12px] font-semibold rounded-full px-3 py-1">
                            -{{ $product->variants->first()?->discount_display }}%
                        </div>
                    @endif
                    @if ($product->is_new)
                        <div class=" bg-olive text-white text-[10px] md:text-[12px] font-semibold rounded-full px-3 py-1">
                            {{ __('product-show.new') }}
                        </div>
                    @endif
                </div>
            @endif
            <div class="absolute top-1 right-1 flex sm:hidden xl:flex items-center gap-1  bg-opacity-90 rounded-full px-2 py-1 text-xs">
                <div class="flex items-center gap-2">
                    <div class="group/gender relative shadow-md size-6 p-1  {{ $product->gender->bg_color }} rounded-3xl justify-center items-center flex">
                        <div class="w-4 justify-center items-center flex">
                            {!! $product->gender->svg !!}
                            <div class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover/gender:opacity-100 transition-opacity
                            duration-300
                            z-10">
                                {{ $product->gender->name }}
                                <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" pl-2.5 pr-3 py-1.5 bg-white rounded-3xl border border-black/10 justify-center items-center gap-1 flex">
                        <div class="size-3">
                            <img class="w-3" src="{{ Vite::image('icons/size.png')  }}" alt="size icon"/>
                        </div>
                        <div class="text-black text-xs font-bold leading-3">
                            {{ $product->variants->min('size.min_age') }}-{{ $product->variants->max('size.max_age') }}M
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex justify-center items-center pt-10 transition-all duration-700 ease-in-out">
                <img src="{{ Vite::image($product->main_image) }}" alt="{{ $product->name }}"
                     class="w-full object-center object-contain aspect-square" />
            </div>
        </div>

        <div class="flex justify-center items-center gap-2 mt-3">
            @foreach($product->variants as $variant)
                @if ($loop->first)
                    <div class="border cursor-pointer p-0 w-4 h-4 rounded-full flex justify-center items-center border-gray-300 bg-white">
                        <span class="w-2 h-2 rounded-full p-0" style="background-color: {{ $variant->color->hex }}"></span>
                    </div>
                @else
                    <div class="cursor-pointer w-2 h-2 rounded-full" style="background-color: {{ $variant->color->hex }}"></div>
                @endif
            @endforeach
        </div>
        <div class="absolute add_favorite z-20  bg-white w-7 h-7 xl:w-10 xl:h-10 p-1 xl:p-2 border border-black/10 rounded-full right-4 xl:right-4 bottom-4 xl:bottom-[-20%] group-hover:bottom-4  xl:opacity-0
        group-hover:opacity-100 duration-1000 transition-all ease-in-out">
            <img class=""  src="{{ asset('assets/images/icons/add_fav.svg') }}" alt="add to favorite">
            <div class="absolute tooltip left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0  transition-opacity duration-300 z-10">
                Save to Favorites
                <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
            </div>
        </div>
    </div>

    <div class="text-start px-4 mt-4">
        <div class="hidden sm:flex xl:hidden items-center gap-1  bg-opacity-90 rounded-full py-1 text-[10px]">
{{--                <img src="{{ $genderIcon }}" alt="gender" class="w-[24px] h-[24px]" />--}}
            <div class="shadow-md size-6 p-1  {{ $product->gender->bg_color }} rounded-3xl justify-center items-center flex">
                <div class="w-4 justify-center items-center flex">
                    {!! $product->gender->svg !!}
                </div>
            </div>
            <div class="text-[12px] bg-white font-bold h-[24px] rounded-full flex items-center justify-center py-1 px-2 gap-x-1 border border-black/10">
                <img src="{{ asset('assets/images/icons/size.png') }}" alt="size">
                {{ $product->variants->min('size.min_age') }}-{{ $product->variants->max('size.max_age') }}M
            </div>
        </div>
        <p class="text-sm text-charcoal sm:text-base">{{ $product->name }}</p>
        <p class="font-bold text-charcoal text-base">
            {{ $product->variants()->min('price_final')/100 }} {{ __('product-show.mdl') }}
            @if ($product->has_discount)
                <span class="text-sm font-light line-through opacity-30">
                {{ $product->variants()->min('price_online')/100 }} {{ __('product-show.mdl') }}
                </span>
            @endif
        </p>
    </div>
</a>

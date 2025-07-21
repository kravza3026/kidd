{{--Hover=False;--}}
{{--Is Favorite=False;--}}
{{--Show Discount=true;--}}
{{--Discount="-20%";--}}
{{--Show New=true;--}}
{{--Show Gender=true;--}}
{{--Gender="Gender/Unisex";--}}
{{--Show Size=true;--}}
{{--Size="6-9M";--}}
{{--Show Colors=true;--}}
{{--Product name="Fleece Hooded Jacket";--}}
{{--Price="212 lei";--}}
{{--Old price="265 lei";--}}
{{--Show Family marker=false;--}}
{{--Show Badges=true;--}}

<a href="{{ route('products.show', [$product->category, $product]) }}" class="group w-full h-full mb-12">
    <div class="min-h-fit w-full h-full flex flex-col">
        <div class="w-full px-5 py-6 bg-dark-snow relative rounded-xl flex flex-col grow gap-2 items-center border border-transparent group-hover:border-dark-snow group-hover:bg-white">
            <div class="w-full flex justify-between">
                <div class="flex items-center gap-2">
                    @if($product->is_new || $product->has_discount)
                        @if($product->has_discount)
                            <x-ui.badge class="bg-danger">
                                -{{ $product->variants->first()?->discount_display }}%
                            </x-ui.badge>
                        @endif
                        @if($product->is_new)
                            <x-ui.badge class="bg-olive uppercase">
                                {{ __('general.new') }}
                            </x-ui.badge>
                        @endif
                    @else
                        <div>
                        </div>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <div class="shadow-md hs-tooltip [--placement:bottom] size-6 p-1  {{ $product->gender->bg_color }} rounded-3xl justify-center items-center flex">
                        <div class="hs-tooltip-toggle w-4 justify-center items-center flex">
                            {!! $product->gender->svg !!}
                        </div>
                        <span
                            class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs
                            font-medium text-white rounded-xl shadow-sm"
                            role="tooltip">
                            {{ $product->gender->name }}
                        </span>
                    </div>
                    <div class=" pl-2.5 pr-3 py-1.5 bg-white rounded-3xl border border-black/10 justify-center items-center gap-1 flex">
                        <div class="size-3">
                            <img class="w-3" src="{{ Vite::image('size.png')  }}" alt="size icon"/>
                        </div>
                        <div class="text-black text-xs font-bold leading-3">
                            {{ $product->variants->min('size.min_age') }}-{{ $product->variants->max('size.max_age') }}M
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-full flex-1 justify-center items-center">
                <img class="ratio-1/1 mix-blend-multiply" src="{{ Vite::image($product->main_image) }}" alt="{{ $product->desc }}"/>
            </div>
            <div class="w-full justify-center items-center flex bottom-6 left-0 absolute">
                @foreach($product->variants as $variant)
                    <div class="p-1 {{ ($loop->first) ? 'bg-white border border-black/30' : '' }} rounded-3xl justify-start items-start gap-1 flex">
                        <div class="w-2.5 h-2.5 bg-[{{ $variant->color->hex }}] rounded-3xl {{ ($loop->first) ? 'shadow-inner' : '' }} border border-black/10"></div>
                    </div>
                @endforeach
            </div>
            {{-- TODO Favorite component --}}
            <div class="hidden has-[.favorited]:flex group-hover:flex absolute size-10 bottom-6 right-6 group-hover:bg-secondary rounded-full justify-center items-center border border-dark-snow
                shadow-md">
                @if(rand(0,1))
                    <button type="button" class="inline-flex">
                        <img class="size-5" src="{{ Vite::image('fav.svg') }}" alt="Add to Favorites icon">
                    </button>
                @else
                    <button type="button" class="favorited inline-flex">
                        <img class="size-5" src="{{ Vite::image('unfav.svg') }}" alt="Remove from favorites icon">
                    </button>
                @endif
            </div>
        </div>
        <div class="w-full pl-4 pr-2 pt-5 bg-white flex justify-between items-start gap-4">
            <div class="flex-col justify-start items-start gap-3 inline-flex">
                <div class="h-4 text-black text-base font-normal leading-none line-clamp-1">
                    {{ $product->name }}
                </div>
                <div class="justify-start items-center gap-3 inline-flex">
                    <div class="justify-start items-start gap-2 flex">
                        <div class="justify-start items-center gap-2 flex">
                            <div class="text-center text-black text-base font-bold leading-none">
                                {{ $product->variants()->min('price_final')/100 }}
                                <span class="line-through text-sm font-medium text-gray-400">{{ $product->variants()->min('price_online')/100 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @auth
                <div class="w-8 h-10 justify-center items-center flex">
                    <div class="flex -space-x-3">
                        @foreach(auth()->user()->family as $family)
                            <div class="hs-tooltip [--placement:bottom] hs-tooltip-toggle inline-flex items-center justify-center size-[30px] rounded-full {{ $family->gender->bg_color }} text-sm font-semibold
                            text-white leading-none">
                                {{ Str::limit($family->name, 1, '') }}
                                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-3 bg-gray-900 text-xs
                                    font-medium text-white rounded-xl shadow-sm" role="tooltip">
                                    {{ __('product.compatible', ['name' => $family->name]) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endauth
        </div>
    </div>
</a>

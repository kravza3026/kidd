<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex items-center space-x-2 py-4 sm:py-6 lg:py-8">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="mr-2 text-sm font-medium text-gray-900">
                            {{ __('header.menu.catalog') }}
                        </a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                             class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z"/>
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('products.category.index', $product->category) }}"
                           class="mr-2 text-sm font-medium text-gray-900">
                            {{ $product->category->name }}
                        </a>
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true"
                             class="h-5 w-4 text-gray-300">
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z"/>
                        </svg>
                    </div>
                </li>

                <li class="text-sm">
                    <button aria-current="page"
                            class="font-medium text-gray-500 hover:text-gray-600">
                        {{ $product->name }}
                    </button>
                </li>
            </ol>
        </nav>

        <div class="w-full py-8 flex-col md:flex-row justify-center items-center gap-12 inline-flex relative">
            <div class="md:min-w-[550px] w-full sm:p-10 bg-[#f6f6f6] rounded-xl md:sticky top-6 bottom-6 flex-col justify-center items-center gap-8 inline-flex">
                <img class="w-full max-w-[520px] grow shrink aspect-1" src="{{ Vite::image('products/product_'.rand(1,4).'.png') }}" alt="Product image description"/>
                {{--                    //TODO add alt attribute--}}
                <div class=" justify-center items-center gap-3 inline-flex">
                        @foreach($product->variants as $variant)
                            @if ($loop->first)
                                <div class="border cursor-pointer p-0 size-6 rounded-full flex justify-center items-center border-gray-300 bg-white">
                                    <span class="size-6 rounded-full p-0" style="background-color: {{ $variant->color->hex }}"></span>
                                </div>
                            @else
                                <div class="cursor-pointer size-6 rounded-full" style="background-color: {{ $variant->color->hex }}"></div>
                            @endif
                        @endforeach
                </div>
            </div>
            <div class=" pb-6 px-10 rounded-xl flex-col justify-start items-start inline-flex">
                <div class="flex-col justify-start items-start flex">
                    <div class="pb-8 flex-col justify-start items-start gap-3 flex">
                        <div class="justify-start items-start gap-4 inline-flex">
                            <div class="opacity-80 text-center text-[#020202] text-3xl font-bold leading-[62.40px] text-nowrap">{{ $product->name }}</div>
                            <div class="justify-center items-center gap-2 flex">
                                <div class="px-2 py-1.5 bg-olive rounded-xl justify-center items-center flex-inline">
                                    <div class="text-snow uppercase text-sm font-bold leading-[14px]">
                                        {{ __('product-show.new') }}
                                    </div>
                                </div>
                                <div class="px-2 py-1.5 bg-red-500 rounded-xl justify-center items-center flex-inline">
                                    <div class="text-snow text-sm font-bold leading-[14px]">-20%</div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-hidden opacity-60 text-[#020202] text-sm font-normal leading-normal">
                            {{ $product->description }}
                        </div>
                    </div>
                    <div class="pb-8 justify-start items-end gap-2 inline-flex">
                        <div class="opacity-80 text-[#020202] text-5xl font-medium leading-[48px]">{{ round($product->variants->first()?->price_final / 100) }}</div>
                        <div class="justify-start items-center gap-2 flex">
                            <div class="opacity-30 text-right text-[#020202] text-sm font-normal line-through leading-[25.20px]">{{ round($product->variants->first()?->price_online / 100) }}</div>
                        </div>
                        <div class="px-2 py-1.5 bg-[#fc3232] rounded-xl justify-center items-center flex">
                            <div class="text-white text-sm font-extrabold leading-[14px]">-20%</div>
                        </div>
                    </div>
                    <div class="w-full py-8 border-t border-[#eeeeee] flex-col justify-start items-start gap-8 flex">
                        {{--                        {{ $product->variants->first()?->color->hex }}--}}
                        {{--                        {{ $product->variants->first()?->color }}--}}
                        <!-- Colors -->
                        <div class="w-full flex-col justify-start items-start gap-4 flex">
                            <h3 class="text-sm font-medium text-gray-900">{{ __('product-show.desc.color') }}</h3>
                            <fieldset aria-label="Choose a color" class="mt-4">
                                <div class="flex items-center space-x-3">
                                    @foreach($product->variants as $variant)
                                        <!-- Active and Checked: "ring ring-offset-1" -->
                                        <label aria-label="{{ $variant->color->name }}" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">
                                            <input type="radio" name="color-choice" value="{{ $variant->color->id }}" class="peer sr-only">
                                            <span aria-hidden="true"
                                                  class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-[{{ $variant->color->hex }}] peer-checked:ring peer-checked::ring-offset-1"></span>
                                        </label>
                                    @endforeach
                                    {{--                                    <!-- Active and Checked: "ring ring-offset-1" -->--}}
                                    {{--                                    <label aria-label="White" class="group relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">--}}
                                    {{--                                        <input type="radio" name="color-choice" value="White" class="peer sr-only" @checked(true)>--}}
                                    {{--                                        <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-white peer-checked:ring peer-checked::ring-offset-1"></span>--}}
                                    {{--                                    </label>--}}
                                    {{--                                    <!-- Active and Checked: "ring ring-offset-1" -->--}}
                                    {{--                                    <label aria-label="Gray" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">--}}
                                    {{--                                        <input type="radio" name="color-choice" value="Gray" class="peer sr-only">--}}
                                    {{--                                        <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-200 peer-checked:ring peer-checked::ring-offset-1"></span>--}}
                                    {{--                                    </label>--}}
                                    {{--                                    <!-- Active and Checked: "ring ring-offset-1" -->--}}
                                    {{--                                    <label aria-label="Black" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-none">--}}
                                    {{--                                        <input type="radio" name="color-choice" value="Black" class="peer sr-only">--}}
                                    {{--                                        <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-900 peer-checked:ring peer-checked::ring-offset-1"></span>--}}
                                    {{--                                    </label>--}}
                                </div>
                            </fieldset>
                        </div>
                        <div class="w-full flex-col justify-start items-start gap-4 flex">
                            <div class="flex justify-between items-center w-full">
                                <div class="text-[#020202] text-base font-normal  inline-flex">{{ __('product-show.desc.size') }}</div>
                                <a href="#" class="justify-start items-center gap-1 inline-flex">
                                    <img class="w-3" src="{{ Vite::image('icons/size.png') }}" alt=""/>
                                    <span class="text-[#a8ba66] text-sm font-bold underline leading-[14px]">{{ __('product-show.desc.size_guide') }}</span>
                                </a>
                            </div>
                            <div class=" pb-1 justify-start items-center gap-2 inline-flex">
                                <div class="px-5 py-[13px] bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex">
                                    <div class="text-[#020202] text-sm font-bold leading-[14px]">Preemie</div>
                                </div>
                                <div class="px-5 py-[13px] bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex">
                                    <div class="text-[#020202] text-sm font-bold leading-[14px]">0-3M</div>
                                </div>
                                <div class="pl-2 pr-5 py-2 bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center gap-2 flex">
                                    <div class="w-6 h-6 bg-[#eac2c3] rounded-[100px] shadow-inner justify-center items-center flex">
                                        <div class="w-6 text-center text-white text-sm font-bold leading-[14px]">E</div>
                                    </div>
                                    <div class="text-[#020202] text-sm font-bold leading-[14px]">3-6M</div>
                                </div>
                                <div class="px-5 py-[13px] bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex">
                                    <div class="text-[#020202] text-sm font-bold leading-[14px]">6-9M</div>
                                </div>
                                <div class="px-5 py-[13px] bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex">
                                    <div class="text-[#020202] text-sm font-bold leading-[14px]">9-12M</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full py-6 border-t border-b border-[#eeeeee] flex-col justify-center items-start gap-10 flex">
                    <div class="w-full flex justify-center items-center gap-4">
                        <x-primary-button class="bg-secondary hover:!bg-secondary-dark !border-transparent !text-olive hover:!text-olive focus:!text-olive sm:py-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                            </svg>
                            {{ __('product-show.add-to-favorite') }}
                        </x-primary-button>
                        <x-primary-button class="sm:py-4 w-full flex-grow">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>
                            </svg>
                            {{ __('product-show.add-to-cart') }}
                        </x-primary-button>
                    </div>
                </div>
                <div class="pb-4 w-full border-b border-zinc-100">
                    <div class="w-full flex justify-between items-center pt-8 pb-4">
                        <div class="inline-flex text-black text-base font-medium ">
                            {{ __('product-show.desc.title') }}
                        </div>
                        <div class="inline-flex opacity-40">&downarrow;</div>
                    </div>

                    <div class="w-full py-4">
                        <div class="w-full sm:max-w-[568px] flex flex-col justify-center items-start gap-6">
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.article') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="inline-flex text-right text-black text-sm font-medium ">
                                    {{ $product->barcode }} /
                                    {{ $product->variants->first()->sku }}
                                </div>
                            </div>
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.gender') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="text-right text-black text-sm font-medium ">
                                    {{ $product->gender->name }}
                                </div>
                            </div>
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.fabric') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="text-right text-black text-sm font-medium ">
                                    {{ $product->fabric->name }}
                                </div>
                            </div>
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.season') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="text-right text-black text-sm font-medium ">
                                    {{ $product->season->name }}
                                </div>
                            </div>
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.sleeve') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="text-right text-black text-sm font-medium ">Short-sleeved</div>
                            </div>
                            <div class="w-full justify-between inline-flex">
                                <div class="inline-flex text-black/40 text-sm font-normal ">
                                    {{ __('product-show.desc.closure') }}
                                </div>
                                <div class="flex grow shrink basis-0 pb-1 ml-2 mr-2 justify-start items-end gap-1 overflow-hidden">
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                    <span class="h-px border border-zinc-200 rounded-full"></span>
                                </div>
                                <div class="text-right text-black text-sm font-medium ">Button fastened</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-4 w-full border-b border-zinc-100">
                    <div class="w-full flex justify-between items-center pt-8 pb-4">
                        <div class="inline-flex text-black text-base font-medium ">Material care instructions</div>
                        <div class="inline-flex opacity-40">&downarrow;</div>
                    </div>
                    <div class=" h-80 pr-10 pt-2 pb-4 bg-white flex-col justify-start items-start gap-5 flex">
                        <div class="  flex-col justify-start items-start gap-6 flex">
                            <div class=" justify-start items-center gap-4 inline-flex">
                                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt="">
                                    </div>
                                </div>
                                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Wash at 40° to preserve the quality and colour of the fabric</div>
                            </div>
                            <div class=" justify-start items-center gap-4 inline-flex">
                                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt="">
                                    </div>
                                </div>
                                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Avoid using bleach as it can damage the fabric</div>
                            </div>
                            <div class=" justify-start items-center gap-4 inline-flex">
                                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                                        <img class="w-[21.50px] 50px]"
                                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"/>
                                    </div>
                                </div>
                                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">To dry the fabric use tumble drying on a low heat setting</div>
                            </div>
                            <div class=" justify-start items-center gap-4 inline-flex">
                                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                                        <img class="w-[21.50px] 50px]"
                                             src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"/>
                                    </div>
                                </div>
                                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">Iron using a medium heat setting, with temperature max. 150°</div>
                            </div>
                            <div class=" justify-start items-center gap-4 inline-flex">
                                <div class="w-10 h-10 p-2 bg-[#f8f7f2] rounded-[100px] justify-center items-center flex">
                                    <div class="w-6 h-6 relative opacity-80 flex-col justify-start items-start flex">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt="">
                                    </div>
                                </div>
                                <div class="text-[#020202] text-sm font-normal leading-[18.20px]">This fabric should not be dry cleaned to avoid damage</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>

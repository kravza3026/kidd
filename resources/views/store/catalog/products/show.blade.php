<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex items-center space-x-2 py-4 sm:py-6 lg:py-8">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="mr-2 text-sm font-medium text-gray-900">
                            {{ __('header.menu.catalog') }}
                        </a>
                        <svg
                            width="16"
                            height="20"
                            viewBox="0 0 16 20"
                            fill="currentColor"
                            aria-hidden="true"
                            class="h-5 w-4 text-gray-300"
                        >
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a
                            href="{{ route('products.category.index', $product->category) }}"
                            class="mr-2 text-sm font-medium text-gray-900"
                        >
                            {{ $product->category->name }}
                        </a>
                        <svg
                            width="16"
                            height="20"
                            viewBox="0 0 16 20"
                            fill="currentColor"
                            aria-hidden="true"
                            class="h-5 w-4 text-gray-300"
                        >
                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                        </svg>
                    </div>
                </li>

                <li class="text-sm">
                    <button aria-current="page" class="font-medium text-gray-500 hover:text-gray-600">
                        {{ $product->name }}
                    </button>
                </li>
            </ol>
        </nav>

        <div class="relative inline-flex w-full flex-col items-center justify-center gap-12 py-8 md:flex-row">
            <div
                class="top-6 bottom-6 inline-flex w-full flex-col items-center justify-center gap-8 rounded-xl bg-[#f6f6f6] sm:p-10 md:sticky md:min-w-[550px]"
            >
                <img
                    class="aspect-1 w-full max-w-[520px] shrink grow"
                    src="{{ Vite::image('products/product_'.rand(1, 4).'.webp') }}"
                    alt="Product image description"
                />
                {{-- //TODO add alt attribute --}}
                <div class="inline-flex items-center justify-center gap-3">
                    @foreach ($product->variants as $variant)
                        @if ($loop->first)
                            <div
                                class="flex size-6 cursor-pointer items-center justify-center rounded-full border border-gray-300 bg-white p-0"
                            >
                                <span
                                    class="size-6 rounded-full p-0"
                                    style="background-color: {{ $variant->color->hex }}"
                                ></span>
                            </div>
                        @else
                            <div
                                class="size-6 cursor-pointer rounded-full"
                                style="background-color: {{ $variant->color->hex }}"
                            ></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="inline-flex flex-col items-start justify-start rounded-xl px-10 pb-6">
                <div class="flex flex-col items-start justify-start">
                    <div class="flex flex-col items-start justify-start gap-3 pb-8">
                        <div class="inline-flex items-start justify-start gap-4">
                            <div
                                class="text-center text-3xl leading-[62.40px] font-bold text-nowrap text-[#020202] opacity-80"
                            >
                                {{ $product->name }}
                            </div>
                            <div class="flex items-center justify-center gap-2">
                                <div class="bg-olive flex-inline items-center justify-center rounded-xl px-2 py-1.5">
                                    <div class="text-snow text-sm leading-[14px] font-bold uppercase">
                                        {{ __('product-show.new') }}
                                    </div>
                                </div>
                                <div class="flex-inline items-center justify-center rounded-xl bg-red-500 px-2 py-1.5">
                                    <div class="text-snow text-sm leading-[14px] font-bold">-20%</div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-hidden text-sm leading-normal font-normal text-[#020202] opacity-60">
                            {{ $product->description }}
                        </div>
                    </div>
                    <div class="inline-flex items-end justify-start gap-2 pb-8">
                        <div class="text-5xl leading-[48px] font-medium text-[#020202] opacity-80">
                            {{ round($product->variants->first()?->price_final / 100) }}
                        </div>
                        <div class="flex items-center justify-start gap-2">
                            <div
                                class="text-right text-sm leading-[25.20px] font-normal text-[#020202] line-through opacity-30"
                            >
                                {{ round($product->variants->first()?->price_online / 100) }}
                            </div>
                        </div>
                        <div class="flex items-center justify-center rounded-xl bg-[#fc3232] px-2 py-1.5">
                            <div class="text-sm leading-[14px] font-extrabold text-white">-20%</div>
                        </div>
                    </div>
                    <div class="flex w-full flex-col items-start justify-start gap-8 border-t border-[#eeeeee] py-8">
                        {{-- {{ $product->variants->first()?->color->hex }} --}}
                        {{-- {{ $product->variants->first()?->color }} --}}
                        <!-- Colors -->
                        <div class="flex w-full flex-col items-start justify-start gap-4">
                            <h3 class="text-sm font-medium text-gray-900">{{ __('product-show.desc.color') }}</h3>
                            <fieldset aria-label="Choose a color" class="mt-4">
                                <div class="flex items-center space-x-3">
                                    @foreach ($product->variants as $variant)
                                        <!-- Active and Checked: "ring ring-offset-1" -->
                                        <label
                                            aria-label="{{ $variant->color->name }}"
                                            class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none"
                                        >
                                            <input
                                                type="radio"
                                                name="color-choice"
                                                value="{{ $variant->color->id }}"
                                                class="peer sr-only"
                                            />
                                            <span
                                                aria-hidden="true"
                                                class="border-opacity-10 peer-checked::ring-offset-1 h-8 w-8 rounded-full border border-black bg-[{{ $variant->color->hex }}] peer-checked:ring"
                                            ></span>
                                        </label>
                                    @endforeach

                                    {{-- <!-- Active and Checked: "ring ring-offset-1" --> --}}
                                    {{-- <label aria-label="White" class="group relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none"> --}}
                                    {{-- <input type="radio" name="color-choice" value="White" class="peer sr-only" @checked(true)> --}}
                                    {{-- <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-white peer-checked:ring peer-checked::ring-offset-1"></span> --}}
                                    {{-- </label> --}}
                                    {{-- <!-- Active and Checked: "ring ring-offset-1" --> --}}
                                    {{-- <label aria-label="Gray" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none"> --}}
                                    {{-- <input type="radio" name="color-choice" value="Gray" class="peer sr-only"> --}}
                                    {{-- <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-200 peer-checked:ring peer-checked::ring-offset-1"></span> --}}
                                    {{-- </label> --}}
                                    {{-- <!-- Active and Checked: "ring ring-offset-1" --> --}}
                                    {{-- <label aria-label="Black" class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-900 focus:outline-none"> --}}
                                    {{-- <input type="radio" name="color-choice" value="Black" class="peer sr-only"> --}}
                                    {{-- <span aria-hidden="true" class="h-8 w-8 rounded-full border border-black border-opacity-10 bg-gray-900 peer-checked:ring peer-checked::ring-offset-1"></span> --}}
                                    {{-- </label> --}}
                                </div>
                            </fieldset>
                        </div>
                        <div class="flex w-full flex-col items-start justify-start gap-4">
                            <div class="flex w-full items-center justify-between">
                                <div class="inline-flex text-base font-normal text-[#020202]">
                                    {{ __('product-show.desc.size') }}
                                </div>
                                <a href="#" class="inline-flex items-center justify-start gap-1">
                                    <img class="w-3" src="{{ Vite::image('icons/size.png') }}" alt="" />
                                    <span class="text-sm leading-[14px] font-bold text-[#a8ba66] underline">
                                        {{ __('product-show.desc.size_guide') }}
                                    </span>
                                </a>
                            </div>
                            <div class="inline-flex items-center justify-start gap-2 pb-1">
                                <div
                                    class="flex items-center justify-center rounded-[100px] border border-[#eeeeee] bg-white px-5 py-[13px]"
                                >
                                    <div class="text-sm leading-[14px] font-bold text-[#020202]">Preemie</div>
                                </div>
                                <div
                                    class="flex items-center justify-center rounded-[100px] border border-[#eeeeee] bg-white px-5 py-[13px]"
                                >
                                    <div class="text-sm leading-[14px] font-bold text-[#020202]">0-3M</div>
                                </div>
                                <div
                                    class="flex items-center justify-center gap-2 rounded-[100px] border border-[#eeeeee] bg-white py-2 pr-5 pl-2"
                                >
                                    <div
                                        class="flex h-6 w-6 items-center justify-center rounded-[100px] bg-[#eac2c3] shadow-inner"
                                    >
                                        <div class="w-6 text-center text-sm leading-[14px] font-bold text-white">E</div>
                                    </div>
                                    <div class="text-sm leading-[14px] font-bold text-[#020202]">3-6M</div>
                                </div>
                                <div
                                    class="flex items-center justify-center rounded-[100px] border border-[#eeeeee] bg-white px-5 py-[13px]"
                                >
                                    <div class="text-sm leading-[14px] font-bold text-[#020202]">6-9M</div>
                                </div>
                                <div
                                    class="flex items-center justify-center rounded-[100px] border border-[#eeeeee] bg-white px-5 py-[13px]"
                                >
                                    <div class="text-sm leading-[14px] font-bold text-[#020202]">9-12M</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex w-full flex-col items-start justify-center gap-10 border-t border-b border-[#eeeeee] py-6"
                >
                    <div class="flex w-full items-center justify-center gap-4">
                        <x-primary-button
                            class="bg-secondary hover:!bg-secondary-dark !text-olive hover:!text-olive focus:!text-olive !border-transparent sm:py-4"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="mr-2 size-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                />
                            </svg>
                            {{ __('product-show.add-to-favorite') }}
                        </x-primary-button>
                        <x-primary-button class="w-full flex-grow sm:py-4">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="mr-2 size-5"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                                />
                            </svg>
                            {{ __('product-show.add-to-cart') }}
                        </x-primary-button>
                    </div>
                </div>
                <div class="w-full border-b border-zinc-100 pb-4">
                    <div class="flex w-full items-center justify-between pt-8 pb-4">
                        <div class="inline-flex text-base font-medium text-black">
                            {{ __('product-show.desc.title') }}
                        </div>
                        <div class="inline-flex opacity-40">&downarrow;</div>
                    </div>

                    <div class="w-full py-4">
                        <div class="flex w-full flex-col items-start justify-center gap-6 sm:max-w-[568px]">
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.article') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="inline-flex text-right text-sm font-medium text-black">
                                    {{ $product->barcode }} /
                                    {{ $product->variants->first()->sku }}
                                </div>
                            </div>
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.gender') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="text-right text-sm font-medium text-black">
                                    {{ $product->gender->name }}
                                </div>
                            </div>
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.fabric') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="text-right text-sm font-medium text-black">
                                    {{ $product->fabric->name }}
                                </div>
                            </div>
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.season') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="text-right text-sm font-medium text-black">
                                    {{ $product->season->name }}
                                </div>
                            </div>
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.sleeve') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="text-right text-sm font-medium text-black">Short-sleeved</div>
                            </div>
                            <div class="inline-flex w-full justify-between">
                                <div class="inline-flex text-sm font-normal text-black/40">
                                    {{ __('product-show.desc.closure') }}
                                </div>
                                <div
                                    class="mr-2 ml-2 flex shrink grow basis-0 items-end justify-start gap-1 overflow-hidden pb-1"
                                >
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                    <span class="h-px rounded-full border border-zinc-200"></span>
                                </div>
                                <div class="text-right text-sm font-medium text-black">Button fastened</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full border-b border-zinc-100 pb-4">
                    <div class="flex w-full items-center justify-between pt-8 pb-4">
                        <div class="inline-flex text-base font-medium text-black">Material care instructions</div>
                        <div class="inline-flex opacity-40">&downarrow;</div>
                    </div>
                    <div class="flex h-80 flex-col items-start justify-start gap-5 bg-white pt-2 pr-10 pb-4">
                        <div class="flex flex-col items-start justify-start gap-6">
                            <div class="inline-flex items-center justify-start gap-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-[100px] bg-[#f8f7f2] p-2"
                                >
                                    <div class="relative flex h-6 w-6 flex-col items-start justify-start opacity-80">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div class="text-sm leading-[18.20px] font-normal text-[#020202]">
                                    Wash at 40° to preserve the quality and colour of the fabric
                                </div>
                            </div>
                            <div class="inline-flex items-center justify-start gap-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-[100px] bg-[#f8f7f2] p-2"
                                >
                                    <div class="relative flex h-6 w-6 flex-col items-start justify-start opacity-80">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div class="text-sm leading-[18.20px] font-normal text-[#020202]">
                                    Avoid using bleach as it can damage the fabric
                                </div>
                            </div>
                            <div class="inline-flex items-center justify-start gap-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-[100px] bg-[#f8f7f2] p-2"
                                >
                                    <div class="relative flex h-6 w-6 flex-col items-start justify-start opacity-80">
                                        <img
                                            class="50px] w-[21.50px]"
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                        />
                                    </div>
                                </div>
                                <div class="text-sm leading-[18.20px] font-normal text-[#020202]">
                                    To dry the fabric use tumble drying on a low heat setting
                                </div>
                            </div>
                            <div class="inline-flex items-center justify-start gap-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-[100px] bg-[#f8f7f2] p-2"
                                >
                                    <div class="relative flex h-6 w-6 flex-col items-start justify-start opacity-80">
                                        <img
                                            class="50px] w-[21.50px]"
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                        />
                                    </div>
                                </div>
                                <div class="text-sm leading-[18.20px] font-normal text-[#020202]">
                                    Iron using a medium heat setting, with temperature max. 150°
                                </div>
                            </div>
                            <div class="inline-flex items-center justify-start gap-4">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-[100px] bg-[#f8f7f2] p-2"
                                >
                                    <div class="relative flex h-6 w-6 flex-col items-start justify-start opacity-80">
                                        <img
                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAACxAAAAsQHGLUmNAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAUxJREFUSInt079LW2EUxvFPbExoHKSVUoRMHcRBqFMKLiIodKmDRTp0r1Aourj4N7gXp0JHpUvBoVP3DA5icevi6C5taq3DPQmvLzfRCi7qFy73vM99zjnvr8s9d4rWTdQaSsT5JG7gQUliPZ6cWqb3alUT8RhP8BYPMYZttOP7MqYiPsBOxK/wAh38xLeoBSrZstawib3Q3uNRNGzja+iL4f+LHzEReIk3+JhMrEcjGuTUs5V2qWK4RF+NWj1Tl5P0Q8LvEg1O++gjUQsXD3kQw5HY5Sme9fH+Swd5g47iRuSs4HHEk3iHWSxlvhr+DGpwGAVSxhUrmI7xDLbwCROZdzJq9G2wj+eZtoBRxY16rdj7skMXufupkBuP0My0z/H+gC+K/V/HL+xm3mbUGMjGZYb/yb3qLboqZ7lQKTG1MHfNBt+V/MH33HLOAdUiLtxCP/GcAAAAAElFTkSuQmCC"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <div class="text-sm leading-[18.20px] font-normal text-[#020202]">
                                    This fabric should not be dry cleaned to avoid damage
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

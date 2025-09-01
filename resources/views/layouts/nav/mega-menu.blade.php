<div
    x-data
    x-cloak
    x-show="$store.dropdown.open"
    {{-- x-effect="document.body.classList.toggle('overflow-hidden', $store.dropdown.open)" --}}
    x-transition:enter="transition duration-200 ease-out"
    x-transition:enter-start="opacity-0 scale-95 "
    x-transition:enter-end="opacity-100 "
    x-transition:leave="transition duration-150 ease-in"
    x-transition:leave-start="opacity-100 "
    x-transition:leave-end="opacity-0  "
    @click.outside="$store.dropdown.close()"
    id="megaMenu"
    class="absolute top-[72px] left-0 z-50 h-[calc(100vh-161px)] w-full overflow-auto ring-black/5 lg:top-[calc(100%+1px)] lg:h-fit"
>
    <div class="relative h-full min-h-fit bg-white pb-5 shadow-lg lg:rounded-b-2xl">
        <div
            class="border-t-light-border relative container grid border-t py-5 lg:flex lg:gap-y-5 lg:px-[40px] lg:py-[60px]"
        >
            <h2 class="pb-2 text-[24px] font-bold opacity-80 lg:hidden">
                {{ __('header.menu.catalog') }}
            </h2>
            <div
                class="small-cards border-light-border grid-cols-3 rounded-2xl border lg:grid lg:w-[55%] lg:rounded-none lg:border-none"
            >
                @foreach ($clothes->subcategories as $category)
                    <a
                        href="{{ route('products.category.index', ['category' => $category]) }}"
                        class="small-cart-container group lg:bg-light-orange hover:bg-olive @if($loop->iteration != $loop->last) border-b border-light-border @endif @if ($loop->first)
                            rounded-t-2xl
                        @elseif ($loop->last)
                            rounded-b-2xl
                        @endif relative flex cursor-pointer items-center p-4 transition-all duration-500 ease-in-out lg:mr-[24px] lg:mb-[24px] lg:grid lg:h-[16vw] lg:max-h-[186px] lg:w-[16vw] lg:max-w-[212px] lg:justify-start lg:rounded-2xl lg:p-5"
                    >
                        <div class="small-cart_img_container">
                            {!! $category->icon !!}
                        </div>
                        <div class="small-cart-title grid items-end pl-3 lg:pl-0">
                            <p
                                class="m-0 p-0 font-normal transition-all duration-500 ease-in-out group-hover:text-white lg:text-[20px]"
                            >
                                {{ $category->name }}
                            </p>
                        </div>
                        <i
                            class="small-cart-arrow absolute right-0 p-3 transition-all duration-500 ease-in-out group-hover:p-2 lg:top-0"
                        >
                            <svg
                                class="text-gray-300/80 transition-all duration-500 ease-in-out group-hover:text-white"
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g>
                                    <path
                                        d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </g>
                            </svg>
                        </i>
                    </a>
                @endforeach
            </div>
        </div>
        <div
            class="relative right-0 bottom-0 mx-auto flex h-[224px] w-11/12 flex-col justify-between rounded-2xl lg:absolute lg:h-full lg:w-[45%] lg:rounded-none lg:rounded-br-2xl"
            style="
                background-image: url('{{ Vite::image('dropdown_bg.png') }}');
                background-size: cover;
                background-position: center;
            "
        >
            <div
                class="bg-filter from-charcoal/40 to-charcoal/10 absolute inset-0 rounded-2xl bg-gradient-to-t lg:rounded-none lg:rounded-br-2xl"
            ></div>
            <div class="align-end absolute inset-0 bottom-8 grid h-full w-full content-end items-end justify-center">
                <p class="text-center text-[30px] font-bold text-white lg:text-[40px]">Ready for summer</p>
                <p class="text-center text-sm font-normal text-white">Buy 4 products and get 30% off your cart</p>
                <x-ui.button class="mx-auto">Shop now</x-ui.button>
            </div>
        </div>
    </div>
    <div
        class="close relative mx-auto mt-10 hidden h-6 w-6 cursor-pointer rounded-full bg-white/20 p-5 text-center lg:block"
        @click="$store.dropdown.close()"
    >
        <div class="absolute inset-0 flex items-center justify-center">
            <svg class="" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.33337 14.6667L14.6667 1.33337M1.33337 1.33337L14.6667 14.6667"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>
    </div>
</div>

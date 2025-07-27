
<div
    x-data
    x-cloak
    x-show="$store.dropdown.open"
    {{--        x-effect="document.body.classList.toggle('overflow-hidden', $store.dropdown.open)"--}}
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95 "
    x-transition:enter-end="opacity-100 "
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 "
    x-transition:leave-end="opacity-0  "
    @click.outside="$store.dropdown.close()"
    id="megaMenu"
    class="absolute overflow-auto  left-0 w-full top-[72px] lg:top-[calc(100%+1px)] h-[calc(100vh-161px)] lg:h-fit  z-50    ring-black/5">
    <div class="bg-white shadow-lg relative lg:rounded-b-2xl min-h-fit h-full pb-5">
        <div class=" container grid lg:flex relative  lg:gap-y-5  lg:px-[40px] py-5 lg:py-[60px] border-t border-t-light-border">
            <h2 class="text-[24px] opacity-80 font-bold pb-2 lg:hidden">
                {{ __('header.menu.catalog') }}
            </h2>
            <div class="small-cards  lg:w-[55%] lg:grid grid-cols-3  border lg:border-none rounded-2xl lg:rounded-none  border-light-border">
                @foreach ($clothes->subcategories as $category)
                    <a href="{{ route('products.category.index', ['category' => $category]) }}"
                       class="small-cart-container  group relative cursor-pointer flex items-center lg:grid  lg:justify-start lg:bg-light-orange hover:bg-olive duration-500 ease-in-out transition-all
                           lg:rounded-2xl lg:mr-[24px] lg:mb-[24px] p-4 lg:p-5  lg:w-[16vw] lg:h-[16vw] lg:max-w-[212px] lg:max-h-[186px]
                            @if ($loop->iteration != 4) border-b border-light-border @endif
                            @if($loop->first) rounded-t-2xl  @elseif ($loop->iteration == 4) rounded-b-2xl @endif
                            ">
                        <div class="small-cart_img_container">
                            {!! $category->icon !!}
                        </div>
                        <div class="pl-3 lg:pl-0 small-cart-title grid items-end">
                            <p class="p-0 m-0 font-[600] group-hover:text-white duration-500 transition-all ease-in-out lg:text-[20px]">
                                {{ $category->name }}
                            </p>
                        </div>
                        <i class="small-cart-arrow absolute right-0 lg:top-0 p-3 group-hover:p-2  duration-500 ease-in-out transition-all">
                            <svg
                                class="text-gray-300/80 group-hover:text-white transition-all duration-500 ease-in-out"
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <g >
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
        <div class="w-11/12 mx-auto lg:w-[45%] h-[224px] lg:h-full rounded-2xl lg:rounded-none relative lg:absolute right-0 bottom-0 lg:rounded-br-2xl flex flex-col justify-between"
             style="background-image: url('{{ Vite::image('dropdown_bg.png') }}'); background-size: cover; background-position: center;">
            <div class="bg-filter absolute rounded-2xl lg:rounded-none lg:rounded-br-2xl inset-0 bg-gradient-to-t from-charcoal/40 to-charcoal/10"></div>
            <div class="absolute bottom-8 inset-0 grid justify-center items-end content-end align-end h-full w-full">
                <p class="text-center text-white text-[30px] lg:text-[40px] font-bold">Ready for summer</p>
                <p class="text-center text-white text-[14px] font-normal">Buy 4 products and get 30% off your cart</p>
                <x-ui.button class="mx-auto">Shop now</x-ui.button>
            </div>
        </div>
    </div>
    <div class="close relative hidden lg:block text-center w-6 h-6 cursor-pointer mt-10 bg-white/20 rounded-full p-5 mx-auto"
         @click="$store.dropdown.close()"
    >
        <div class="absolute inset-0 flex items-center justify-center">
            <svg class="" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.33337 14.6667L14.6667 1.33337M1.33337 1.33337L14.6667 14.6667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

    </div>
</div>

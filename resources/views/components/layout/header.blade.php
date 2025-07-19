<header class="relative z-10 bg-white">
    <div class="bg-light-orange hidden lg:block">
        <div class="container   flex justify-between">
            <div class="flex-1 flex items-center gap-5">
                <a href="#" class="text-[13px] font-[500]">Pickup locations</a>
                <a href="#" class="text-[13px] font-[500]">Careers</a>
                <a href="#" class="text-[13px] font-[500]">Terms & Conditions</a>
            </div>
            <div class="flex-1 flex justify-end gap-5 items-center">
                <div class="dropdown">
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <div>
                            <button
                                @click="open = !open"
                                type="button"
                                class="inline-flex items-center w-full justify-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-gray-900 ring-gray-300 ring-inset hover:bg-gray-50"
                                id="menu-button"
                                aria-expanded="true"
                                aria-haspopup="true"
                            >
                                <img src="{{ asset('assets/images/flag.svg') }}" alt="flag">
                                English
                                <svg class="-mr-1 size-5 text-black" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div
                            x-show="open"
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            @click.outside="open = false"
                            class="absolute  right-0 z-20 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="menu-button"
                            tabindex="-1"
                        >
                            <div class="p-1" role="none">
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 mb-2 py-2 text-[14px] text-gray-700 bg-light-charcoal rounded-lg" role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_en.svg') }}" alt="flag">
                                        <span class="font-bold">English</span>
                                    </div>
                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">
                                </a>
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 mb-2 py-2 text-[14px] text-gray-700  rounded-lg hover:bg-light-charcoal animated" role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_rom.svg') }}" alt="flag">
                                        <span class="font-bold">Română</span>
                                    </div>
{{--                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">--}}
                                </a>
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 mb-2 py-2 text-[14px] text-gray-700 rounded-lg hover:bg-light-charcoal animated" role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_ru.svg') }}" alt="flag">
                                        <span class="font-bold">Русский</span>
                                    </div>
{{--                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">--}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <a href="" class="text-[13px] font-[500]">+373 (60) 394 474</a>
            </div>
        </div>
    </div>

    <nav class="container relative z-10 h-[72px] lg:h-[88px] flex justify-between font-bold">
        <div class="flex items-center gap-10">
            <div class="logo">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="">
            </div>

        </div>
        <div class="w-full relative z-10   min-h-[60px] px-10 items-center justify-between hidden lg:flex">
            <ul class="nav-items h-full flex justify-start items-center gap-y-5 gap-x-10 ">
                <li class="dropdown relative h-full  flex items-center px-2 "
                    :class="{ 'border-olive border-b-2 ': $store.dropdown.open, 'border-transparent border-b-2 ': !$store.dropdown.open }"
                    x-data

                >
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <div>
                            <button
                                @click="$store.dropdown.toggle()"
                                type="button"
                                class="inline-flex items-center w-full justify-center"
                                :class="{ 'text-olive': $store.dropdown.open }"
                                id="menu-button"
                                aria-expanded="true"
                                aria-haspopup="true"
                            >
                                Explore
                                <svg class="-mr-1 size-5 text-black" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>


                    </div>
                </li>
                <li class="h-full flex items-center border-transparent border-b-2"><a href="/">About</a></li>
                <li class="h-full flex items-center border-transparent border-b-2"><a href="/">Help</a></li>
                <li class="h-full flex items-center border-transparent border-b-2"><a href="/">Contact us</a></li>
            </ul>
            <div data-vue-component="Search"></div>

        </div>

        {{--    mobile menu    --}}
            <div class="flex lg:hidden items-center gap-x-2">
                <div class="dropdown border border-black/10 rounded-full ">
                    <div x-data="{ open: false }" class="relative inline-block text-left">
                        <div>
                            <button
                                @click="open = !open"
                                type="button"
                                class="inline-flex items-center w-full justify-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-gray-900 ring-gray-300 ring-inset hover:bg-gray-50"
                                id="menu-button"
                                aria-expanded="true"
                                aria-haspopup="true"
                            >
                                <img src="{{ asset('assets/images/flag.svg') }}" alt="flag">
                                English
                                <svg class="-mr-1 size-5 text-black" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <div
                            x-show="open"
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            @click.outside="open = false"
                            class="absolute  right-0 z-20 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="menu-button"
                            tabindex="-1"
                        >
                            <div class="p-1" role="none">
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 py-2 text-[14px] text-gray-700 bg-light-charcoal rounded-lg" role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_en.svg') }}" alt="flag">
                                        <span class="font-bold">English</span>
                                    </div>
                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">
                                </a>
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 py-2 text-[14px] text-gray-700 hover:bg-light-charcoal animated  rounded-lg" role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_rom.svg') }}" alt="flag">
                                        <span class="font-bold">Română</span>
                                    </div>
                                    {{--                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">--}}
                                </a>
                                <a href="#" class="flex justify-between items-center gap-x-2 px-4 py-2 text-[14px] text-gray-700 hover:bg-light-charcoal animated " role="menuitem">
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" src="{{ asset('assets/images/icons/flags/fl_ru.svg') }}" alt="flag">
                                        <span class="font-bold">Русский</span>
                                    </div>
                                    {{--                                    <img src="{{ asset('assets/images/icons/checked_ol.svg') }}" alt="checked">--}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <a class="p-2 w-[33px] h-[33px] flex items-center border border-black/10 rounded-full" href="#">
                    <img height="13" src="{{ asset('assets/images/icons/phone_i.svg') }}" alt="">
                </a>
                <div class="flex items-center relative" x-data="{ open: false }" x-effect="document.body.classList.toggle('overflow-hidden', open)">
                    <div @click="open = !open" class="menu-controll relative group z-50">
                        <div class="relative border border-black/10 flex overflow-hidden items-center justify-center rounded-full w-[33px] h-[33px] transform transition-all duration-200 ">
                            <div class="flex flex-col justify-between w-[15px] h-[15px] transform transition-all duration-300 origin-center overflow-hidden">
                                <!-- Верхня лінія -->
                                <div
                                    class="bg-black h-[2px] w-6 transform transition-all duration-300 origin-left delay-100"
                                    :class="open ? 'translate-y-6 opacity-0' : ''"
                                ></div>

                                <!-- Середня лінія -->
                                <div
                                    class="bg-black h-[2px] w-6 rounded transform transition-all duration-300 delay-75"
                                    :class="open ? 'translate-y-6 opacity-0' : ''"
                                ></div>

                                <!-- Нижня лінія -->
                                <div
                                    class="bg-black h-[2px] w-6 transform transition-all duration-300 origin-left"
                                    :class="open ? 'translate-y-6 opacity-0' : ''"
                                ></div>

                                <!-- Хрестик -->
                                <div
                                    class="absolute top-[7.5px] left-[7.5px] flex items-center justify-center opacity-0 w-0 h-0 transition-all duration-300"
                                    :class="open ? 'w-[17px] h-[17px] opacity-100' : ''"
                                >
                                    <div
                                        class="absolute bg-black h-[2px] w-[17px] transform rotate-45 transition-all duration-300"
                                    ></div>
                                    <div
                                        class="absolute bg-black h-[2px] w-[17px] transform -rotate-45 transition-all duration-300"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Меню -->
                    <div
                        id="mobile-menu"
                        x-show="open"
                        x-cloak
                        x-transition:enter="transition duration-300 ease-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition duration-200 ease-in"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        @click.outside="open = false"
                        class="fixed top-[72px] inset-0 bg-black/50 z-30"
                    >
                        <div class="bg-white grid items-center justify-center p-4 absolute top-0 right-0 w-screen h-full shadow-lg">
                            <ul class="mt-4 space-y-4 text-center">
                                <li><a href="#" class="text-black text-[32px]">About</a></li>
                                <li><a href="#" class="text-black text-[32px]">Locations</a></li>
                                <li><a href="#" class="text-black text-[32px]">Careers</a></li>
                                <li><a href="#" class="text-black text-[32px]">Terms</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        {{--    mobile menu    --}}

        <div class="hidden lg:flex w-2/12 lg:w-1/12 items-center gap-y-5 gap-x-10 justify-end">

            <div data-vue-component="CartDropdown"></div>
            <div data-vue-component="UserDropdown"></div>

        </div>

    </nav>
    <div class="container flex justify-start relative">
       <div class="w-8/11 -left-13 mx-auto relative ">
{{--           <div id="search-results-container" class="left-0 pl-5 pr-12 w-full z-40"></div>--}}
       </div>
    </div>
    <div
        x-data
        x-cloak
        x-show="$store.dropdown.open"
        x-effect="document.body.classList.toggle('overflow-hidden', $store.dropdown.open)"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 "
        x-transition:enter-end="opacity-100 "
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 "
        x-transition:leave-end="opacity-0  "
        @click.outside="$store.dropdown.close()"
        id="megaMenu"
        class="absolute left-0 w-full top-[calc(100%+1px)] h-[calc(100vh-100px)] lg:h-fit  z-50 rounded-b-2xl bg-white shadow-lg  ring-black/5">
        <div class="container grid lg:flex relative  gap-y-5 px-5 lg:px-[64px] py-[60px]">
            <h2 class="text-[24px] opacity-80 font-bold lg:hidden">Explore</h2>
            <div class="small-cards lg:w-[50%] lg:grid grid-cols-3  lg:gap-6  border lg:border-none rounded-2xl lg:rounded-none  border-light-border">
                @for ($i = 0; $i < 5; $i++)
                        <a href="#"
                           class="small-cart-container group relative cursor-pointer flex items-center  lg:grid  lg:justify-between lg:bg-light-orange hover:bg-olive duration-500 ease-in-out transition-all lg:rounded-2xl m-2 p-3 lg:p-5   lg:h-[200px]
                            @if ($i!== 4) border-b border-light-border @endif
                            ">
                            <div class="small-cart_img_container">
                                <svg class="text-olive group-hover:text-white animated w-[24px] h-[24px] lg:w-[38px] lg:h-[38px]"  viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.28571 21.7L2.73695 19.6437C1.75688 19.2805 1.22175 18.2239 1.50889 17.2189L4.51054 6.71312C5.47673 3.33146 8.56761 1 12.0846 1V1C12.383 1 12.6557 1.16857 12.7891 1.43544L13.4179 2.69292C14.4751 4.80727 16.6361 6.14286 19 6.14286V6.14286C21.3639 6.14286 23.5249 4.80727 24.5821 2.69292L25.2109 1.43544C25.3443 1.16857 25.617 1 25.9154 1V1C29.4324 1 32.5233 3.33146 33.4895 6.71312L36.4911 17.2189C36.7783 18.2239 36.2431 19.2805 35.2631 19.6437L29.7143 21.7M8.28571 21.7V33.5193C8.28571 35.4416 9.84408 37 11.7664 37V37C13.2174 37 14.5161 36.1 15.0255 34.7414L17.6603 27.7155C18.1245 26.4776 19.8755 26.4776 20.3397 27.7155L22.9745 34.7414C23.4839 36.1 24.7826 37 26.2336 37V37C28.1559 37 29.7143 35.4416 29.7143 33.5193V21.7M8.28571 21.7V16.75M29.7143 21.7V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </div>
                            <div class="pl-3 lg:pl-0 small-cart-title grid items-end">
                                <p class="p-0 m-0 font-[600] group-hover:text-white duration-500 transition-all ease-in-out lg:text-[20px]">Jumpsuits</p>
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

                @endfor

            </div>

            <div class="close hidden lg:block absolute cursor-pointer bottom-[-100px] bg-white/20 rounded-full p-5 left-1/2"
                 @click="$store.dropdown.close()"
            >
                <img src="{{asset('assets/images/icons/close.svg')}}" alt="close">
            </div>
        </div>
        <div class="w-11/12 mx-auto lg:w-[45%] h-[224px] lg:h-full rounded-2xl lg:rounded-none relative lg:absolute right-0 bottom-0 lg:rounded-br-2xl flex flex-col justify-between"
             style="background-image: url('{{ asset('assets/images/dropdown_bg.png') }}'); background-size: cover; background-position: center;">
            <div class="bg-filter absolute rounded-2xl lg:rounded-none lg:rounded-br-2xl inset-0 bg-black/40"></div>
            <div class="absolute bottom-8 grid justify-center w-full">
                <p class="text-center text-white text-[30px] lg:text-[40px]">Ready for summer</p>
                <p class="text-center text-white font-normal">Buy 4 products and get 30% off your cart</p>
                <x-button class="mx-auto">Shop now</x-button>
            </div>
        </div>
    </div>
</header>


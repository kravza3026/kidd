<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <style>
        * {
                    font-family: "Onest", sans-serif;
                    font-optical-sizing: auto;
                    font-style: normal;
                }
    </style>
    <body>
        <header>
            <div class="container py-2 bg-light-orange flex justify-between">
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
                                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="menu-button"
                                tabindex="-1"
                            >
                                <div class="py-1" role="none">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Account settings</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Support</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">License</a>
                                    <form method="POST" action="#" role="none">
                                        <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="" class="text-[13px] font-[500]">+373 (60) 394 474</a>
                </div>
            </div>
            <nav class="container relative py-6 flex justify-between font-bold">
                <div class="flex items-center gap-10">
                    <div class="logo">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="">
                    </div>

                </div>
                <div class="w-full relative  min-h-[60px] px-10 flex items-center justify-between">
                    <ul class="nav-items flex justify-start items-center gap-y-5 gap-x-10 ">
                        <li class="dropdown">
                            <div x-data="{ open: false }" class="relative inline-block text-left">
                                <div>
                                    <button
                                        @click="$store.dropdown.toggle()"
                                        type="button"
                                        class="inline-flex items-center w-full justify-center"
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

{{--                                <div  x-show="$store.dropdown.open" x-cloak x-data--}}
{{--                                    x-transition:enter="transition ease-out duration-100"--}}
{{--                                    x-transition:enter-start="transform opacity-0 scale-95"--}}
{{--                                    x-transition:enter-end="transform opacity-100 scale-100"--}}
{{--                                    x-transition:leave="transition ease-in duration-75"--}}
{{--                                    x-transition:leave-start="transform opacity-100 scale-100"--}}
{{--                                    x-transition:leave-end="transform opacity-0 scale-95"--}}
{{--                                    @click.outside="open = false"--}}
{{--                                    class="right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"--}}
{{--                                    role="menu"--}}
{{--                                    aria-orientation="vertical"--}}
{{--                                    aria-labelledby="menu-button"--}}
{{--                                    tabindex="-1"--}}
{{--                                >--}}
{{--                                    <div class="content py-1 w-full" role="none">--}}
{{--                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Account settings</a>--}}
{{--                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">Support</a>--}}
{{--                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem">License</a>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                        </li>
                        <li><a href="/">About</a></li>
                        <li><a href="/">Help</a></li>
                        <li><a href="/">Contact us</a></li>
                    </ul>
                    <div x-data="searchInput()">
                        <div class="search w-full h-full flex items-center gap-x-5"
                             @click="open = true"
                        >
                            <img src="{{asset('assets/images/search.svg')}}" width="24" height="24" alt="cart">
                            <span>Search</span>
                        </div>
                        <div
                            x-show="open"
                            x-transition:enter="transition-all duration-300 origin"
                            x-transition:enter-start="right-[-100%]"
                            x-transition:enter-end="right-0"
                            x-transition:leave="transition-all duration-300 origin"
                            x-transition:leave-start="right-0"
                            x-transition:leave-end="w-0"
                            :class="open ? 'right-0' : 'right-[-100%]'"
                            class="search-input  absolute top-0 right-0 bg-white h-full flex items-center h-[50px] justify-around gap-x-5 w-full"
                            x-cloak
                            @click.outside="open = false"

                        >
                            <div class="relative flex items-center w-10/11 mx-auto">
                                <input
                                    @keydown.escape="searchOpen = false"
                                    x-ref="searchInput"
                                    @show.window="setTimeout(() => $refs.searchInput.focus(), 1750)"
                                    type="text"
                                    class="w-full h-[50px] pl-5 pr-12 rounded-md bg-light-orange "
                                    placeholder=""
                                />
                                <img
                                    src="{{ asset('assets/images/search.svg') }}"
                                    width="24"
                                    height="24"
                                    alt="search"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex w-1/12 items-center gap-y-5 gap-x-10 justify-end">

                    <div class="cart">
                        <img src="{{asset('assets/images/cart.svg')}}" width="24" height="24" alt="cart">
                    </div>
                    <div class="user">
                        <img src="{{asset('assets/images/user.svg')}}" alt="user">
                    </div>
                </div>
                <div
                    x-data
                    x-show="$store.dropdown.open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95 "
                    x-transition:enter-end="opacity-100 "
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 "
                    x-transition:leave-end="opacity-0  "
                    @click.outside="$store.dropdown.close()"
                    class="absolute left-0 w-full top-28 w-56 z-50 rounded-b-2xl bg-white shadow-lg  ring-black/5"
                    x-cloak
                >
                    <div class="flex relative gap-y-5 px-16 py-5">
                        <div class="small-cards w-[55%] flex flex-wrap gap-10 ">
                           @for ($i = 0; $i < 5; $i++)
                               <div class="small-cart-container group relative cursor-pointer grid justify-between bg-light-orange hover:bg-olive duration-500 ease-in-out transition-all rounded-2xl p-10 w-[200px] h-[200px]">
                                   <div class="small-cart_img_container">
                                       <svg class="text-olive group-hover:text-white duration-700 " width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path d="M8.28571 21.7L2.73695 19.6437C1.75688 19.2805 1.22175 18.2239 1.50889 17.2189L4.51054 6.71312C5.47673 3.33146 8.56761 1 12.0846 1V1C12.383 1 12.6557 1.16857 12.7891 1.43544L13.4179 2.69292C14.4751 4.80727 16.6361 6.14286 19 6.14286V6.14286C21.3639 6.14286 23.5249 4.80727 24.5821 2.69292L25.2109 1.43544C25.3443 1.16857 25.617 1 25.9154 1V1C29.4324 1 32.5233 3.33146 33.4895 6.71312L36.4911 17.2189C36.7783 18.2239 36.2431 19.2805 35.2631 19.6437L29.7143 21.7M8.28571 21.7V33.5193C8.28571 35.4416 9.84408 37 11.7664 37V37C13.2174 37 14.5161 36.1 15.0255 34.7414L17.6603 27.7155C18.1245 26.4776 19.8755 26.4776 20.3397 27.7155L22.9745 34.7414C23.4839 36.1 24.7826 37 26.2336 37V37C28.1559 37 29.7143 35.4416 29.7143 33.5193V21.7M8.28571 21.7V16.75M29.7143 21.7V16.75" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>

                                   </div>
                                   <div class="small-cart-title grid items-end">
                                       <p class="p-0 m-0 font-[600] group-hover:text-white duration-500 transition-all ease-in-out text-[20px]">Jumpsuits</p>
                                   </div>
                                   <i class="small-cart-arrow absolute right-0 top-0 p-3 group-hover:p-2  duration-500 ease-in-out transition-all">
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
                               </div>
                           @endfor

                       </div>
                        <div class="w-[45%] h-full absolute right-0 bottom-0 rounded-br-2xl flex flex-col justify-between"
                            style="background-image: url('{{ asset('assets/images/dropdown_bg.png') }}'); background-size: cover; background-position: center;">
                            <div class="bg-filter absolute rounded-br-2xl inset-0 bg-black/40"></div>
                            <div class="absolute bottom-8 grid justify-center w-full">
                                <p class="text-center text-white text-[40px]">Ready for summer</p>
                                <p class="text-center text-white">Buy 4 products and get 30% off your cart</p>
                                <div class="button flex gap-5 items-center bg-olive justify-center w-fit mx-auto py-5 px-10 my-5 rounded-2xl text-white">
                                    Shop now

                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div id="app">

        <div id="content"></div>
        </div>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('dropdown', {
                    open: false,
                    toggle() {
                        this.open = !this.open;
                    },
                    close() {
                        this.open = false;
                    }
                })
            });
            function searchInput() {
                return {
                    open: false,
                    openSearch() {
                        this.open = true;
                        this.$nextTick(() => {
                            setTimeout(() => this.$refs.searchInput.focus(), 300);
                        });
                    },
                    closeSearch() {
                        this.open = false;
                    },
                };
            }
        </script>
    </body>
</html>

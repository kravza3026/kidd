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

    <body>
        <x-layout.header />
       <main class="bg-white">
           <x-layout.home-page />
       </main>
        <x-layout.footer />
        <div class="menu xl:hidden fixed z-50 bottom-0 w-full pb-3 bg-white">
            <div class="bg-white py-1 border-y-1 border-gray-200 ">
                <div class="flex">
                    <div class="flex-1 group">
                        <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/menu.svg') }}" alt="menu">
                            <span class="block text-[12px] pb-1">Explore</span>
                        </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/search.svg') }}" alt="search">
                            <span class="block text-[12px] pb-1">Search</span>
                        </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                           <img  class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/card.svg') }}" alt="cart">
                            <span class="block text-[12px] pb-1">Cart</span>
                        </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/faq.svg') }}" alt="faq">
                            <span class="block text-[12px] pb-1">Help</span>
                        </span>
                        </a>
                    </div>
                    <div class="flex-1 group">
                        <a href="#" class="flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-gray-400 group-hover:text-indigo-500">
                        <span class="block text-charcoal/60 font-bold px-1 pt-1 pb-2">
                            <img class="mx-auto pb-1 opacity-65" src="{{ asset('assets/images/icons/user.svg') }}" alt="account">
                            <span class="block text-[12px] pb-1">Account</span>
                        </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <div class="backdrop fixed inset-0 bg-black/70 z-[2]"
             x-data
             x-cloak
             x-show="$store.dropdown.open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 "
             x-transition:enter-end="opacity-100 "
        ></div>
    </body>
</html>

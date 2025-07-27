{{--    mobile menu    --}}
<div class="flex lg:hidden items-center gap-x-2">
    <div class="dropdown border border-black/10 rounded-full ">
        @include('layouts.partials._lang_switcher')
    </div>
    <a class="p-2 w-[33px] h-[33px] flex items-center border border-black/10 rounded-full" href="tel:+37360123456">
        <img height="13" src="{{ Vite::image('icons/phone_i.svg') }}" alt="">
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
                    <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.menu.about') }}" class="text-black text-[32px] hover:text-olive">
                            {{ __('header.menu.about') }}
                        </a></li>
                    <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.locations') }}" class="text-black text-[32px] hover:text-olive">
                            {{ __('header.topline.locations') }}
                        </a></li>
                    <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.careers') }}" class="text-black text-[32px] hover:text-olive">
                            {{ __('header.topline.careers') }}
                        </a></li>
                    <li><a href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.terms') }}" class="text-black text-[32px] hover:text-olive">
                            {{ __('header.topline.terms') }}
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
{{--    mobile menu    --}}

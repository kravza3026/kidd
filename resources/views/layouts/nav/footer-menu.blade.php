
<!-- Categories -->
<div class="flex flex-col gap-2 rounded-lg bg-charcoal py-2 text-white">
    <button type="button" @click="toggle('catalog')" class="flex items-center justify-between cursor-pointer w-full xl:cursor-default">
        <h5 class="text-snow text-lg opacity-60 font-bold " :class="{ 'opacity-100': open === 'catalog' }">
            {{ __('header.menu.catalog') }}
        </h5>
        <img class="w-3.5 transition-transform duration-500 xl:invisible opacity-40 -rotate-180" :class="{ 'rotate-0 opacity-100': open === 'catalog' }" src="{{ Vite::image('icons/accordion_arrow.png')
                        }}" alt="">
    </button>

    <div class="overflow-hidden transition-all duration-500 xl:visible xl:max-h-screen xl:opacity-100"
         :class="{
                            'max-h-0 opacity-0 invisible': open !== 'catalog',
                            'max-h-screen opacity-100 visible': open === 'catalog'
                        }">
        <ul class="mt-3 mb-3 xl:mb-0">
            @foreach($clothes->subcategories as $category)
                <li class="opacity-40 hover:opacity-60 text-base py-2">
                    <a href="{{ route('products.category.index', $category->slug) }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
    <hr class="mt-1 xl:hidden border border-dark">
</div>


<!-- Help -->
<div class="flex flex-col gap-2 rounded-lg bg-charcoal py-2 text-white">
    <button type="button" @click="toggle('help')" class="flex items-center justify-between cursor-pointer w-full xl:cursor-default">
        <h5 class="text-snow text-lg opacity-60 font-bold " :class="{ 'opacity-100': open === 'help' }">
            {{ __('footer.menu.help.title') }}
        </h5>
        <img class="w-3.5 transition-transform duration-500 xl:invisible opacity-40 -rotate-180" :class="{ 'rotate-0 opacity-100': open === 'help' }" src="{{ Vite::image('icons/accordion_arrow.png')
                        }}" alt="">
    </button>

    <div class="overflow-hidden transition-all duration-500 xl:visible xl:max-h-screen xl:opacity-100"
         :class="{
                            'max-h-0 opacity-0 invisible': open !== 'help',
                            'max-h-screen opacity-100 visible': open === 'help'
                        }">
        <ul class="mt-3 mb-3 xl:mb-0">
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="#">{{ __('footer.menu.help.faq') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="#">{{ __('footer.menu.help.size_chart') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="#">{{ __('footer.menu.help.returns') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="#">{{ __('footer.menu.help.delivery') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.contacts') }}">{{ __('footer.menu.help.contacts') }}</a>
            </li>
        </ul>
    </div>
    <hr class="mt-1 xl:hidden border border-dark">
</div>

<!-- Company -->
<div class="flex flex-col gap-2 rounded-lg bg-charcoal py-2 text-white">
    <button type="button" @click="toggle('company')" class="flex items-center justify-between cursor-pointer w-full xl:cursor-default">
        <h5 class="text-snow text-lg opacity-60 font-bold " :class="{ 'opacity-100': open === 'company' }">
            {{ __('footer.menu.company.title') }}
        </h5>
        <img class="w-3.5 transition-transform duration-500 xl:invisible opacity-40 -rotate-180" :class="{ 'rotate-0 opacity-100': open === 'company' }" src="{{ Vite::image('icons/accordion_arrow.png')
                        }}" alt="">
    </button>

    <div class="overflow-hidden transition-all duration-500 xl:visible xl:max-h-screen xl:opacity-100"
         :class="{
                            'max-h-0 opacity-0 invisible': open !== 'company',
                            'max-h-screen opacity-100 visible': open === 'company'
                        }">
        <ul class="mt-3 mb-3 xl:mb-0">
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.about') }}">{{ __('footer.menu.company.about') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.locations') }}">{{ __('footer.menu.company.locations') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.careers.careers') }}">{{ __('footer.menu.company.careers') }}</a>
            </li>
            <li class="opacity-40 hover:opacity-60 text-base py-2">
                <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.terms') }}">{{ __('footer.menu.company.terms') }}</a>
            </li>
        </ul>
    </div>
    <hr class="mt-1 xl:hidden border border-dark">
</div>

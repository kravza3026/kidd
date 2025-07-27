<ul class="nav-items h-full grid grid-cols-4 items-center gap-y-5 gap-x-2 ">
    <li class="dropdown relative h-full  flex items-center px-2 "
        :class="{ 'border-olive border-b-2 ': $store.dropdown.open, 'border-transparent border-b-2 ': !$store.dropdown.open }"
        x-data>
        <div x-data="{ open: false }" class="relative inline-block text-left">
            <div>
                <button
                    @click="$store.dropdown.toggle()"
                    type="button"
                    class="inline-flex items-center w-full justify-center cursor-pointer"
                    :class="{ 'text-olive': $store.dropdown.open }"
                    id="menu-button"
                    aria-expanded="true"
                    aria-haspopup="true"
                >
                    {{ __('header.menu.catalog') }}
                    <svg class="-mr-1 size-5 text-black"  :class="{ 'text-olive': $store.dropdown.open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

        </div>
    </li>
    <li class="h-full flex items-center  border-b-2 {{ Route::is('about') ? 'text-olive border-olive border-b-2' : 'border-transparent' }}">
        <a class="mx-auto" href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.menu.about') }}">
            {{ __('header.menu.about') }}
        </a>
    </li>
    <li class="h-full flex items-center border-transparent border-b-2">
        <a class="mx-auto" href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.menu.help') }}">
            {{ __('header.menu.help') }}
        </a>
    </li>
    <li class="h-full flex items-center border-transparent border-b-2">
        <a class="mx-auto" href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.menu.contacts') }}">
            {{ __('header.menu.contacts') }}
        </a>
    </li>
</ul>

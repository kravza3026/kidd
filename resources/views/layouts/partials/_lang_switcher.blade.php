<div class="dropdown">
    <div x-data="{ open: false }" class="relative z-[100002] inline-block text-left">
        <div>
            <button
                x-on:click="open = !open"
                type="button"
                class="inline-flex w-full items-center justify-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-gray-900 ring-gray-300 ring-inset hover:bg-gray-50"
                id="menu-button"
                aria-expanded="true"
                aria-haspopup="true"
            >
                @foreach (LaravelLocalization::getLocalesOrder() as $code => $locale)
                    @if (LaravelLocalization::getCurrentLocale() === $code)
                        <img class="size-4" src="{{ Vite::image($locale['flag']) }}" alt="flag" />
                        {{ $locale['native'] }}
                    @endif
                @endforeach

                <svg
                    class="-mr-1 size-5 text-black"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                    aria-hidden="true"
                    data-slot="icon"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
        </div>

        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition duration-100 ease-out"
            x-transition:enter-start="scale-95 transform opacity-0"
            x-transition:enter-end="scale-100 transform opacity-100"
            x-transition:leave="transition duration-75 ease-in"
            x-transition:leave-start="scale-100 transform opacity-100"
            x-transition:leave-end="scale-95 transform opacity-0"
            x-on:click.outside="open = false"
            class="absolute right-0 z-[100003] mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="menu-button"
            tabindex="-1"
        >
            <div class="flex flex-col gap-y-1 p-1" role="none">
                @foreach (LaravelLocalization::getLocalesOrder() as $code => $locale)
                    <a
                        href="{{ LaravelLocalization::getLocalizedURL($code) }}"
                        class="hover:bg-light-charcoal animated {{ (LaravelLocalization::getCurrentLocale() === $code) ? 'bg-light-charcoal' : 'hover:bg-light-charcoal' }} flex items-center justify-between gap-x-2 rounded-lg px-4 py-2 text-sm text-gray-700"
                        role="menuitem"
                    >
                        <div class="flex gap-x-2">
                            <img width="24" height="24" src="{{ Vite::image($locale['flag']) }}" alt="flag" />
                            <span class="font-bold">{{ $locale['native'] }}</span>
                        </div>
                        @if (LaravelLocalization::getCurrentLocale() === $code)
                            <img src="{{ Vite::image('icons/olive/checked_ol.svg') }}" alt="checked" />
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

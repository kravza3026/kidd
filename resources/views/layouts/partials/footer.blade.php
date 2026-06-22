@php($storeSettings = app(App\Settings\StoreSettings::class))
<footer
    class="bg-charcoal mt-7 pt-5 pb-28 lg:pb-5 xl:mt-0"
    x-data="{
        open: null,
        toggle(idx) {
            this.open = this.open === idx ? null : idx
        },
    }"
>
    <div class="container">
        <div class="grid grid-cols-1 space-y-2 xl:flex xl:justify-between">
            <!-- Follow Us -->
            <div
                class="bg-charcoal order-last flex items-center justify-between gap-2 py-2 text-white xl:order-first xl:flex-col xl:items-start xl:justify-start"
            >
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-bold text-white opacity-60">{{ __('footer.social.follow_us') }}</h5>
                </div>
                <ul class="group flex items-center gap-4 xl:mt-7">
                    <li>
                        <a class="group" href="{{ $storeSettings->facebook_url ?: config('services.social_links.facebook') }}">
                            <img src="{{ Vite::image('icons/socials/facebook.svg') }}" alt="facebook icon" />
                        </a>
                    </li>
                    <li>
                        <a class="group" href="{{ $storeSettings->instagram_url ?: config('services.social_links.instagram') }}">
                            <img
                                class="size-[26px] opacity-40"
                                src="{{ Vite::image('icons/socials/instagram.svg') }}"
                                alt="instagram icon"
                            />
                        </a>
                    </li>
                    <li>
                        <a href="{{ $storeSettings->messenger_url ?: config('services.social_links.messenger') }}">
                            <img src="{{ Vite::image('icons/socials/messenger.svg') }}" alt="messenger icon" />
                        </a>
                    </li>
                    <li>
                        <a href="{{ $storeSettings->youtube_url ?: config('services.social_links.youtube') }}">
                            <img src="{{ Vite::image('icons/socials/youtube_i.svg') }}" alt="youtube icon" />
                        </a>
                    </li>
                </ul>
            </div>

            @include('layouts.nav.footer-menu')

            <!-- Subscribe -->
            <div class="bg-charcoal flex flex-col gap-2 rounded-lg py-2 text-white xl:min-w-4/12">
                <div class="flex items-center justify-between">
                    <h5 class="text-lg font-bold text-white opacity-60">{{ __('footer.newsletter.title') }}</h5>
                </div>
                <div class="h-auto items-center transition-all xl:max-h-screen">
                    <div class="relative mt-2 w-full">
                        <input
                            class="border-dark/50 w-full rounded-2xl border bg-white/10 px-3 py-[19px] placeholder-white/50 focus:outline-none"
                            type="text"
                            name="email"
                            placeholder="{{ __('footer.newsletter.email_placeholder') }}"
                        />
                        <button
                            class="bg-charcoal text-olive hover:bg-dark-olive absolute top-1 right-1 rounded-2xl px-7 py-4 font-bold duration-700 hover:text-white"
                        >
                            {{ __('footer.newsletter.subscribe_button') }}
                        </button>
                    </div>
                </div>
            </div>

            <hr class="border-dark mt-3 mb-3 border xl:mb-0 xl:hidden" />
        </div>

        <hr class="border-dark border xl:mt-7" />
        <div class="mt-5 flex items-center justify-between text-xs text-white">
            <div class="flex w-3/12 items-center py-1 xl:w-auto">
                <p class="flex gap-2 opacity-35">
                    &copy; 2025 KIDD.
                    <span class="hidden xl:block">{{ __('footer.bottom_line.copyright') }}</span>
                </p>
            </div>

            <ul class="flex w-9/12 justify-end gap-x-4 py-1 xl:w-auto">
                <li class="opacity-35">
                    <a href="{{ route('terms.privacy') }}">
                        {{ __('footer.bottom_line.privacy') }}
                    </a>
                </li>
                <li class="opacity-35">
                    <a href="{{ route('terms.cookies') }}">
                        {{ __('footer.bottom_line.cookies') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</footer>

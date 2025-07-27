<footer class="bg-charcoal mt-7 xl:mt-0 pt-5 pb-28 lg:pb-5" x-data="{
    open: null,
    toggle(idx) {
        this.open = this.open === idx ? null : idx;
    }
}">
    <div class="container">
        <div class="grid grid-cols-1 xl:flex xl:justify-between space-y-2">
            <!-- Follow Us -->
            <div class="order-last xl:order-first flex justify-between xl:justify-start xl:flex-col items-center xl:items-start gap-2 bg-charcoal py-2 text-white">
                <div class="flex items-center justify-between">
                    <h5 class="text-white opacity-60 font-bold text-lg">{{ __('footer.social.follow_us') }}</h5>
                </div>
                <ul class="flex group items-center gap-4 xl:mt-7">
                    <li>
                        <a href="#">
                            <img src="{{ Vite::image('icons/socials/facebook.svg') }}" alt="facebook icon">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ Vite::image('icons/socials/ln.svg') }}" alt="linkedin icon">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ Vite::image('icons/socials/youtube_i.svg') }}" alt="youtube icon">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ Vite::image('icons/socials/messenger.svg') }}" alt="messenger icon">
                        </a>
                    </li>
                </ul>
            </div>

            @include('layouts.nav.footer-menu')

            <!-- Subscribe -->
            <div class="flex flex-col gap-2 rounded-lg bg-charcoal xl:min-w-4/12 py-2 text-white">
                <div class="flex items-center justify-between">
                    <h5 class="text-white opacity-60 font-bold text-lg">{{ __('footer.newsletter.title') }}</h5>
                </div>
                <div class="h-auto xl:max-h-screen items-center transition-all">
                    <div class="w-full mt-2 relative">
                        <input class="bg-white/10 w-full placeholder-white/50 py-[19px] px-3 rounded-2xl border border-dark/50 focus:outline-none" type="text" name="email" placeholder="{{ __('footer.newsletter.email_placeholder') }}">
                        <button class="absolute top-1 right-1 bg-charcoal text-olive font-bold py-4 px-7 rounded-2xl hover:text-white hover:bg-dark-olive duration-700">{{ __('footer.newsletter.subscribe_button') }}</button>
                    </div>
                </div>
            </div>

            <hr class="mb-3 xl:mb-0 mt-3 xl:hidden border border-dark">
        </div>

        <hr class="xl:mt-7 border border-dark">
        <div class="mt-5 flex text-white justify-between items-center text-xs">
            <div class="flex items-center py-1 w-3/12 xl:w-auto">
                <p class="flex gap-2 opacity-35">&copy; 2025 KIDD. <span class="hidden xl:block">{{ __('footer.bottom_line.copyright') }}</span></p>
            </div>

            <ul class="flex justify-end gap-x-4 w-9/12 py-1 xl:w-auto">
                <li class="opacity-35"><a href="#">{{ __('footer.bottom_line.privacy') }}</a></li>
                <li class="opacity-35"><a href="#">{{ __('footer.bottom_line.cookies') }}</a></li>
            </ul>
        </div>
    </div>
</footer>

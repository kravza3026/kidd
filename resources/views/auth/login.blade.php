<x-app-layout>
    <div class="container">
        <div class="py-section grid grid-cols-1 gap-x-10 lg:grid-cols-2">
            <div class="mx-auto mt-4 w-lg max-w-xl rounded-lg bg-white p-6 shadow-md">
                <h1 class="text-[30px] font-bold md:text-[32px]">
                    {{ __('auth.login.form.title') }}
                </h1>
                <form method="POST" action="{{ LaravelLocalization::localizeURL('/login') }}">
                    @csrf
                    <div class="mt-4">
                        <x-ui.input-label
                            for="email"
                            type="email"
                            placeholder="{{ __('auth.login.form.email_placeholder') }}"
                            name="email"
                            :label="__('auth.login.form.email')"
                            required
                            autofocus
                            autocomplete="email"
                        />
                    </div>

                    <!-- Email Address -->

                    <!-- Password -->
                    <div class="mt-4">
                        <x-ui.input-label
                            id="password"
                            for="password"
                            type="password"
                            name="password"
                            :label="__('auth.login.form.password')"
                            placeholder="{{ __('auth.login.form.password_placeholder') }}"
                            required
                            autofocus
                            autocomplete="new-password"
                        />
                    </div>

                    @if (Route::has('password.request'))
                        <div class="mt-4">
                            <a class="text-olive font-bold underline" href="{{ route('password.request') }}">
                                {{ __('auth.login.form.forgot_password') }}
                            </a>
                        </div>
                    @endif

                    <div class="mt-4">
                        <x-primary-button class="ms-3 w-full" :class="'!w-full'">
                            {{ __('auth.login.form.login_btn') }}
                        </x-primary-button>
                    </div>
                </form>
                <div class="mt-4 flex justify-center gap-x-2 text-center opacity-60">
                    <p>
                        {{ __('auth.login.form.no_account') }}
                    </p>
                    <a class="font-bold underline focus:outline-none" href="{{ route('register') }}">
                        {{ __('auth.login.form.register_btn') }}
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div
                    style="background-image: url('{{ Vite::image('contactUs_bg.jpg') }}')"
                    class="relative flex h-full min-h-[400px] items-end rounded-2xl bg-cover bg-center bg-no-repeat md:min-h-[500px]"
                >
                    <div
                        class="from-charcoal/70 to-charcoal/50 absolute inset-0 z-0 rounded-2xl bg-gradient-to-t"
                    ></div>
                    <div
                        class="relative z-10 grid w-full grid-cols-3 justify-center py-10 text-white select-none md:px-3 lg:gap-4 lg:px-4 xl:gap-6 xl:px-6"
                    >
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_like.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.cart_and_favorites') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_child.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.family') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_present.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.offers_and_discounts') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_car.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.order_tracking') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_mark.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.easy_checkout') }}
                            </p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="bg-light-orange flex w-fit items-center justify-center gap-2 rounded-full p-3">
                                <img src="{{ Vite::image('icons/gradients/g_return.png') }}" alt="" />
                            </div>
                            <p class="w-full text-center leading-[130%] lg:w-4/5">
                                {{ __('auth.register.banner.easy_returns_or_exchanges') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

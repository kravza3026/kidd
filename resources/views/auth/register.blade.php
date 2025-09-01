<x-app-layout>
    <div class="container">
        <div class="py-section grid grid-cols-1 gap-x-10 lg:grid-cols-2">
            <div>
                <h1 class="text-[30px] font-bold md:text-[32px]">
                    {{ __('auth.register.form.title') }}
                </h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid grid-cols-2 justify-between gap-x-2">
                        <div class="mt-4">
                            <x-ui.input-label
                                for="first_name"
                                placeholder="{{ __('auth.register.form.first_name_placeholder') }}"
                                name="first_name"
                                :label="__('auth.register.form.first_name')"
                                :value="old('first_name')"
                                required
                                autofocus
                                autocomplete="first_name"
                            />
                        </div>

                        <div class="mt-4">
                            <x-ui.input-label
                                for="last_name"
                                placeholder="{{ __('auth.register.form.last_name_placeholder') }}"
                                name="last_name"
                                :label="__('auth.register.form.last_name')"
                                required
                                autocomplete="last_name"
                            />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-ui.input-label
                            for="email"
                            :type="'email'"
                            placeholder="{{ __('auth.register.form.email_placeholder') }}"
                            name="email"
                            :label="__('auth.register.form.email')"
                            required
                            autocomplete="email"
                        />
                    </div>

                    <div class="mt-4">
                        <x-ui.input-label
                            id="phone"
                            for="phone"
                            type="text"
                            name="phone"
                            placeholder="{{ __('auth.register.form.phone_placeholder') }}"
                            :label="__('auth.register.form.phone')"
                            :value="old('phone', '+373 ')"
                            required
                            autocomplete="phone"
                        />
                    </div>

                    <div class="grid grid-cols-2 justify-between gap-x-2">
                        <div class="mt-4">
                            <x-ui.input-label
                                id="password"
                                for="password"
                                type="password"
                                placeholder="{{ __('auth.register.form.password_placeholder') }}"
                                name="password"
                                :label="__('auth.register.form.password')"
                                :value="old('password')"
                                required
                                autocomplete="password"
                                autocomplete="new-password"
                            />
                        </div>
                        <div class="mt-4">
                            <x-ui.input-label
                                id="password_confirmation"
                                for="password_confirmation"
                                type="password"
                                placeholder="{{ __('auth.register.form.password_confirmation_placeholder') }}"
                                name="password_confirmation"
                                :label="__('auth.register.form.password_confirmation')"
                                :value="old('password')"
                                required
                                autocomplete="password_confirmation"
                            />
                        </div>
                    </div>
                    <div class="my-6 flex gap-x-4">
                        <x-ui.checkbox id="TermsAndConditions" name="consent" required></x-ui.checkbox>
                        <x-input-label class="flex items-center gap-x-1 !leading-5" for="TermsAndConditions">
                            {!! __('auth.register.form.consent', ['terms_url' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.terms'), 'privacy_url' => LaravelLocalization::getURLFromRouteNameTranslated(App::currentLocale(), 'routes.topline.terms')]) !!}
                        </x-input-label>
                    </div>

                    <x-primary-button :class="'!w-full'">
                        {{ __('auth.register.form.register_btn') }}
                    </x-primary-button>
                </form>
                <div class="mt-4 flex justify-center gap-x-2 text-center opacity-60">
                    <p>{{ __('auth.register.form.already_registered') }}</p>
                    <button id="loginBtn" class="cursor-pointer font-bold underline">
                        {{ __('auth.register.form.sign_in_btn') }}
                    </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loginBtn').addEventListener('click', function (e) {
                Swal.fire({
                    html: @json(view('auth.login-modal')->render()),
                    showConfirmButton: false,
                    showCloseButton: false,
                    customClass: {
                        popup: 'my-swal-rounded',
                    },
                    didOpen: () => {
                        const closeButtons = document.querySelectorAll('.closeSignIn');
                        closeButtons.forEach((btn) => {
                            btn.addEventListener('click', () => {
                                Swal.close();
                            });
                        });
                    },
                });
            });
        });
    </script>
    <style>
        .my-swal-rounded {
            border-radius: 10px;
            text-align: start;
            padding: 15px !important;

            .swal2-html-container {
                text-align: start;
            }

            .swal2-close:hover {
                color: var(--color-olive);
            }
        }
    </style>
</x-app-layout>

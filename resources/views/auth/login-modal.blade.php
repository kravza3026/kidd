<div class="flex items-center justify-center">
    <div class="mx-auto w-lg max-w-xl">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold md:text-[32px]">
                {{ __('auth.login.form.title') }}
            </h1>
            <button class="closeSignIn cursor-pointer text-5xl leading-none opacity-65 duration-300 hover:opacity-100">
                <img src="{{ Vite::image('icons/close_dark.svg') }}" alt="" />
            </button>
        </div>
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

            <!-- Password -->
            <div class="mt-4">
                <x-ui.input-label
                    id="password"
                    for="password"
                    type="password"
                    placeholder="{{ __('auth.login.form.password_placeholder') }}"
                    name="password"
                    :label="__('auth.login.form.password')"
                    :value="old('phone')"
                    required
                    autofocus
                    autocomplete="new-password"
                />
            </div>

            <!-- Remember -->
            <div class="mt-4 flex items-center gap-x-2">
                <x-ui.checkbox class="!size-4" id="remember" name="remember" value="true"></x-ui.checkbox>
                <x-input-label class="!text-dark flex items-center gap-x-1 !leading-5" for="remember">
                    {!! __('auth.login.form.remember') !!}
                </x-input-label>
            </div>

            @if (Route::has('password.request'))
                <div class="mt-4">
                    <a class="text-olive text-base font-bold underline" href="{{ route('password.request') }}">
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
        <div class="mt-4 flex justify-center gap-x-2 text-center text-sm opacity-60">
            <p>{{ __('auth.login.form.no_account') }}</p>
            <button class="closeSignIn cursor-pointer font-bold underline focus:outline-none">
                {{ __('auth.login.form.register_btn') }}
            </button>
        </div>
    </div>
</div>

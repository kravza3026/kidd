<section class="border-dark-snow rounded-xl border p-4 sm:border-0 sm:p-0">
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            {{ __('account.profile.general.title') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form id="send-verification-code" method="post" action="{{ route('phone.verification.send') }}">
        @csrf
    </form>

    <form name="profile" method="post" action="{{ route('profile.update') }}" class="sm:space-y-8">
        <input type="hidden" name="section" value="profile" />
        @method('put')
        @csrf

        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
            <div class="w-full">
                <x-ui.input-label
                    id="first_name"
                    autocomplete="given-name"
                    :value="old('first_name', $user->first_name)"
                    name="first_name"
                    :label="__('account.profile.general.form.first_name')"
                />

                <x-input-error class="mt-2" :messages="$errors->profile->get('first_name')" />
            </div>

            <div class="w-full">
                <x-ui.input-label
                    id="last_name"
                    :value="old('last_name', $user->last_name)"
                    name="last_name"
                    :label="__('account.profile.general.form.last_name')"
                />

                <x-input-error class="mt-2" :messages="$errors->profile->get('last_name')" />
            </div>
        </div>

        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
            <div class="mt-6 w-full sm:mt-0">
                <x-ui.input-label
                    id="email"
                    autocomplete="email"
                    :value="old('email', $user->email)"
                    type="email"
                    name="email"
                    :label="__('account.profile.general.form.email')"
                />

                <x-input-error class="mt-2" :messages="$errors->profile->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-gray-800">
                            {{ __('account.profile.general.form.email_unverified') }}

                            <button
                                form="send-verification"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                            >
                                {{ __('account.profile.general.form.email_resend') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
            <div class="w-full">
                <x-ui.input-label
                    id="phone"
                    id="phone"
                    autocomplete="phone"
                    placeholder="+373 60 123 456"
                    :value="old('phone', $user->phone)"
                    type="text"
                    name="phone"
                    :label="__('account.profile.general.form.phone')"
                />

                <x-input-error class="mt-2" :messages="$errors->profile->get('phone')" />
                @if ($user instanceof App\MustVerifyPhone && ! $user->hasVerifiedPhone())
                    <div>
                        <p class="mt-2 text-sm text-gray-800">
                            {{ __('account.profile.general.form.phone_unverified') }}

                            <button
                                form="send-verification-code"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-none"
                            >
                                {{ __('account.profile.general.form.phone_resend') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col items-start justify-between gap-6 sm:flex-row">
            <div class="mt-6 w-full sm:mt-0">
                <x-ui.input-label
                    id="password"
                    type="password"
                    name="password"
                    :label="__('account.profile.general.form.password')"
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->profile->get('password')" class="mt-2" />
            </div>

            <div class="w-full">
                <x-ui.input-label
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    :label="__('account.profile.general.form.password_confirmation')"
                    autocomplete="new-password"
                />
                <x-input-error :messages="$errors->profile->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center">
            <x-primary-button class="mt-6 sm:mt-0">{{ __('account.profile.general.btn_save') }}</x-primary-button>
        </div>
    </form>
</section>

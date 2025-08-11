<section class="rounded-xl border border-dark-snow sm:border-0 p-4 sm:p-0">
    <header>
        <h2 class="text-xl font-bold text-gray-900">
            {{ __('General Information') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form id="send-verification-code" method="post" action="{{ route('phone.verification.send') }}">
        @csrf
    </form>

    <form name="profile" method="post" action="{{ route('profile.update') }}" class="sm:space-y-8">
        <input type="hidden" name="section" value="profile"/>
        @method('put')
        @csrf

        <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
            <div class="w-full">
                <x-ui.input-label id="first_name" autocomplete="given-name" :value="old('first_name', $user->first_name)" name="first_name" :label="__('First name')"/>

                <x-input-error class="mt-2" :messages="$errors->profile->get('first_name')"/>
            </div>

            <div class="w-full">
                <x-ui.input-label id="last_name" :value="old('last_name', $user->last_name)" name="last_name" :label="__('Last name')"/>

                <x-input-error class="mt-2" :messages="$errors->profile->get('last_name')"/>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
            <div class="w-full mt-6 sm:mt-0">
                <x-ui.input-label id="email" autocomplete="email" :value="old('email', $user->email)" type="email" name="email" :label="__('E-mail address')"/>

                <x-input-error class="mt-2" :messages="$errors->profile->get('email')"/>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
            <div class="w-full">
                <x-ui.input-label id="phone" id="phone" autocomplete="phone" placeholder="+373 60 123 456" :value="old('phone', $user->phone)" type="text" name="phone" :label="__('Phone number')"/>

                <x-input-error class="mt-2" :messages="$errors->profile->get('phone')"/>
                @if ($user instanceof App\MustVerifyPhone && ! $user->hasVerifiedPhone())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your phone number is unverified.') }}

                            <button form="send-verification-code"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification code.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
            <div class="w-full mt-6 sm:mt-0">
                <x-ui.input-label id="password"  type="password" name="password" :label="__('Password')" autocomplete="new-password"/>


                <x-input-error :messages="$errors->profile->get('password')" class="mt-2"/>
            </div>

            <div class="w-full">
                <x-ui.input-label id="password_confirmation"  type="password" name="password_confirmation" :label="__('Password confirmation')" autocomplete="new-password"/>
                <x-input-error :messages="$errors->profile->get('password_confirmation')" class="mt-2"/>
            </div>
        </div>

        <div class="flex items-center">
            <x-primary-button class="mt-6 sm:mt-0">{{ __('Save changes') }}</x-primary-button>
        </div>
    </form>
</section>

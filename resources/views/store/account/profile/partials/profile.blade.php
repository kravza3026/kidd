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

    <form name="profile" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
        @csrf
        @method('put')

        <div class="flex flex-col sm:flex-row items-start gap-4 justify-between">
            <div class="w-full">
                <x-input-label for="first_name" :value="__('First name')"/>
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                              :value="old('first_name', $user->first_name)" autocomplete="first_name"/>
                <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
            </div>

            <div class="w-full">
                <x-input-label for="last_name" :value="__('Last name')"/>
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                              :value="old('last_name', $user->last_name)" autocomplete="last_name"/>
                <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
            </div>
        </div>


        <div class="flex flex-col sm:flex-row items-start gap-4 justify-between">
            <div class="w-full">
                <x-input-label for="email" :value="__('E-mail address')"/>
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                              :value="old('email', $user->email)" required autocomplete="email"/>
                <x-input-error class="mt-2" :messages="$errors->get('email')"/>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="w-full">
                <x-input-label for="phone" :value="__('Phone number')"/>
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                              :value="old('phone', $user->phone)" required autocomplete="phone"/>
                <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                @if ($user instanceof App\MustVerifyPhone && ! $user->hasVerifiedPhone())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your phone number is unverified.') }}

                            <button form="send-verification-code"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification code.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-code-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification code has been sent to your phone number.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-start gap-4 justify-between">
            <div class="w-full">
                <x-input-label for="password" :value="__('Password')"/>
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <div class="w-full">
                <x-input-label for="password_confirmation" :value="__('Password confirmation')"/>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save changes') }}</x-primary-button>
        </div>
    </form>
</section>

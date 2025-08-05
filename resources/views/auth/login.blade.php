<x-app-layout>
    <div class=" flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl w-lg mx-auto mt-4 bg-white p-6 rounded-lg shadow-md">

            <form method="POST" action="{{ LaravelLocalization::localizeURL('/login') }}">
                @csrf

                <div class="mt-4">
                    <x-ui.input-label for="email" :type="'email'" :placeholder="'Enter yor e-mail'" name="email" :label="__('E-mail')" required autofocus autocomplete="email"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Email Address -->


                <!-- Password -->
                <div class="mt-4">
                    <x-ui.input-label :id="'password'" for="password" :type="'password'" :placeholder="'Enter account password'"  name="password" :label="__('Password')"  :value="old('phone')" required autofocus autocomplete="phone"  required autocomplete="new-password"/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                @if (Route::has('password.request'))
                    <div class="mt-4">
                        <a class="underline font-bold text-olive  " href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    </div>
                @endif



                <div class="mt-4">
                    <x-primary-button class="ms-3 w-full" :class="'!w-full'">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
            <div class="mt-4 opacity-60 text-center flex gap-x-2 justify-center">
                <p>New customer? </p>
                <a class="underline font-bold  focus:outline-none "
                   href="{{ route('register') }}">
                    {{ __('Register now') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

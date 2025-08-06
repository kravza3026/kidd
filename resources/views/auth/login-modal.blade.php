
<div class=" flex items-center justify-center ">
    <div class="max-w-xl w-lg mx-auto ">
        <div class="flex items-center justify-between">
            <h1 class="text-[30px] md:text-[32px] font-bold ">Sign in</h1>
            <button class="closeSignIn opacity-65 hover:opacity-100 duration-300 cursor-pointer text-[46px] leading-none">
                <img src="{{Vite::image('icons/close_dark.svg')}}" alt="">
            </button>
        </div>
        <form method="POST" action="{{ LaravelLocalization::localizeURL('/login') }}">
            @csrf

            <div class="mt-4">
                <x-ui.input-label for="email" :type="'email'" :placeholder="'Enter yor e-mail'" name="email" :label="__('E-mail')" required autofocus autocomplete="email"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>


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
        <div class="mt-4 text-[14px] opacity-60 text-center flex gap-x-2 justify-center">
            <p>New customer? </p>
            <button class="closeSignIn underline font-bold cursor-pointer focus:outline-none "
               >
                {{ __('Register now') }}
            </button>
        </div>
    </div>
</div>


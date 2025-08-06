<x-app-layout>
    <div class="container">
        <div class=" py-section grid grid-cols-1 lg:grid-cols-2 gap-x-10">
            <div class="max-w-xl w-lg mx-auto mt-4 bg-white p-6 rounded-lg shadow-md">
                <h1 class="text-[30px] md:text-[32px] font-bold">Login</h1>
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
            <div class="hidden lg:block">
                <div style="background-image:url('{{Vite::image('contactUs_bg.jpg')}}')" class="relative  bg-no-repeat bg-center bg-cover rounded-2xl flex items-end min-h-[400px] md:min-h-[500px] h-full">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/70 to-charcoal/50 z-0 rounded-2xl"></div>
                    <div class="p-10 w-full relative grid justify-center lg:gap-3 xl:gap-[24px] z-10 text-white grid-cols-3 select-none">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_like.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Save cart and favorites for later</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_child.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Manage personal and family data</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_present.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Get personalised offers & discounts</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_car.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Keep track of your orders on the go</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_mark.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Save shipping info for easy checkout</p>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex items-center justify-center gap-2 bg-light-orange w-fit p-3 rounded-full">
                                <img src="{{Vite::image('icons/gradients/g_return.png')}}" alt="">
                            </div>
                            <p class="text-center w-full lg:w-4/5 leading-[130%]">Get smooth return or exchange  </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

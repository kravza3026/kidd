<x-app-layout>

    <div class="container">
        <div class="py-section grid grid-cols-1 lg:grid-cols-2 gap-x-10">
            <div>
                <h1 class="text-[30px] md:text-[32px] font-bold">Create account</h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid grid-cols-2 justify-between gap-x-2">
                       <div class="mt-4">
                           <x-ui.input-label for="first_name" :placeholder="'Enter yor first name'" name="first_name" :label="__('First name')" :value="old('first_name')" required autofocus autocomplete="first_name"/>
                           <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                       </div>

                        <div class="mt-4">
                            <x-ui.input-label for="last_name" :placeholder="'Enter yor last name'" name="last_name" :label="__('Last name')" required autocomplete="last_name"/>
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-ui.input-label for="email" :type="'email'" :placeholder="'Enter yor e-mail'" name="email" :label="__('E-mail')" required autocomplete="email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-ui.input-label :id="'phone'" for="phone" :type="'text'"  name="phone" :label="__('Phone')"  :value="old('phone')" required autocomplete="phone"/>
                        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                    </div>

                    <div class="grid grid-cols-2 justify-between gap-x-2">
                        <div class="mt-4">
                            <x-ui.input-label :id="'password'" for="password" :type="'password'" :placeholder="'Enter account password'"  name="password" :label="__('Password')"  :value="old('password')" required autocomplete="password"  required autocomplete="new-password"/>
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>
                        <div class="mt-4">
                            <x-ui.input-label :id="'confirm-password'" for="confirm-password" :type="'password'" :placeholder="'Confirm account password'" name="password_confirmation" :label="__('Confirm
                            password')"  :value="old('password')" required autocomplete="confirm-password"/>
                            <x-input-error :messages="$errors->get('confirm-password')" class="mt-2"/>
                        </div>
                    </div>
                    <div class="my-6 flex gap-x-4">
                        <x-ui.checkbox :id="'TermsAndConditions'" required></x-ui.checkbox>
                        <p>By signing up, I agree to the <a class="font-bold underline" href="{{ LaravelLocalization::getURLFromRouteNameTranslated( App::currentLocale(), 'routes.topline.terms') }}">Terms and Conditions</a> and the <a class="font-bold underline" href="">Privacy Policy</a></p>
                    </div>

                    <x-primary-button :class="'!w-full'">
                        {{ __('Create account') }}
                    </x-primary-button>

                </form>
               <div class="mt-4 opacity-60 text-center flex gap-x-2 justify-center">
                   <p>Already a customer? </p>
                   <button id="loginBtn" class="underline font-bold  cursor-pointer "
                     >
                       {{ __('Sign in') }}
                   </button>
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



    <script>


        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('loginBtn').addEventListener('click', function (e) {
                Swal.fire({
                    html: @json(view('auth.login-modal')->render()),
                    showConfirmButton: false,
                    showCloseButton:false,
                    customClass: {
                        popup: 'my-swal-rounded'
                    },
                    didOpen: () => {
                        const closeButtons = document.querySelectorAll('.closeSignIn');
                        closeButtons.forEach(btn => {
                            btn.addEventListener('click', () => {
                                Swal.close();
                            });
                        });
                    }
                });
            })



        });
    </script>
    <style>
        .my-swal-rounded{
            border-radius: 10px;
            text-align: start;
            padding: 15px!important;

            .swal2-html-container{
                text-align: start;
            }

            .swal2-close:hover{
                color: var(--color-olive);
            }
        }
    </style>
</x-app-layout>

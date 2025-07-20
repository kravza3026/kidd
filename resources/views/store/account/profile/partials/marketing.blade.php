<section class="rounded-xl border border-dark-snow sm:border-0 p-4 mb-8 sm:p-0">
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Marketing preferences') }}
        </h2>
    </header>

    <form name="marketing" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="flex justify-between">
            <div class="w-full">

                <div class="flex-col gap-6 flex">
                    <div class="justify-between items-center gap-4 inline-flex">
                        <div class="grow shrink basis-0 text-[#020202] text-sm font-normal leading-none">News & offers newsletter by e-mail</div>
                        <!-- Switch/Toggle -->
                        <div class="relative inline-block">
                            <input type="checkbox" checked name="marketing[newsletter]" value="1" id="newsletter-toggle"
                                   class="peer relative w-[3.25rem] h-7 p-px bg-gray-100 border border-gray-200 text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-dark-olive disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-olive checked:border-dark-olive focus:checked:border-dark-olive before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                            <label for="newsletter-toggle" class="sr-only">
                                News & offers newsletter by e-mail
                            </label>
                            <span class="peer-checked:text-olive text-olive size-6 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </span>
                            <span class="peer-checked:text-olive text-transparent size-6 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </span>
                        </div>
                        <!-- End Switch/Toggle -->
                    </div>
                    <div class="justify-between items-center gap-4 inline-flex">
                        <div class="grow shrink basis-0 text-[#020202] text-sm font-normal  leading-none">New order details to e-mail</div>
                        <!-- Switch/Toggle -->
                        <div class="relative inline-block">
                            <input type="checkbox" name="marketing[new_order_to_email]" value="1" id="order-to-email-toggle"
                                   class="peer relative w-[3.25rem] h-7 p-px bg-gray-100 border border-gray-200 text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-dark-olive disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-olive checked:border-dark-olive focus:checked:border-dark-olive before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                            <label for="order-to-email-toggle" class="sr-only">
                                New order details to e-mail
                            </label>
                            <span class="peer-checked:text-olive text-olive size-6 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </span>
                            <span class="peer-checked:text-olive text-transparent size-6 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </span>
                        </div>
                        <!-- End Switch/Toggle -->
                    </div>
                    <div class="justify-between items-center gap-4 inline-flex">
                        <div class="grow shrink basis-0 text-[#020202] text-sm font-normal  leading-none">Order status updates by SMS</div>
                        <!-- Switch/Toggle -->
                        <div class="relative inline-block">
                            <input type="checkbox" checked name="marketing[order_status_sms]" value="1" id="order-status-sms-toggle"
                                   class="peer relative w-[3.25rem] h-7 p-px bg-gray-100 border border-gray-200 text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-dark-olive disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-olive checked:border-dark-olive focus:checked:border-dark-olive before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                            <label for="order-status-sms-toggle" class="sr-only">
                                Order status updates by SMS
                            </label>
                            <span class="peer-checked:text-olive text-olive size-6 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </span>
                            <span class="peer-checked:text-olive text-transparent size-6 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </span>
                        </div>
                        <!-- End Switch/Toggle -->
                    </div>
                    <div class="justify-between items-center gap-4 inline-flex">
                        <div class="grow shrink basis-0 text-[#020202] text-sm font-normal  leading-none">Order status by e-mail</div>
                        <!-- Switch/Toggle -->
                        <div class="relative inline-block">
                            <input type="checkbox" name="marketing[order_status_email]" value="1" id="order-status-email-toggle"
                                   class="peer relative w-[3.25rem] h-7 p-px bg-gray-100 border border-gray-200 text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-dark-olive disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-olive checked:border-dark-olive focus:checked:border-dark-olive before:inline-block before:size-6 before:bg-white checked:before:bg-white before:translate-x-0 checked:before:translate-x-full before:rounded-full before:transform before:ring-0 before:transition before:ease-in-out before:duration-200">
                            <label for="order-status-email-toggle" class="sr-only">
                                Order status by e-mail
                            </label>
                            <span class="peer-checked:text-olive text-olive size-6 absolute top-0.5 start-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </span>
                            <span class="peer-checked:text-olive text-transparent size-6 absolute top-0.5 end-0.5 flex justify-center items-center pointer-events-none transition-colors ease-in-out duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                </svg>
                            </span>
                        </div>
                        <!-- End Switch/Toggle -->
                    </div>
                </div>

                <div class="flex items-center mt-4">
                    <x-primary-button>{{ __('Save changes') }}</x-primary-button>
                </div>

            </div>
        </div>
    </form>
</section>

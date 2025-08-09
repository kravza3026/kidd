<section class="rounded-xl border border-dark-snow sm:border-0 p-4 sm:p-0">
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Marketing preferences') }}
        </h2>
    </header>

    <form name="marketing" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        <input type="hidden" name="section" value="marketing"/>
        @csrf
        @method('put')

        <div class="flex justify-between">
            <div class="w-full">
                <div class="flex-col gap-6 flex">

                    <div class="w-full flex justify-between items-center">
                        <label for="newsletter-toggle" class="text-sm font-medium text-gray-900">
                            News & offers newsletter by e-mail
                        </label>
                        <div class="relative inline-block w-11 h-5">
                            <input @checked($user->newsletter) name="newsletter" value="1" id="newsletter-toggle" type="checkbox" class="peer appearance-none w-[48px] h-[28px] bg-slate-100 rounded-full
                            checked:bg-olive cursor-pointer
                             transition-colors
                            duration-300" />
                            <label for="newsletter-toggle" class="absolute checkboxLabelCircle top-1 left-1 w-5 h-5 bg-white rounded-full  shadow-sm transition-transform duration-300 peer-checked:translate-x-5
                            peer-checked:border-dark-olive cursor-pointer flex items-center justify-center">

                            </label>
                        </div>
                    </div>

                    <div class="w-full flex justify-between items-center">
                        <label for="new-order-to-email-toggle" class="text-sm font-medium text-gray-900">
                            New order details to e-mail
                        </label>
                        <div class="relative inline-block w-11 h-5">
                            <input @disabled(!$user->hasVerifiedEmail()) @checked($user->new_order_to_email && $user->hasVerifiedEmail()) name="new_order_to_email" value="1" id="new-order-to-email-toggle"
                                   type="checkbox"
                                   class="peer appearance-none w-[48px] h-[28px] bg-slate-100 rounded-full checked:bg-olive cursor-pointer transition-colors duration-300" />
                            <label for="new-order-to-email-toggle" class="absolute checkboxLabelCircle top-1 left-1 w-5 h-5 bg-white rounded-full  shadow-sm transition-transform duration-300 peer-checked:translate-x-5
                            peer-checked:border-dark-olive cursor-pointer flex items-center justify-center">
                            </label>
                        </div>
                    </div>

                    <div class="w-full flex justify-between items-center">
                        <label for="new-order-to-sms-toggle" class="text-sm font-medium text-gray-900">
                            New order details by SMS
                        </label>
                        <div class="relative inline-block w-11 h-5">
                            <input @disabled(!$user->hasVerifiedPhone()) @checked($user->new_order_to_sms && $user->hasVerifiedPhone()) name="new_order_to_sms" value="1" id="new-order-to-sms-toggle" type="checkbox"
                                   class="peer appearance-none w-[48px] h-[28px] bg-slate-100 rounded-full checked:bg-olive cursor-pointer transition-colors duration-300" />
                            <label for="new-order-to-sms-toggle" class="absolute checkboxLabelCircle top-1 left-1 w-5 h-5 bg-white rounded-full  shadow-sm transition-transform duration-300 peer-checked:translate-x-5
                            peer-checked:border-dark-olive cursor-pointer flex items-center justify-center">
                            </label>
                        </div>
                    </div>

                    <div class="w-full flex justify-between items-center">
                        <label for="order-status-email-toggle" class="text-sm font-medium text-gray-900">
                            Order status updates by e-mail
                        </label>
                        <div class="relative inline-block w-11 h-5">
                            <input @disabled(!$user->hasVerifiedEmail()) @checked($user->order_status_email && $user->hasVerifiedEmail()) name="order_status_email" value="1" id="order-status-email-toggle" type="checkbox"
                                   class="peer appearance-none w-[48px] h-[28px] bg-slate-100 rounded-full checked:bg-olive cursor-pointer transition-colors duration-300" />
                            <label for="order-status-email-toggle" class="absolute checkboxLabelCircle top-1 left-1 w-5 h-5 bg-white rounded-full  shadow-sm transition-transform duration-300 peer-checked:translate-x-5
                            peer-checked:border-dark-olive cursor-pointer flex items-center justify-center">
                            </label>
                        </div>
                    </div>

                    <div class="w-full flex justify-between items-center">
                        <label for="order-status-sms-toggle" class="text-sm font-medium text-gray-900">
                            Order status updates by SMS
                        </label>
                        <div class="relative inline-block w-11 h-5">
                            <input @disabled(!$user->hasVerifiedPhone()) @checked($user->order_status_sms && $user->hasVerifiedPhone()) name="order_status_sms" value="1" id="order-status-sms-toggle" type="checkbox"
                                   class="peer appearance-none w-[48px] h-[28px] bg-slate-100 rounded-full checked:bg-olive cursor-pointer transition-colors duration-300" />
                            <label for="order-status-sms-toggle" class="absolute checkboxLabelCircle top-1 left-1 w-5 h-5 bg-white rounded-full  shadow-sm transition-transform duration-300 peer-checked:translate-x-5
                            peer-checked:border-dark-olive cursor-pointer flex items-center justify-center">
                            </label>
                        </div>
                    </div>

                </div>

                <div class="flex items-center mt-4">
                    <x-primary-button type="submit">{{ __('Save changes') }}</x-primary-button>
                </div>

            </div>
        </div>
    </form>
</section>

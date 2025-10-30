<section class="border-dark-snow rounded-xl border p-4 sm:border-0 sm:p-0">
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('account.profile.marketing.title') }}
        </h2>
    </header>

    <form name="marketing" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        <input type="hidden" name="section" value="marketing" />
        @csrf
        @method('put')

        <div class="flex justify-between">
            <div class="w-full">
                <div class="flex flex-col gap-6">
                    <div class="flex w-full items-center justify-between">
                        <label for="newsletter-toggle" class="text-sm font-medium text-gray-900">
                            {{ __('account.profile.marketing.form.newsletter') }}
                        </label>
                        <div class="relative inline-block h-5 w-11">
                            <input
                                @checked($user->newsletter)
                                name="newsletter"
                                value="1"
                                id="newsletter-toggle"
                                type="checkbox"
                                class="peer checked:bg-olive h-[28px] w-[48px] cursor-pointer appearance-none rounded-full bg-slate-100 transition-colors duration-300"
                            />
                            <label
                                for="newsletter-toggle"
                                class="checkboxLabelCircle peer-checked:border-dark-olive absolute top-1 left-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-300 peer-checked:translate-x-5"
                            ></label>
                        </div>
                    </div>

                    <div class="flex w-full items-center justify-between">
                        <label for="new-order-to-email-toggle" class="text-sm font-medium text-gray-900">
                            {{ __('account.profile.marketing.form.email_new_order') }}
                        </label>
                        <div class="relative inline-block h-5 w-11">
                            <input
                                @disabled(! $user->hasVerifiedEmail())
                                @checked($user->new_order_to_email && $user->hasVerifiedEmail())
                                name="new_order_to_email"
                                value="1"
                                id="new-order-to-email-toggle"
                                type="checkbox"
                                class="peer checked:bg-olive h-[28px] w-[48px] cursor-pointer appearance-none rounded-full bg-slate-100 transition-colors duration-300"
                            />
                            <label
                                for="new-order-to-email-toggle"
                                class="checkboxLabelCircle peer-checked:border-dark-olive absolute top-1 left-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-300 peer-checked:translate-x-5"
                            ></label>
                        </div>
                    </div>

                    <div class="flex w-full items-center justify-between">
                        <label for="new-order-to-sms-toggle" class="text-sm font-medium text-gray-900">
                            {{ __('account.profile.marketing.form.sms_new_order') }}
                        </label>
                        <div class="relative inline-block h-5 w-11">
                            <input
                                @disabled(! $user->hasVerifiedPhone())
                                @checked($user->new_order_to_sms && $user->hasVerifiedPhone())
                                name="new_order_to_sms"
                                value="1"
                                id="new-order-to-sms-toggle"
                                type="checkbox"
                                class="peer checked:bg-olive h-[28px] w-[48px] cursor-pointer appearance-none rounded-full bg-slate-100 transition-colors duration-300"
                            />
                            <label
                                for="new-order-to-sms-toggle"
                                class="checkboxLabelCircle peer-checked:border-dark-olive absolute top-1 left-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-300 peer-checked:translate-x-5"
                            ></label>
                        </div>
                    </div>

                    <div class="flex w-full items-center justify-between">
                        <label for="order-status-email-toggle" class="text-sm font-medium text-gray-900">
                            {{ __('account.profile.marketing.form.email_order_updates') }}
                        </label>
                        <div class="relative inline-block h-5 w-11">
                            <input
                                @disabled(! $user->hasVerifiedEmail())
                                @checked($user->order_status_email && $user->hasVerifiedEmail())
                                name="order_status_email"
                                value="1"
                                id="order-status-email-toggle"
                                type="checkbox"
                                class="peer checked:bg-olive h-[28px] w-[48px] cursor-pointer appearance-none rounded-full bg-slate-100 transition-colors duration-300"
                            />
                            <label
                                for="order-status-email-toggle"
                                class="checkboxLabelCircle peer-checked:border-dark-olive absolute top-1 left-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-300 peer-checked:translate-x-5"
                            ></label>
                        </div>
                    </div>

                    <div class="flex w-full items-center justify-between">
                        <label for="order-status-sms-toggle" class="text-sm font-medium text-gray-900">
                            {{ __('account.profile.marketing.form.sms_order_updates') }}
                        </label>
                        <div class="relative inline-block h-5 w-11">
                            <input
                                @disabled(! $user->hasVerifiedPhone())
                                @checked($user->order_status_sms && $user->hasVerifiedPhone())
                                name="order_status_sms"
                                value="1"
                                id="order-status-sms-toggle"
                                type="checkbox"
                                class="peer checked:bg-olive h-[28px] w-[48px] cursor-pointer appearance-none rounded-full bg-slate-100 transition-colors duration-300"
                            />
                            <label
                                for="order-status-sms-toggle"
                                class="checkboxLabelCircle peer-checked:border-dark-olive absolute top-1 left-1 flex h-5 w-5 cursor-pointer items-center justify-center rounded-full bg-white shadow-sm transition-transform duration-300 peer-checked:translate-x-5"
                            ></label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex items-center">
                    <x-primary-button type="submit">
                        {{ __('account.profile.marketing.btn_save') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </form>
</section>

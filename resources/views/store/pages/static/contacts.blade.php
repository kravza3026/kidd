<x-app-layout>
    <div class="pageContent">
        <section class="container pt-section">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-10 pb-section">
                <div class="form">
                    <h1 class="text-[24px] lg:text-[32px] font-bold">
                        {{ __('contacts.page_title') }}
                    </h1>
                    <p class="opacity-60 leading-[175%] text-sm lg:text-base">
                        {{ __('contacts.page_subtitle') }}
                    </p>
                    <form method="POST" action="{{ route('contacts.store') }}" class="w-full">
                        @csrf
                        <x-ui.input-label
                            label="{{ __('contacts.form.first_name') }}"
                            type="text"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            id="first_name"
                            placeholder="{{ __('contacts.form.first_name_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>

                        <x-ui.input-label
                            label="{{ __('contacts.form.last_name') }}"
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            id="last_name"
                            placeholder="{{ __('contacts.form.last_name_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>

                        <x-ui.input-label
                            label="{{ __('contacts.form.phone') }}"
                            type="text"
                            name="phone"
                            value="{{ old('phone', '+373 ') }}"
                            id="phone"
                            placeholder="{{ __('contacts.form.phone_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2"/>

                        <x-ui.input-label
                            label="{{ __('contacts.form.email') }}"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            id="email"
                            placeholder="{{ __('contacts.form.email_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                        <x-ui.textarea
                            label="{{ __('contacts.form.message') }}"
                            id="message"
                            name="message"
                            value="{{ old('message') }}"
                            placeholder="{{ __('contacts.form.message_placeholder') }}"

                        />
                        <x-input-error :messages="$errors->get('message')" class="mt-2"/>

                        <div class="flex items-center justify-start gap-3 mt-5">
                            <x-ui.checkbox name="consent"></x-ui.checkbox>
                            <label for="consent" class="leading-[150%]">
                                {!! __('contacts.form.terms', ['url' => route('terms')]) !!}
{{--                                // TODO - change lint from terms to policy url.--}}
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('consent')" class="mt-2"/>

                        <x-ui.button as="button" type="submit" class="my-0">
                            {{ __('contacts.form.submit') }}
                        </x-ui.button>
                    </form>
                </div>
                <div style="background-image:url('{{Vite::image('contactUs_bg.jpg')}}')" class="relative mt-10 lg:mt-0 bg-no-repeat bg-center bg-cover rounded-2xl flex items-end min-h-[400px] md:min-h-[500px]">
                    <div class="absolute inset-0 bg-gradient-to-t from-charcoal/25 to-charcoal/5 z-0 rounded-2xl"></div>
                    <div class="p-5 relative grid gap-[24px] z-10 text-white">
{{--                        // TODO - add testimonials and translations.--}}
                        <p class="text-[20px] lg:text-[32px] text-white leading-[150%] lg:mb-10">“I'm so grateful to have discovered KIDD. The fabrics are soft and gentle, and the attention to details is outstanding.”</p>
                        <div>
                            <p class="font-bold lg:text-[20px]">Ana-Maria Parahonco</p>
                            <p class="text-[12px] lg:text-sm">Mother of little princess</p>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>
</x-app-layout>

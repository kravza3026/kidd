<x-app-layout>
    <div class="pageContent">
        <section class="pt-section container">
            <div class="pb-section grid grid-cols-1 gap-x-10 lg:grid-cols-2">
                <div class="form">
                    <h1 class="text-2xl font-bold lg:text-[32px]">
                        {{ __('contacts.page_title') }}
                    </h1>
                    <p class="text-sm leading-[175%] opacity-60 lg:text-base">
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

                        <x-ui.input-label
                            label="{{ __('contacts.form.last_name') }}"
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            id="last_name"
                            placeholder="{{ __('contacts.form.last_name_placeholder') }}"
                        />

                        <x-ui.input-label
                            label="{{ __('contacts.form.phone') }}"
                            type="text"
                            name="phone"
                            value="{{ old('phone', '+373 ') }}"
                            id="phone"
                            placeholder="{{ __('contacts.form.phone_placeholder') }}"
                        />

                        <x-ui.input-label
                            label="{{ __('contacts.form.email') }}"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            id="email"
                            placeholder="{{ __('contacts.form.email_placeholder') }}"
                        />

                        <x-ui.textarea
                            label="{{ __('contacts.form.message') }}"
                            id="message"
                            name="message"
                            value="{{ old('message') }}"
                            placeholder="{{ __('contacts.form.message_placeholder') }}"
                        />
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />

                        <div class="mt-5 flex items-center justify-start gap-3">
                            <x-ui.checkbox name="consent"></x-ui.checkbox>
                            <label for="consent" class="leading-[150%]">
                                {!! __('contacts.form.terms', ['url' => route('terms')]) !!}
                                {{-- // TODO - change link from terms to policy url. --}}
                            </label>
                        </div>

                        <x-ui.button as="button" type="submit" class="my-0">
                            {{ __('contacts.form.submit') }}
                        </x-ui.button>
                    </form>
                </div>
                <div
                    style="background-image: url('{{ Vite::image('contactUs_bg.jpg') }}')"
                    class="relative mt-10 flex min-h-[400px] items-end rounded-2xl bg-cover bg-center bg-no-repeat md:min-h-[500px] lg:mt-0"
                >
                    <div class="from-charcoal/25 to-charcoal/5 absolute inset-0 z-0 rounded-2xl bg-gradient-to-t"></div>
                    <div class="relative z-10 grid gap-6 p-5 text-white">
                        {{-- // TODO - add testimonials and translations. --}}
                        <p class="text-xl leading-[150%] text-white lg:mb-10 lg:text-[32px]">
                            “I'm so grateful to have discovered KIDD. The fabrics are soft and gentle, and the attention
                            to details is outstanding .”
                        </p>
                        <div>
                            <p class="font-bold lg:text-xl">Ana-Maria Parahonco</p>
                            <p class="text-xs lg:text-sm">Mother of little princess</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>

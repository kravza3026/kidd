<x-app-layout>
    <div class="pageContent">
        <section class="py-section container">
            <div class="relative max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
                <div class="size-10 absolute top-9 -left-14 rounded-full">
                    <a href="{{ route('vacancy.show', $vacancy) }}" class="">
                        <span class="size-full border border-[#eeeeee] rounded-full flex items-center justify-center">
                            <svg class="size-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.6654 13.3334L5.33203 8.00002L10.6654 2.66669" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.6654 13.3334L5.33203 8.00002L10.6654 2.66669" stroke="url(#paint0_linear_1083_12151)" stroke-opacity="0.8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <defs>
                                    <linearGradient id="paint0_linear_1083_12151" x1="10.6654" y1="2.66669" x2="4.22065" y2="3.38679" gradientUnits="userSpaceOnUse">
                                        <stop offset="0.23289" stop-color="#EAC2C3"/>
                                        <stop offset="1" stop-color="#97C5FE"/>
                                    </linearGradient>
                                </defs>
                            </svg>
                        </span>
                    </a>
                </div>
                <h2 class="font-bold text-xl lg:text-3xl leading-[-2%]">
                    {{ __('Apply to job') }}
                </h2>

                <form name="application" enctype="multipart/form-data" method="post" action="{{ route('vacancy.application.store', $vacancy) }}" class="mt-8 sm:space-y-4">
                    @csrf

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-select class="p-4"
                                :label="__('Job title')"
                                :disabled="false"
                                name="vacancy_id"
                                id="vacancy_{{ $vacancy->id }}"
                                :placeholder="__('general.placeholder.select.vacancy')"
                                :options="$vacancies"
                                :selected="old('vacancy_id', $vacancy->id)
                            ">
                            </x-select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-ui.input-label id="first_name" :value="old('first_name', '')" name="first_name" :placeholder="__('First name')" :label="__('First name')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
                        </div>

                        <div class="w-full">
                            <x-ui.input-label id="last_name" :value="old('last_name', '')" name="last_name" :placeholder="__('Last name')" :label="__('Last name')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full mt-6 sm:mt-0">
                            <x-ui.input-label id="email" autocomplete="email" :value="old('email', '')" type="email" name="email" :placeholder="__('E-mail address')" :label="__('E-mail address')"
                                              :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                        <div class="w-full">
                            <x-ui.input-label id="phone" autocomplete="phone" placeholder="+373 " :value="old('phone', '')" type="text" name="phone" :placeholder="__('+373 (__) ___ ___')" :label="__
                            ('Phone number')" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                        </div>
                    </div>

                    <div class="flex flex-col items-start gap-0 justify-between">
                        <div class="w-full">

                            <div class="flex flex-col gap-3 mt-3">
                                <label for="cv" class="text-[14px] font-medium">
                                    {{ __('Resume') }}
                                </label>
                                <input
                                    type="file"
                                    name="cv"
                                    id="cv"
                                    value="{{ old('cv') }}"
                                    class="text-dark px-3 py-14 border-light-border border-1 focus:outline-hidden rounded-xl"
                                />
                            </div>
                        </div>
                        <div class="w-full">
                            <x-ui.input-label id="cv_url" placeholder="{{ __('or upload from URL.') }}" :value="old('cv_url', '')" name="cv_url" :label-class="'font-medium'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('cv')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('cv_url')"/>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-primary-button class="!w-full !py-4 mt-6 sm:mt-0">{{ __('Apply now') }}</x-primary-button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</x-app-layout>

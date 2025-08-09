<x-app-layout>
    <div class="pageContent">
        <section class="py-section container">
            <div class="max-w-2xl mx-auto">
                <h2 class="font-bold text-[30px] lg:text-[24px] leading-[-2%]">
                    {{ __('Apply to job') }}
                </h2>

                <form name="application" method="post" action="{{ route('vacancy.application.store', $vacancy) }}" class="sm:space-y-8">
                    @csrf

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-select label="" :disabled="true" name="vacancy_id" id="vacancy_{{ $vacancy->id }}" :placeholder="false"
                            :options="$vacancies" :selected="old('vacancy_id', $vacancy->id)">
                            </x-select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full">
                            <x-ui.input-label id="first_name" :value="old('first_name', '')" name="first_name" :label="__('First name')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('first_name')"/>
                        </div>

                        <div class="w-full">
                            <x-ui.input-label id="last_name" :value="old('last_name', '')" name="last_name" :label="__('Last name')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('last_name')"/>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start gap-6 justify-between">
                        <div class="w-full mt-6 sm:mt-0">
                            <x-ui.input-label id="email" autocomplete="email" :value="old('email', '')" type="email" name="email" :label="__('E-mail address')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                        </div>
                        <div class="w-full">
                            <x-ui.input-label id="phone" autocomplete="phone" placeholder="+373 60 123 456" :value="old('phone', '')" type="text" name="phone" :label="__('Phone number')"/>
                            <x-input-error class="mt-2" :messages="$errors->get('phone')"/>
                        </div>
                    </div>


                    <div class="flex items-center">
                        <x-primary-button class="mt-6 sm:mt-0">{{ __('Apply') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>

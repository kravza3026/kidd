<section
    class="rounded-xl border border-light-border sm:border-dark-snow sm:border-0 lg:py-0 sm:p-0 {{ ($user->family->count() > 0) ? 'bg-white' : 'sm:bg-none border-[#eeeeee]/50 bg-gradient-to-r from-olive/15 via-olive/25 to-olive/15' }}">
    <header class="p-2 lg:p-0">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('My Family Filters') }}
        </h2>

        <p class="max-w-[70%] sm:max-w-none mt-1 text-sm text-balance text-gray-600">
            {!! __("Filter clothing by predefined profiles of your children")  !!}
        </p>
    </header>

    <div class="family_list mt-6 mb-8 flex flex-col flex-grow gap-y-4">
{{--        @foreach($user->family as $member)--}}
{{--            @include('store.account.profile.partials.family-row')--}}
{{--        @endforeach--}}
        <div data-vue-component="Family"></div>
    </div>

{{--    <div class="items-center gap-4 flex">--}}
{{--        <x-primary-button class="!w-auto py-5" type="button">--}}
{{--            {{ __('+ Add child') }}--}}
{{--        </x-primary-button>--}}
{{--    </div>--}}

</section>

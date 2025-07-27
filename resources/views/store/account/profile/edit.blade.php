<x-app-layout>
    <div class="bg-white sm:bg-transparent sm:pt-16 max-w-4xl mx-auto sm:px-4 lg:px-8 space-y-2 sm:space-y-6">

        @if(session('success'))
            @include('shared.alerts.success')
        @endif

        <div class="bg-white sm:rounded-lg">
            @include('store.account.nav')
            <div class="px-4 mt-4 sm:p-10">
                @include('store.account.profile.partials.profile')
            </div>
        </div>

        <div class="max-w-full px-4 sm:p-10 sm:rounded-lg {{ ($user->family->count() > 0) ? 'bg-white' : 'bg-white sm:bg-gradient-to-r sm:from-olive/15 sm:via-olive/25 sm:to-olive/15' }}">
            @include('store.account.profile.family')
        </div>

        <div class="max-w-full px-4 sm:p-10 bg-white sm:rounded-lg">
            @include('store.account.profile.partials.marketing')
        </div>

    </div>
</x-app-layout>

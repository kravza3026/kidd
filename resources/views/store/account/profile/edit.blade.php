<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white sm:bg-transparent sm:pt-16 sm:pb-20 space-y-4">
        <div class="bg-white sm:shadow sm:rounded-xl">
            @include('store.account.nav')
            <div class="px-4 sm:p-10">
                @include('store.account.profile.partials.profile')
            </div>
        </div>

        <div class="px-4 lg:!py-4 sm:p-10 sm:shadow sm:rounded-xl {{ ($user->family->count() > 0) ? 'bg-white' : 'shadow-inner bg-light-orange bg-radial-[at_50%_50%]  from-olive/10 via-olive/25 to-olive/10 to-95%' }}">
            @include('store.account.profile.partials.family')
        </div>

        <div class="px-4 sm:p-10 bg-white sm:shadow sm:rounded-xl">
            @include('store.account.profile.partials.marketing')
        </div>

    </div>
</x-app-layout>

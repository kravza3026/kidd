<x-app-layout>
    <div class="mx-auto max-w-5xl space-y-4 bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white sm:rounded-xl sm:shadow">
            @include('store.account.nav')
            <div class="px-4 sm:p-10">
                @include('store.account.profile.partials.profile')
            </div>
        </div>

        <div
            class="{{ ($user->family->count() > 0) ? 'bg-white' : 'bg-light-orange from-olive/10 via-olive/25 to-olive/10 bg-radial-[at_50%_50%] to-95% shadow-inner' }} px-4 sm:rounded-xl sm:p-10 sm:shadow lg:!py-4"
        >
            @include('store.account.profile.partials.family')
        </div>

        <div class="bg-white px-4 sm:rounded-xl sm:p-10 sm:shadow">
            @include('store.account.profile.partials.marketing')
        </div>
    </div>
</x-app-layout>

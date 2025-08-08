<x-app-layout>
    <div class="bg-white sm:bg-transparent sm:pt-8 max-w-5xl mx-auto sm:px-4 lg:px-8 space-y-2 sm:space-y-6">
        <div class="bg-white h-full sm:rounded-lg">
            @include('store.account.nav')
            <form class="flex items-center justify-center mb-72" method="POST" action="{{ route('logout') }}">
                @csrf
                <x-nav-link class="bg-transparent top-52 w-full flex items-center justify-center text-center text-charcoal/60 py-6" :href="route('logout')"
                            onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-nav-link>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class="pt-2 sm:pt-8 max-w-7xl mx-auto sm:px-4 lg:px-8 space-y-6">
        <div class="bg-white shadow sm:rounded-lg">

            @include('store.account.nav')

            <div class="p-6 md:px-10 mb-4">
                <!-- Product grid -->
                @forelse ([] as $product)
                    @include('store.catalog.products._product-card')
                @empty
                    <div class="flex flex-col justify-center items-center my-12 py-12">
                        <div class="flex justify-center items-center -mb-6">
                            <img src="{{ Vite::image('empty_favorites.jpg') }}" alt=""/>
                        </div>
                        <h3 class="flex justify-center items-center font-extrabold text-lg text-gray-900">
                            {{ __('You have no favorite products') }}
                        </h3>
                        <p class="flex justify-center items-center mt-1 mb-6 text-sm text-gray-500">
                            {{ __('Let\'s find something cute') }}
                        </p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center w-full py-2.5 sm:w-auto sm:px-6 sm:py-2 bg-green-500 border border-transparent rounded-xl font-semibold text-sm
                        text-white
                        hover:bg-green-600 focus:bg-green-550 active:bg-green-550 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 cursor-pointer transition ease-in-out duration-150">
                            Explore outfits
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                                 stroke="currentColor" class="size-4 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>
                            </svg>
                        </a>
                    </div>
                @endforelse
                {{--                            {{ $products->links() }}--}}
            </div>
        </div>
    </div>
</x-app-layout>

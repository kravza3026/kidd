<x-app-layout>
    <div class="mx-auto max-w-5xl bg-white sm:bg-transparent sm:pt-16 sm:pb-20">
        <div class="bg-white shadow-xl sm:rounded-xl">
            @include('store.account.nav')

            <div class="mb-4 p-6 md:px-10">
                @if ($products->count())
                    <!-- Product grid -->
                    {{-- // TODO - update this condition when we have a proper favorites system --}}
                    <div class="mb-12 space-y-20">
                        <div class="grid grid-cols-1 gap-3 gap-y-6 sm:grid-cols-2 md:grid-cols-3">
                            <!-- Product grid -->
                            @foreach ($products as $product)
                                <div data-vue-component="ProductCard" data-product="@json($product)"></div>
                            @endforeach
                        </div>
                        {{ $products->onEachSide(1)->links() }}
                    </div>
                @else
                    <div class="my-12 flex flex-col items-center justify-center py-12">
                        <div class="-mb-6 flex items-center justify-center">
                            <img src="{{ Vite::image('common/empty_favorites.jpg') }}" alt="order placeholder" />
                        </div>
                        <h3 class="flex items-center justify-center text-lg font-extrabold text-gray-900">
                            {{ __('favorites.empty.title') }}
                        </h3>
                        <p class="mt-1 mb-6 flex items-center justify-center text-sm text-gray-500">
                            {{ __('favorites.empty.description') }}
                        </p>
                        <a
                            href="{{ route('products.index') }}"
                            class="focus:bg-green-550 active:bg-green-550 inline-flex w-full cursor-pointer items-center justify-center rounded-xl border border-transparent bg-green-500 py-2.5 text-sm font-semibold text-white transition duration-150 ease-in-out hover:bg-green-600 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 focus:outline-none sm:w-auto sm:px-6 sm:py-2"
                        >
                            {{ __('favorites.empty.explore_button') }}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2.5"
                                stroke="currentColor"
                                class="ml-2 size-4"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"
                                />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

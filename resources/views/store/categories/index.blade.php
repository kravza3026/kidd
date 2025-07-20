<x-app-layout>
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white mx-auto max-w-2xl px-8 sm:py-8 lg:max-w-none lg:py-12 rounded-xl">
            <h2 class="text-2xl font-bold text-gray-900">Collections</h2>

            <div class="mt-6 gap-y-8 lg:grid lg:grid-cols-4 lg:gap-x-6 lg:space-y-0">
                @forelse($categories as $category)
                    <div class="group relative">
                        <div class="relative h-80 w-full overflow-hidden rounded-lg bg-white sm:aspect-h-1 sm:aspect-w-2 lg:aspect-h-1 lg:aspect-w-1 group-hover:opacity-75 sm:h-64">
                            <img preload src="{{ $category->image }}" alt="Desc with leather" class="h-full w-full object-cover object-center">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <a href="{{ route('categories.show', $category) }}">
                                <span class="absolute inset-0"></span>
                                {{ $category->parent->name }} /
                                {{ $category->name }}
                            </a>
                        </h3>
                        <p class="text-base font-semibold text-gray-900">
                            {{ $category->description }}
                        </p>
                    </div>
                @empty
                    <p class="w-full text-sm text-gray-900">
                        {{ __('Sorry, no categories found') }}
                    </p>
                @endforelse
            </div>

            {{ $categories->links() }}

        </div>
    </div>
</x-app-layout>

<x-app-layout >

    <div class="container">
        <nav aria-label="Breadcrumb">
            <ol role="list" class="mx-auto flex items-center space-x-2 py-4 sm:py-6 lg:py-8">
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="mr-2 text-sm font-medium text-gray-500">
                            {{ __('header.menu.catalog') }}
                        </a>
                        <span class="text-gray-300">\</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <a href="{{ route('products.category.index', $product->category) }}"
                           class="mr-2 text-sm font-medium text-gray-500">
                            {{ $product->category->name }}
                        </a>
                     <span class="text-gray-300">\</span>
                    </div>
                </li>

                <li class="text-sm">
                    <button aria-current="page"
                            class="font-medium text-gray-500 hover:text-gray-600">
                        {{ $product->name }}
                    </button>
                </li>
            </ol>
        </nav>
        <div class="w-full py-2 flex-col lg:flex-row justify-center items-start gap-12 inline-flex relative">
            @include('.store.pages.product.sections.imgSlider')
            @include('.store.pages.product.sections.mainSection')

        </div>


    </div>
    @include('.store.pages.product.sections.completeLook')
    @include('.store.pages.product.sections.subscribe')

    @include('.store.pages.product.sections.questions')
    @include('.store.pages.product.mobile.sections.questions')

    @include('.store.pages.product.sections.similar')
</x-app-layout>

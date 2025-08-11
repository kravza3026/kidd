@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between overflow-clip">
        <div class="flex-1 flex items-center justify-between">
            <div class="hidden xl:block">
                <p class="text-sm text-gray-700 leading-5">
                    {!! __('pagination.showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-black">{{ $paginator->firstItem() }}</span>
                        -
                        <span class=" font-bold text-black">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('pagination.of') !!}
                    <span class="font-bold text-black">{{ $paginator->total() }}</span>
                </p>
            </div>

            <div class="flex-1 flex justify-center">
                <span class="relative z-0 items-center inline-flex gap-1.5 md:gap-3">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative mr-1.5 md:mr-3 text-olive inline-flex items-center gap-1 px-2.5 py-2.5 md:pr-5 md:px-4 md:py-3 font-bold text-sm leading-[16px]  bg-secondary border
                                border-secondary-dark
                                rounded-full
                           hover:text-olive focus:z-10
                           focus:outline-none focus:ring ring-gray-300 focus:border-secondary-dark active:bg-secondary-dark active:text-dark-olive transition ease-in-out duration-150"
                                  aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="hidden md:inline">{{ __('pagination.previous') }}</span>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                           class="relative mr-1.5 md:mr-3 text-olive inline-flex items-center gap-1 px-2.5 py-2.5 md:pr-5 md:px-4 md:py-3 font-bold text-sm leading-[16px]  bg-secondary border border-secondary-dark rounded-full
                           hover:text-olive focus:z-10
                           focus:outline-none focus:ring ring-gray-300 focus:border-secondary-dark active:bg-secondary-dark active:text-dark-olive transition ease-in-out duration-150"
                           aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="hidden md:inline">{{ __('pagination.previous') }}</span>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-4 text-sm font-bold text-black bg-white cursor-default leading-3">
                                    {{ $element }}
                                </span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center px-4 py-3 text-sm font-bold text-white bg-olive rounded-full border border-secondary-dark cursor-default leading-3">{{ $page
                                            }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                       class="relative inline-flex items-center px-3 py-3 text-sm font-bold text-black rounded-full border border-transparent leading-3 hover:text-olive focus:z-10 transition ease-in-out duration-150"
                                       aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                           class="relative ml-1.5 md:ml-3 text-olive inline-flex items-center gap-1 px-2.5 py-2.5 md:pl-5 md:px-4 md:py-3 font-bold text-sm leading-[16px]  bg-secondary border
                           border-secondary-dark rounded-full hover:text-olive focus:z-10 active:bg-secondary-dark active:text-dark-olive transition ease-in-out duration-150"
                           aria-label="{{ __('pagination.next') }}">
                            <span class="hidden md:inline">{{ __('pagination.next') }}</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative ml-1.5 md:ml-3 text-olive inline-flex items-center gap-1 px-2.5 py-2.5 md:pl-5 md:px-4 md:py-3 font-bold text-sm leading-[16px]  bg-secondary border
                                border-secondary-dark rounded-full hover:text-olive focus:z-10 active:bg-secondary-dark active:text-dark-olive transition ease-in-out duration-150"
                                aria-hidden="true">
                                <span class="hidden md:inline">{{ __('pagination.next') }}</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
            <div class="hidden lg:inline-flex items-center gap-2 lg:gap-3">
                <span class="hidden lg:inline text-charcoal/45 text-sm leading-[14px] font-normal">
                    {!! __('pagination.products_per_page') !!}
                </span>
                <div>
                    <!-- Select -->
                    <select form="filtersForm" name="per_page" onchange="filtersForm.submit()"
                            class="py-1 px-3 pe-12 block w-full text-black/80 border-gray-300/30 shadow rounded-lg text-sm">
                        <option value="16" @selected(request('per_page', 16) == 16)>16</option>
                        <option value="32" @selected(request('per_page', 16) == 32)>32</option>
                        <option value="48" @selected(request('per_page', 16) == 48)>48</option>
                    </select>
                    <!-- End Select -->
                </div>
            </div>
        </div>
    </nav>
@endif

@php
    $size = ! request()->has('filters.size.0') && array_key_exists('size', request()->get('filters', [])) && count(request('filters')['size']);
    $fabric = ! request()->has('filters.fabric.0') && array_key_exists('fabric', request()->get('filters', [])) && count(request('filters')['fabric']);
    $color = ! request()->has('filters.color.0') && array_key_exists('color', request()->get('filters', [])) && count(request('filters')['color']);
    $gender = ! request()->has('filters.gender.0') && array_key_exists('gender', request()->get('filters', [])) && count(request('filters')['gender']);
    $season = ! request()->has('filters.season.0') && array_key_exists('season', request()->get('filters', [])) && count(request('filters')['season']);
    $price = (request()->has('filters.price.from') && request()->get('filters')['price']['from']) || (request()->has('filters.price.to') && request()->get('filters')['price']['to']) || request()->has('filters.price.discounted');
    $family = ! request()->has('filters.family.0') && array_key_exists('family', request()->get('filters', [])) && count(request('filters')['family']);
    $showClearButton = request()->has('filters') && ($size || $fabric || $color || $gender || $season || $price || $family);
@endphp

<form
    class="flex h-full w-full"
    action="{!! url()->current() !!}"
    accept-charset="utf-8"
    name="filtersForm"
    id="filtersForm"
>
    @if (! is_null(request('term')))
        <input type="hidden" name="term" value="{!! request('term') !!}" />
    @endif

    <div class="mt-8 hidden w-full items-center justify-between bg-white sm:flex">
        <div class="flex items-center justify-start gap-5">
            <div class="inline-flex items-center justify-start gap-1 opacity-40">
                <div class="relative h-3.5 w-3.5">
                    <img src="{{ Vite::image('common/filter.svg') }}" alt="filter icon" />
                </div>
                <div class="text-sm leading-none font-medium text-black">
                    {{ __('filters.filter_by') }}
                </div>
            </div>
            <div class="flex items-start justify-start gap-2">
                <x-filters.sizes-dropdown />
                <x-filters.fabrics-dropdown />
                <x-filters.colors-dropdown />
                <x-filters.genders-dropdown />
                <x-filters.seasons-dropdown />
                <x-filters.price-dropdown />
                @auth
                    <x-filters.family-dropdown />
                @endauth

                @if ($showClearButton)
                    <div class="flex items-center justify-center gap-2 rounded-full px-3 py-2">
                        <a
                            href="{{ url()->current() }}"
                            class="filter-clear text-olive flex cursor-pointer items-center justify-start gap-1 text-sm leading-[14px] font-bold underline underline-offset-2"
                        >
                            <svg
                                class="text-olive size-4 flex-shrink-0 group-hover:rotate-180"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="3"
                                stroke="currentColor"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                            {{ __('filters.clear') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="inline-flex items-center gap-2">
            <div class="flex items-center justify-start gap-1 opacity-40">
                <div class="relative h-3.5 w-3.5">
                    <img src="{{ Vite::image('common/sort.svg') }}" alt="sort icon" />
                </div>
                <div class="text-sm leading-none font-medium text-black">
                    {{ __('filters.sort_by') }}
                </div>
            </div>
            <div class="text-sm leading-none font-medium text-black">
                {{ __('filters.newest') }}
            </div>
            <div class="relative -mt-2.5 h-3 w-3">&darr;</div>
        </div>
    </div>
</form>

@push('scripts')
    <script type="text/javascript">
        document.querySelector('#filtersForm').addEventListener('change', function (event) {
            event.preventDefault();
            let filter_group = event.target.closest('.filter-group');

            if (event.target.classList.contains('filter-all') && filter_group.querySelector('.filter-all').checked) {
                filter_group.querySelectorAll('.filter-option').forEach((item) => (item.checked = false));
            } else if (event.target.classList.contains('filter-option')) {
                filter_group.querySelector('.filter-all').checked = false;
            }

            setTimeout(this.submit.bind(this), 300);
        });
    </script>
@endpush

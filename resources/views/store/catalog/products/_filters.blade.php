@php
    $size = !request()->has('filters.size.0') && array_key_exists('size', request()->get('filters', [])) && count(request('filters')['size']);
    $fabric = !request()->has('filters.fabric.0') && array_key_exists('fabric', request()->get('filters', [])) && count(request('filters')['fabric']);
    $color = !request()->has('filters.color.0') && array_key_exists('color', request()->get('filters', [])) && count(request('filters')['color']);
    $gender = !request()->has('filters.gender.0') && array_key_exists('gender', request()->get('filters', [])) && count(request('filters')['gender']);
    $season = !request()->has('filters.season.0') && array_key_exists('season', request()->get('filters', [])) && count(request('filters')['season']);
    $price = (request()->has('filters.price.from') && request()->get('filters')['price']['from']) || (request()->has('filters.price.to') && request()->get('filters')['price']['to']) || request()->has('filters.price.discounted');
    $family = !request()->has('filters.family.0') && array_key_exists('family', request()->get('filters', [])) && count(request('filters')['family']);
    $showClearButton = request()->has('filters') && ($size || $fabric || $color || $gender || $season || $price || $family);
@endphp
<form class="w-full h-full flex" action="{!! url()->current() !!}" accept-charset="ascii" name="filtersForm" id="filtersForm">
    @if( !is_null( request('term') ) )
        <input type="hidden" name="term" value="{!! request('term') !!}">
    @endif
    <div class="bg-white w-full mt-8 justify-between items-center hidden sm:flex">
        <div class="items-center justify-start gap-5 flex">
            <div class="opacity-40 justify-start items-center gap-1 inline-flex">
                <div class="w-3.5 h-3.5 relative">
                    <img src="{{ Vite::image('common/filter.svg') }}" alt="filter icon"/>
                </div>
                <div class="text-black text-sm font-medium leading-none">
                    {{ __('filters.filter_by') }}
                </div>
            </div>
            <div class="justify-start items-start gap-2 flex">
                <x-filters.sizes-dropdown/>
                <x-filters.fabrics-dropdown/>
                <x-filters.colors-dropdown/>
                <x-filters.genders-dropdown/>
                <x-filters.seasons-dropdown/>
                <x-filters.price-dropdown/>
                @auth
                    <x-filters.family-dropdown/>
                @endauth

                @if($showClearButton)
                    <div class="px-3 py-2 rounded-full justify-center items-center gap-2 flex">
                        <a href="{{ url()->current() }}"
                           class="filter-clear cursor-pointer flex justify-start underline underline-offset-2 text-sm items-center gap-1 text-olive font-bold leading-[14px]">
                            <svg class="flex-shrink-0 size-4 text-olive group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                            </svg>
                            {{ __('filters.clear') }}
                        </a>
                    </div>
                @endif
            </div>
        </div>
        <div class="items-center gap-2 inline-flex">
            <div class="opacity-40 justify-start items-center gap-1 flex">
                <div class="w-3.5 h-3.5 relative">
                    <img src="{{ Vite::image('common/sort.svg') }}" alt="sort icon"/>
                </div>
                <div class="text-black text-sm font-medium leading-none">
                    {{ __('filters.sort_by') }}
                </div>
            </div>
            <div class="text-black text-sm font-medium leading-none">
                {{ __('filters.newest') }}
            </div>
            <div class="w-3 h-3 relative -mt-2.5">&darr;</div>
        </div>
    </div>
</form>

@push('scripts')
    <script type="text/javascript">
        document.querySelector('#filtersForm').addEventListener('change', function (event) {

            event.preventDefault();
            let filter_group = event.target.closest('.filter-group');

            if (event.target.classList.contains('filter-all') && filter_group.querySelector('.filter-all').checked) {
                filter_group.querySelectorAll('.filter-option').forEach(item => item.checked = false);
            } else if (event.target.classList.contains('filter-option')) {
                filter_group.querySelector('.filter-all').checked = false;
            }

            setTimeout(this.submit.bind(this), 500);
        });
    </script>
@endpush

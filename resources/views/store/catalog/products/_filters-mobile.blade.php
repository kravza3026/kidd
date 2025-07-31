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
<form class="w-full h-full" action="{!! url()->current() !!}" accept-charset="ascii" name="filtersForm" id="filtersForm">
    @if( !is_null( request('term') ) )
        <input type="hidden" name="term" value="{!! request('term') !!}">
    @endif
    <div class="fixed top-auto bottom-[100px] w-[70%] left-[15%] h-14 z-50 flex items-center">
        <div class="p-5 flex items-center rounded-full rounded-r-none h-12 bg-charcoal border-white w-1/2">
            <div class="flex justify-start items-center gap-x-1">
                <div class="w-3.5 h-3.5 relative">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Icon">
                            <path id="Icon_2" d="M4.84959 6.70245L1.66293 3.80548C1.34676 3.51805 1.1665 3.11058 1.1665 2.68329C1.1665 1.84569 1.84551 1.16669 2.68311 1.16669H11.3166C12.1542 1.16669 12.8332 1.84569 12.8332 2.68329C12.8332 3.11058 12.6529 3.51805 12.3367 3.80548L9.15008 6.70245C8.94161 6.89197 8.82275 7.16065 8.82275 7.44239V8.95544C8.82275 9.563 8.54657 10.1376 8.07214 10.5172L6.80162 11.5336C6.14685 12.0574 5.17692 11.5912 5.17692 10.7527V7.44239C5.17692 7.16065 5.05807 6.89197 4.84959 6.70245Z" stroke="white" stroke-width="1.5"/>
                        </g>
                    </svg>

                </div>
                <div class="text-white flex gap-x-2 items-center text-nowrap w-full text-sm font-medium leading-none">
                    <p class="text-[12px]">Filter</p>
                    <p class="bg-olive rounded-full w-5 min-h-5 flex items-center text-black text-[12px] justify-center">2</p>
                </div>
            </div>
        </div>
        <div class="bg-charcoal p-5 rounded-full h-12 rounded-l-none w-1/2 flex items-center justify-center gap-x-2">
            <div>
                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Icon">
                        <path id="Icon_2" d="M4.7335 12.25V1.75M4.7335 1.75L1.5835 4.9M4.7335 1.75L7.8835 4.9M11.2668 1.75V12.25M11.2668 12.25L8.11683 9.1M11.2668 12.25L14.4168 9.1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                </svg>

            </div>
            <p class="text-white text-[12px]">Sort by</p>
        </div>

    </div>
    <div class=" w-full mt-8 justify-between items-center  sm:flex ">
        <div class="bg-white items-center justify-start gap-5 flex fixed z-50 left-0 w-full bottom-0">

{{--            <x-filtersMobile.sizes-dropdown/>--}}
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

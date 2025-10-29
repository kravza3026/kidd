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

<form  x-data="filtersModal()" class="w-full h-full" action="{!! url()->current() !!}" accept-charset="ascii" name="filtersForm" id="filtersForm">
    @if( !is_null( request('term') ) )
        <input type="hidden" name="term" value="{!! request('term') !!}">
    @endif
    <div class="fixed top-auto cursor-pointer bottom-[100px] w-full left-0 h-14 z-[2] flex items-center justify-center">
        <div class="max-w-64 mx-auto flex items-center justify-center bg-charcoal rounded-full ">
            <div
                @click="openFilter('all')"
                class="p-5 flex items-center rounded-full rounded-r-none h-12 bg-charcoal  w-1/2">
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
            <div
                @click="openFilter('sort')"
                class="bg-charcoal p-5 rounded-full h-12 rounded-l-none w-1/2 flex items-center justify-center gap-x-2">
                <div>
                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="Icon">
                            <path id="Icon_2" d="M4.7335 12.25V1.75M4.7335 1.75L1.5835 4.9M4.7335 1.75L7.8835 4.9M11.2668 1.75V12.25M11.2668 12.25L8.11683 9.1M11.2668 12.25L14.4168 9.1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                    </svg>

                </div>
                <p class="text-white text-[12px] font-bold">Sort by</p>
            </div>
        </div>

    </div>

        <div
            id="modal"
            x-show="modalOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-end="opacity-0"

            @click.self="closeModal()"
            class="fixed inset-0 h-screen w-screen bg-black/50 flex items-end justify-center z-[9999]"
        >
            <div
                id="modalContent"
                x-init="initFilters()"

                @open-filter.window="openFilter($event.detail)"
                class="bg-white w-full rounded-t-2xl py-2 relative transform transition-transform  ease-out"
            >
                <div class="mb-2 relative"
                >
                    <template x-if="currentFilter !== 'all'">
                        <div class="relative flex justify-between items-center h-14 mb-4  border-b border-light-border p-4">
                            <div class="flex items-center gap-x-2">
                                <button @click="backToAll()" type="button" class="border border-light-border rounded-full flex items-center justify-center size-10">
                                    <img class="rotate-180" src="{{ Vite::image('icons/right_arrow.svg') }}" alt="" />
                                </button>

                                <span class="text-black font-bold text-2xl" x-text="currentFilterTitle"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="currentFilter === 'all'">
                        <div
                            class="relative flex justify-between items-center h-14 mb-4 border-b border-light-border p-4">
                            <div class="flex items-center gap-x-2">
                                <button type="button"  @click="closeModal()"  class="border border-light-border rounded-full flex items-center justify-center size-10">
                                    <img class="rotate-180" src="{{ Vite::image('icons/right_arrow.svg') }}" alt="" />
                                </button>
                                <span class="text-black font font-bold text-2xl">Filter by</span>
                            </div>
                            <button type="button" class="flex items-center gap-x-2 top-2 right-3 text-black text-2xl border border-light-border rounded-full py-0 px-3">
                                &times; <span class="text-sm">Clear filter</span>
                            </button>
                        </div>
                    </template>

                    <x-filtersMobile.modal>
                        <div x-html="currentFilterHtml"></div>
                    </x-filtersMobile.modal>

                    <template x-if="currentFilter !== 'all'" >
                        <div class="px-4">
                            <x-ui.button  size="large" left_icon="false" right_icon="false" class="my-5 !rounded-xl !py-1 !w-full mx-auto font-bold">
                                Save & Continue
                            </x-ui.button>
                        </div>
                    </template>
                </div>


            </div>
        </div>

</form>


<style>
    #modalContent {
        transform: translateY(100%);
    }
</style>
@push('scripts')
    <script type="text/javascript">
        // document.querySelector('#filtersForm').addEventListener('change', function (event) {
        //
        //     event.preventDefault();
        //     let filter_group = event.target.closest('.filter-group');
        //
        //     if (event.target.classList.contains('filter-all') && filter_group.querySelector('.filter-all').checked) {
        //         filter_group.querySelectorAll('.filter-option').forEach(item => item.checked = false);
        //     } else if (event.target.classList.contains('filter-option')) {
        //         filter_group.querySelector('.filter-all').checked = false;
        //     }
        //
        //     setTimeout(this.submit.bind(this), 500);
        // });


        function filtersModal() {

            return {
                filters: {},
                titles: {
                    all: 'All filters',
                    sort: 'Sort by',
                    sizes: 'Size',
                    fabrics: 'Fabric type',
                    color: 'Color',
                    gender: 'Genders',
                    season: 'Seasons',
                    price: 'Price',
                    @auth
                    family_members: 'My Family',
                    @endauth
                },
                currentFilter: 'all', // базово — список усіх фільтрів
                get currentFilterHtml() {
                    return this.filters[this.currentFilter] || '';
                },
                get currentFilterTitle() {
                    return this.titles[this.currentFilter] || '';
                },
                initFilters() {
                    this.filters = {
                        all: @js(view('components.filtersMobile.all-filters')->render()),
                        sort: @js((new \App\View\Components\Filters\SortDropdown(variant: 'mobile'))->render()->render()),
                        sizes: @js((new \App\View\Components\Filters\SizesDropdown(variant: 'mobile'))->render()->render()),
                        season: @js((new \App\View\Components\Filters\SeasonsDropdown(variant: 'mobile'))->render()->render()),
                        price: @js((new \App\View\Components\Filters\PriceDropdown(variant: 'mobile'))->render()->render()),
                        gender: @js((new \App\View\Components\Filters\GendersDropdown(variant: 'mobile'))->render()->render()),
                        fabrics: @js((new \App\View\Components\Filters\FabricsDropdown(variant: 'mobile'))->render()->render()),
                        color: @js((new \App\View\Components\Filters\ColorsDropdown(variant: 'mobile'))->render()->render()),
                        @auth
                        family_members: @js((new \App\View\Components\Filters\FamilyDropdown(variant: 'mobile'))->render()->render()),
                        @endauth

                    };
                },
                modalOpen: false,

                openFilter(filterName) {
                    this.currentFilter = filterName;
                    this.modalOpen = true;

                    this.$nextTick(() => {
                        const modal = document.getElementById('modalContent');
                        modal.style.transition = 'transform 0.5s ease-out';
                        modal.style.transform = 'translateY(0)';
                    });
                },
                backToAll() {
                    this.currentFilter = 'all';
                },
                closeModal() {
                    const modal = document.getElementById('modalContent');
                    modal.style.transform = 'translateY(100%)';

                    setTimeout(() => {
                        this.modalOpen = false;
                    }, 500); // Чекаємо кінець анімації
                },
            }
        }
    </script>
@endpush

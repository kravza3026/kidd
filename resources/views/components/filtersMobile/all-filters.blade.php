@php
    $componentName = 'genders';
    $in_use = request()->has('filters') && (!request()->has('filters.gender.0') && array_key_exists('gender', request('filters')) ) ? count(request('filters')['gender']) : false;
       $filters = [
        ['title' => 'Sizes', 'slug' => 'sizes'],
        ['title' => 'Fabric type', 'slug' => 'fabrics'],
        ['title' => 'Colors', 'slug' => 'color'],
        ['title' => 'Gender', 'slug' => 'gender'],
        ['title' => 'Season', 'slug' => 'season'],
        ['title' => 'Price', 'slug' => 'price'],
        ['title' => 'Sort', 'slug' => 'sort'],
        ['title' => 'My Family', 'slug' => 'family_members'],
    ];
    // TODO add localization //
@endphp


        <div class="filter-group w-full space-y-4 grid bg-white ">
{{--            <div class="w-full flex justify-between gap-x-2 border-b border-light-border pb-2 px-2">--}}
{{--                <p class="text-black font-medium">Size</p>--}}
{{--                <div class="flex gap-x-2 items-center">--}}

{{--                    <ul class="flex gap-x-2 text-olive font-medium">--}}
{{--                        <li>0-3M</li>--}}
{{--                        <li>3-6M</li>--}}
{{--                        <li>6-9M</li>--}}
{{--                    </ul>--}}


{{--                    <span> > </span>--}}
{{--                </div>--}}
{{--            </div>--}}


            <div class="space-y-2">
                @foreach($filters as $filter)
                    <div
                        data-filter-slug="{{ $filter['slug'] }}"
                        class="w-full flex justify-between gap-x-2 border-b border-light-border pb-2 px-2 cursor-pointer"
                    >
                        <p class="text-black font-medium">{{ $filter['title'] }}</p>
                        <div class="flex gap-x-2 items-center">
                            <p class="text-light-black/40 leading-0">All {{ $filter['title'] }}</p>
                            <span class="leading-0 text-light-black/40">
                    <img src="{{ Vite::image('icons/right_arrow.svg') }}" alt="right arrow" />
                </span>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

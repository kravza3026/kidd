@php
    $componentName = 'seasons';
    $in_use = request()->has('filters') && (!request()->has('filters.season.0') && array_key_exists('season', request('filters')) ) ? count(request('filters')['season']) : false;
@endphp

<div class="filter-group w-full  grid space-y-[3px] z-[7000] left-0 bottom-0 px-2 bg-white">
    <label for="filter_{{ $componentName }}_0"
           class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
        <div class="inline-flex items-center">

            <x-ui.checkbox
                id="filter_{{ $componentName }}_0"
                name="filters[season][]"
                value="true"
                :modelValue="request()->has('filters.season.0') || !request()->has('filters.season')"
                class="rounded-full"
            />

            <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.all_seasons') }}
                    </span>
        </div>
        <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                                [{{ $seasons->sum('products_count') }}]
                            </span>
    </label>

    @foreach($seasons as $season)
        <label for="filter_{{ $componentName }}_{{ $season->id }}"
               class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
            <div class="inline-flex items-center">

                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $season->id }}"
                    name="filters[season][{{ $season->id }}]"
                    value="true"
                    :modelValue="request()->has('filters.season.'.$season->id)"
                    class="rounded-full "
                />

                <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $season->name }}
                        </span>
            </div>
            <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                        [{{ $season->products_count }}]
                    </span>
        </label>
    @endforeach
</div>

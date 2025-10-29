@php
    $componentName = 'genders';
    $in_use = request()->has('filters') && (!request()->has('filters.gender.0') && array_key_exists('gender', request('filters')) ) ? count(request('filters')['gender']) : false;
@endphp

<div class="filter-group grid space-y-[3px]">
    <label for="filter_{{ $componentName }}_0"
           class="cursor-pointer flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
        <div class="inline-flex items-center">
            <x-ui.checkbox
                id="filter_{{ $componentName }}_0"
                name="filters[gender][]"
                value="true"
                :modelValue="request()->has('filters.gender.0') || !request()->has('filters.gender')"
                class="rounded-full"
            />


            <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.all_genders') }}
                    </span>
        </div>
        <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                                [{{ $genders->sum('products_count') }}]
                            </span>
    </label>

    @foreach($genders as $gender)
        <label for="filter_{{ $componentName }}_{{ $gender->id }}"
               class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
            <div class="inline-flex items-center">
                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $gender->id }}"
                    name="filters[gender][{{ $gender->id }}]"
                    value="true"
                    :modelValue="request()->has('filters.gender.'.$gender->id)"
                    class="rounded-full "
                />

                <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $gender->name }}
                        </span>
            </div>
            <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                        [{{ $gender->products_count }}]
                    </span>
        </label>
    @endforeach

</div>

@php
    $componentName = 'colors';
    $in_use = request()->has('filters') && (! request()->has('filters.color.0') && array_key_exists('color', request('filters'))) ? count(request('filters')['color']) : false;
@endphp

<div class="filter-group grid space-y-[3px]">
    <label
        for="filter_{{ $componentName }}_0"
        class="has-[:checked]:bg-secondary hover:bg-secondary focus:ring-secondary flex w-full  cursor-pointer justify-between rounded-xl px-3 py-2 text-sm"
    >
        <div class="inline-flex items-center">
            <x-ui.checkbox
                id="filter_{{ $componentName }}_0"
                name="filters[color][]"
                value="true"
                :modelValue="request()->has('filters.color.0') || ! request()->has('filters.color')"
                class="filter-all rounded-full border-none border-transparent"
                style="background-image:url('{{Vite::image('icons/gradient.png')}}'); background-size: cover;background-color: transparent;
                        "
            />

            <span class="text-charcoal ms-2.5 text-sm leading-4 font-bold -tracking-[2%]">
                        {{ __('filters.all_colors') }}
                    </span>
        </div>
        <span class="text-charcoal/40 text-sm font-medium -tracking-[2%]">
                    [{{ $colors->sum('products_count') }}]
                </span>
    </label>

    @foreach ($colors as $color)
        <label
            for="filter_{{ $componentName }}_{{ $color->id }}"
            class="has-[:checked]:bg-secondary hover:bg-secondary focus:ring-secondary flex w-full  cursor-pointer justify-between rounded-xl px-3 py-2 text-sm"
        >
            <div class="inline-flex items-center">
                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $color->id }}"
                    name="filters[color][{{ $color->id }}]"
                    value="true"
                    :modelValue="request()->has('filters.color.'.$color->id)"
                    class="filter-option rounded-full"
                    style="background-color: {{ $color->hex }}"
                />

                <span class="text-charcoal ms-2.5 text-sm leading-4 font-bold -tracking-[2%]">
                            {{ $color->name }}
                        </span>
            </div>
            <span class="text-charcoal/40 text-sm font-medium -tracking-[2%]">
                        [{{ $color->products_count ?? 0 }}]
                    </span>
        </label>
    @endforeach
</div>

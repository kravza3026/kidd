@php
    $componentName = 'colors';
    $in_use = request()->has('filters') && (!request()->has('filters.color.0') && array_key_exists('color', request('filters'))) ? count(request('filters')['color']) : false;
@endphp

<div class="relative flex justify-between items-center h-14 mb-4 border-b border-light-border p-4">
    <div class="flex items-center gap-x-2">
        <button type="button"  id="closeModal"  class="border border-light-border rounded-full flex items-center justify-center size-10">
            <img class="rotate-180" src="{{ Vite::image('icons/right_arrow.svg') }}" alt="" />
        </button>
        <span class="text-black font font-bold text-2xl">Filter by</span>
    </div>
    <button type="button" class="flex items-center gap-x-2 top-2 right-3 text-black text-2xl border border-light-border rounded-full py-0 px-3">
        &times; <span class="text-sm">Clear filter</span>
    </button>
</div>

@foreach($colors as $color)

    <label for="filter_{{ $componentName }}_{{ $color->id }}"
           class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
        <div class="inline-flex items-center">

            <x-ui.checkbox
                id="filter_{{ $componentName }}_{{ $color->id }}"
                name="filters[color][{{ $color->id }}]"
                value="true"
                :modelValue="request()->has('filters.color.'.$color->id)"
                class="rounded-full"
                style="background-color: {{ $color->hex }}"
            />

            <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $color->name }}
                        </span>
        </div>
        <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
    [{{ $color->products_count ?? 0 }}]
</span>
    </label>
@endforeach

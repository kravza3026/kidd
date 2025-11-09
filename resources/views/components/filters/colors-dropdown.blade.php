@php
    $componentName = 'colors';
    $in_use = request()->has('filters') && (! request()->has('filters.color.0') && array_key_exists('color', request('filters'))) ? count(request('filters')['color']) : false;
@endphp

<x-ui.dropdown
    class=""
    align="top"
    width="w-size"
    trigger-classes="{{ $in_use ? 'bg-secondary border-darkest-snow border' : 'border border-transparent' }} px-3 py-2 rounded-full justify-center items-center gap-2 flex"
    content-classes="p-3 bg-white "
>
    <x-slot name="trigger">
        <div
            class="{{ $in_use ? 'text-olive font-extrabold' : 'font-medium text-black' }} flex cursor-pointer items-center justify-start gap-1 text-sm leading-[14px]"
        >
            {{ __('filters.color') }}
            @if ($in_use)
                <div class="bg-olive inline-flex min-w-5 items-center justify-center rounded-xl px-1 py-0.5 shadow-md">
                    <div class="text-center text-sm leading-none font-bold text-white">
                        {{ $in_use }}
                    </div>
                </div>
            @endif

            <svg
                class="size-4 flex-shrink-0 text-black group-hover:rotate-180"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="3"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="m6 9 6 6 6-6" />
            </svg>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="filter-group grid space-y-[3px]">
            <label
                for="filter_{{ $componentName }}_0"
                class="has-[:checked]:bg-secondary hover:bg-secondary focus:ring-secondary flex w-full max-w-xs cursor-pointer justify-between rounded-xl px-3 py-2 text-sm"
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
                    class="has-[:checked]:bg-secondary hover:bg-secondary focus:ring-secondary flex w-full max-w-xs cursor-pointer justify-between rounded-xl px-3 py-2 text-sm"
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
                        [{{ $color->products_count }}]
                    </span>
                </label>
            @endforeach
        </div>
    </x-slot>
</x-ui.dropdown>

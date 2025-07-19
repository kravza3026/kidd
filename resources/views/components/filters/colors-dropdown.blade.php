@php
    $componentName = 'colors';
    $in_use = request()->has('filters') && (!request()->has('filters.color.0') && array_key_exists('color', request('filters'))) ? count(request('filters')['color']) : false;
@endphp

<x-ui.dropdown class="" align="top" width="w-size"
            trigger-classes="{{ $in_use ? 'bg-secondary border-darkest-snow border' : 'border border-transparent' }} px-3 py-2 rounded-full justify-center items-center gap-2 flex"
            content-classes="p-3 bg-white rounded-full">
    <x-slot name="trigger">
        <div class="cursor-pointer flex justify-start items-center gap-1 {{ $in_use ? 'text-olive font-extrabold' : 'text-black font-medium' }} text-sm leading-[14px]">
            {{ __('filters.color') }}
            @if($in_use)
                <div class="min-w-5 bg-olive py-0.5 px-1 rounded-xl justify-center items-center inline-flex shadow-md">
                    <div class="text-center text-white text-sm font-bold leading-none">
                        {{ $in_use }}
                    </div>
                </div>
            @endif
            <svg class="flex-shrink-0 size-4 text-black group-hover:rotate-180" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </div>
    </x-slot>

    <x-slot name="content">
        <div class="filter-group grid space-y-[3px]">
            <label for="filter_{{ $componentName }}_0"
                   class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
                <div class="inline-flex items-center">
                    <input name="filters[color][]" value="true" type="checkbox"
                           style="background-image: url('{{ Vite::image('all_colors.svg') }}'); background-position: center;"
                           class="filter-all p-[12px] rounded-full text-white shadow-charcoal/15 shadow-inner border-0"
                           id="filter_{{ $componentName }}_0"
                        @checked(request()->has('filters.color.0') || !request()->has('filters.color'))>
                    <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.all_colors') }}
                    </span>
                </div>
                <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                                [{{ $colors->sum('products_count') }}]
                            </span>
            </label>

            @foreach($colors as $color)
                <label for="filter_{{ $componentName }}_{{ $color->id }}"
                       class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
                    <div class="inline-flex items-center">
                        <input name="filters[color][{{ $color->id }}]" value="true" type="checkbox"
                               style="background-color: {{ $color->hex }};"
                               class="filter-option bg-[{{ $color->hex }}] p-[12px] checked:bg-[{{ $color->hex }}] rounded-full text-white shadow-charcoal/15 shadow-inner border-0"
                               id="filter_{{ $componentName }}_{{ $color->id }}"
                            @checked(request()->has('filters.color.'.$color->id))>
                        <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $color->name }}
                        </span>
                    </div>
                    <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">
                        [{{ $color->products_count }}]
                    </span>
                </label>
            @endforeach

        </div>
    </x-slot>
</x-ui.dropdown>

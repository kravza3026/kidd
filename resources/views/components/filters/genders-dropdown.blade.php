@php
    $componentName = 'genders';
    $in_use = request()->has('filters') && (!request()->has('filters.gender.0') && array_key_exists('gender', request('filters')) ) ? count(request('filters')['gender']) : false;
@endphp

<x-ui.dropdown class="" align="top" width="w-size"
            trigger-classes="{{ $in_use ? 'bg-secondary border-darkest-snow border' : 'border border-transparent' }} px-3 py-2 rounded-full justify-center items-center gap-2 flex"
            content-classes="p-3 bg-white rounded-full">
    <x-slot name="trigger">
        <div class="cursor-pointer flex justify-start items-center gap-1 {{ $in_use ? 'text-olive font-extrabold' : 'text-black font-medium' }} text-sm leading-[14px]">
            {{ __('filters.gender') }}
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
                       class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
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
    </x-slot>
</x-ui.dropdown>

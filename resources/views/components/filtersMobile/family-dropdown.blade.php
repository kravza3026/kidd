@php
    $componentName = 'family_members';
    $in_use = request()->has('filters') && (!request()->has('filters.family.0') && array_key_exists('family', request('filters')) ) ? count(request('filters')['family']) : false;
@endphp

<div class="filter-group grid space-y-[3px]">
    <label for="filter_{{ $componentName }}_0"
           class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
        <div class="inline-flex items-center">

            <x-ui.checkbox
                id="filter_{{ $componentName }}_0"
                name="filters[family][]"
                value="true"
                :modelValue="request()->has('filters.family.0') || !request()->has('filters.family')"
                class="rounded-full"
            />

            {{--                    <input name="filters[family][]" value="true" type="checkbox"--}}
            {{--                           class="filter-all shrink-0 border-darken p-[11px] rounded-full text-olive focus:ring-olive disabled:opacity-50 disabled:pointer-events-none"--}}
            {{--                           id="filter_{{ $componentName }}_0"--}}
            {{--                        @checked(request()->has('filters.family.0') || !request()->has('filters.family'))>--}}
            <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                        {{ __('filters.all_family_members') }}
                    </span>
        </div>
        {{--                <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">--}}
        {{--                    [{{ $family_members->sum('products_count') }}]--}}
        {{--                </span>--}}
    </label>

    @foreach($family_members as $member)
        <label for="filter_{{ $componentName }}_{{ $member->id }}"
               class="cursor-pointer max-w-xs flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
            <div class="inline-flex items-center">
                <x-ui.checkbox
                    id="filter_{{ $componentName }}_{{ $member->id }}"
                    name="filters[family][{{ $member->id }}]"
                    value="true"
                    :modelValue="request()->has('filters.family.'.$member->id)"
                    class="rounded-full"
                />

                {{--                        <input name="filters[family][{{ $member->id }}]" value="true" type="checkbox"--}}
                {{--                               class="filter-option shrink-0 border-darken p-[11px] rounded-full text-olive focus:ring-olive disabled:opacity-50 disabled:pointer-events-none"--}}
                {{--                               id="filter_{{ $componentName }}_{{ $member->id }}"--}}
                {{--                            @checked(request()->has('filters.family.'.$member->id))>--}}
                <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $member->name }}
                        </span>
            </div>
            {{--                    <span class="text-charcoal/40 -tracking-[2%] text-sm font-medium">--}}
            {{--                        [{{ $member->products_count }}]--}}
            {{--                    </span>--}}
        </label>
    @endforeach

</div>

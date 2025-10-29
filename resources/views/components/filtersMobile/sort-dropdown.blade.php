@php
    $componentName = 'genders';
    $in_use = request()->has('filters') && (!request()->has('filters.gender.0') && array_key_exists('gender', request('filters')) ) ? count(request('filters')['gender']) : false;
@endphp
{{--TODO add filers to sort--}}
<div class="filter-group grid space-y-[3px]">
    @foreach($genders as $gender)
        <label for="filter_{{ $componentName }}_{{ $gender->id }}"
               class="cursor-pointer  flex justify-between px-3 py-2 w-full has-[:checked]:bg-secondary rounded-xl text-sm hover:bg-secondary focus:ring-secondary">
            <div class="inline-flex items-center">
                <x-ui.radio
                    id="filter_{{ $componentName }}_{{ $gender->id }}"
                    name="sortBy"
                    value="true"
                    :modelValue="request()->has('filters.gender.'.$gender->id)"
                    class="rounded-full "
                />

                <span class="text-sm leading-4 -tracking-[2%] font-bold text-charcoal ms-2.5">
                            {{ $gender->name }}
                        </span>
            </div>

        </label>
    @endforeach

</div>

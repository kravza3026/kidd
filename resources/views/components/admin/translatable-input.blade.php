@props([
    'name',
    'label' => null,
    'values' => [],
    'textarea' => false,
    'required' => false,
    'rows' => 4,
])

@php
    $locales = array_keys(config('app.locales', ['ro' => 'Română', 'ru' => 'Русский', 'en' => 'English']));
    // $values may be a translatable model's attribute (array locale => value) or a plain array.
    $values = is_array($values) ? $values : (array) $values;
    $inputClass = 'w-full rounded-xl border-[1.5px] border-[#eeeeee] p-3 text-base leading-tight text-charcoal focus:border-gray-200 focus:ring-gray-200';
@endphp

<div x-data="{ locale: @js($locales[0]) }" class="flex flex-col gap-1.5">
    <div class="flex items-center justify-between">
        @if ($label)
            <x-input-label>
                {{ $label }}
                @if ($required)
                    <span class="text-red-500">*</span>
                @endif
            </x-input-label>
        @endif

        <div class="flex gap-1">
            @foreach ($locales as $loc)
                <button
                    type="button"
                    @click="locale = @js($loc)"
                    :class="locale === @js($loc) ? 'bg-charcoal text-white' : 'bg-gray-100 text-gray-500'"
                    class="rounded-md px-2 py-0.5 text-xs font-semibold uppercase"
                >{{ $loc }}</button>
            @endforeach
        </div>
    </div>

    @foreach ($locales as $loc)
        <div x-show="locale === @js($loc)" x-cloak>
            @if ($textarea)
                <textarea
                    name="{{ $name }}[{{ $loc }}]"
                    rows="{{ $rows }}"
                    {{ $attributes->merge(['class' => $inputClass]) }}
                >{{ old($name.'.'.$loc, $values[$loc] ?? '') }}</textarea>
            @else
                <input
                    type="text"
                    name="{{ $name }}[{{ $loc }}]"
                    value="{{ old($name.'.'.$loc, $values[$loc] ?? '') }}"
                    {{ $attributes->merge(['class' => $inputClass]) }}
                />
            @endif

            <x-input-error :messages="$errors->get($name.'.'.$loc)" class="mt-1" />
        </div>
    @endforeach
</div>

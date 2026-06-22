@props(['name', 'options' => [], 'selected' => null, 'placeholder' => null])

@php
    // Normalise Collections / Enums to a [value => label] array.
    $options = $options instanceof \Illuminate\Support\Collection ? $options->all() : $options;
@endphp

<select
    name="{{ $name }}"
    {{ $attributes->merge(['class' => 'w-full rounded-xl border-[1.5px] border-[#eeeeee] p-3 text-base leading-tight text-charcoal focus:border-gray-200 focus:ring-gray-200']) }}
>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected((string) old($name, $selected) === (string) $value)>
            {{ $label }}
        </option>
    @endforeach
</select>

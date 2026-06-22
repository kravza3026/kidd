@props(['name', 'options' => [], 'selected' => null, 'placeholder' => null])

@php
    $options = $options instanceof \Illuminate\Support\Collection ? $options->all() : $options;
@endphp

<select name="{{ $name }}" {{ $attributes->merge(['class' => 'admin-input cursor-pointer']) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected((string) old($name, $selected) === (string) $value)>
            {{ $label }}
        </option>
    @endforeach
</select>

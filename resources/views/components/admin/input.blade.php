@props(['name', 'value' => null, 'type' => 'text'])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    {{ $attributes->merge(['class' => 'admin-input']) }}
/>

@props([
    'label' => null,
    'required' => false,
    'type' => 'text',
    'name' => null,
    'id' => null,
    'placeholder' => '',
    'value' => '',
    'customClass' => '',
    'labelClass' => 'font-medium',
])

<div class="flex flex-col gap-3 mt-3 {{ $customClass }}">
    @if ($label)
        <label for="{{ $id ?? Str::kebab($name) }}" class="text-sm {{ $labelClass }}">
            {{ $label }}
        </label>
    @endif
    <input
        @required($required)
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? Str::kebab($name) }}"
        @if($placeholder)
            placeholder="{{ $placeholder }}"
        @endif
        value="{{ old($name, $value) }}"
        {{ $attributes->merge([
            'class' => 'border-light-border border-1 focus:outline-hidden bg-white p-3 rounded-xl'
        ]) }}
    />
</div>

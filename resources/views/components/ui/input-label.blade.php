@props([
    'label' => null,
    'type' => 'text',
    'name' => null,
    'id' => null,
    'placeholder' => '',
    'value' => '',
    'customClass' => '',
])

<div class="flex flex-col gap-3 mt-3 {{ $customClass }}">
    @if ($label)
        <label for="{{ $id }}" class="text-[14px] font-bold">
            {{ $label }}
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge([
            'class' => 'border-light-border border-1 focus:outline-hidden bg-white p-3 rounded-xl'
        ]) }}
    />
</div>

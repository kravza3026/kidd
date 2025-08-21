@props([
    'label' => null,
    'optional' => false,
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
            @if($optional) <span class="opacity-40">(optional)</span> @endif
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
            'class' => 'border-light-border border-1 focus:border-olive bg-white p-3 rounded-xl'
        ]) }}
    />
</div>

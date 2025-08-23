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

<div class="{{ $customClass }} mt-3 flex flex-col gap-3">
    @if ($label)
        <label for="{{ $id ?? Str::kebab($name) }}" class="{{ $labelClass }} text-sm">
            {{ $label }}
            @if ($optional)
                <span class="opacity-40">{{ __('validation.attributes.shipping_optional') }}</span>
            @endif
        </label>
    @endif

    <input
        @required($required)
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id ?? Str::kebab($name) }}"
        @if ($placeholder)
            placeholder="{{ $placeholder }}"
        @endif
        value="{{ old($name, $value) }}"
        {{
            $attributes->merge([
                'class' => 'border-light-border border-1 focus:border-olive bg-white p-3 rounded-xl',
            ])
        }}
    />

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>

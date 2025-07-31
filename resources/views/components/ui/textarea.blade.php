@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'value' => '',
])

<div class="flex flex-col gap-3 mt-5">
    @if ($label)
        <label for="{{ $id }}" class="text-[14px] font-bold">
            {{ $label }}
        </label>
    @endif

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $attributes->merge([
            'class' => 'border-light-border border-1 focus:outline-hidden min-h-[120px] bg-white p-3 rounded-xl'
        ]) }}
    >{{ old($name, $value) }}</textarea>
</div>

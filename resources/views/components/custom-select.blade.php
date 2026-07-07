@props([
    'id' => null,
    'name',
    'label' => null,
    'options' => [], // ['value' => 'Label']
    'selected' => null,
    'placeholder' => 'Select…',
    'disabled' => false,
    'customClass' => '',
])

@php
    use Illuminate\Support\Str;

    $fieldId = $id ?? Str::kebab($name);
    $selectedValue = $selected === null ? '' : (string) $selected;
@endphp

{{--
    A styled native <select>: reliable, accessible, and posts its value without depending on
    the page-level Vue/Alpine runtime (which interfered with a custom dropdown here).
--}}
<div class="{{ $customClass }} relative">
    @if ($label)
        <label for="{{ $fieldId }}" class="mb-1 block text-sm font-bold">{{ $label }}</label>
    @endif

    <select
        id="{{ $fieldId }}"
        name="{{ $name }}"
        @disabled($disabled)
        class="border-light-border mt-3 w-full cursor-pointer appearance-none rounded-xl border bg-white p-3 pr-10 text-left focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
        style="
            background-image: url('{{ Vite::image('icons/select-arrows_o.svg') }}');
            background-repeat: no-repeat;
            background-position: right 1rem center;
        "
    >
        <option value="" disabled @selected($selectedValue === '')>{{ $placeholder }}</option>
        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}" @selected($selectedValue === (string) $value)>{{ $optionLabel }}</option>
        @endforeach
    </select>
</div>

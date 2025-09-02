@props([
    'id' => null,
    'name',
    'label' => null,
    'options' => [],          // ['value' => 'Label']
    'selected' => null,
    'placeholder' => 'Select…',
    'disabled' => false,
    'customClass' => '',
])

@php
    use Illuminate\Support\Str;
    $fieldId = $id ?? Str::kebab($name);
@endphp

<div x-data="{
        open: false,
        value: '{{ $selected }}',
        options: {{ Illuminate\Support\Js::from($options) }}
    }"
     class="relative {{ $customClass }}"
>
    @if($label)
        <label for="{{ $fieldId }}" class="block text-sm font-bold mb-1">{{ $label }}</label>
    @endif
    @if($fieldId)
            <input id="{{$fieldId}}" value="" type="hidden">
        @endif
    <!-- Toggle button -->
    <button type="button"
            @click="open = !open"
            @keydown.escape="open = false"
            class="w-full mt-3 bg-white border border-light-border rounded-xl p-3 text-left flex justify-between items-center"
            :class="{'opacity-50 cursor-not-allowed': {{ $disabled ? 'true' : 'false' }}}"
        {{ $disabled ? 'disabled' : '' }}
    >
        <span x-text="value ? options[value] ?? value : '{{ $placeholder }}'"></span>
        <img src="{{Vite::image('/icons/select-arrows_o.svg')}}" alt="">
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.outside="open = false"
         x-transition
         class="absolute z-10 w-full mt-1 bg-white border border-light-border rounded-xl shadow-lg max-h-60 overflow-auto"
    >
        <template x-for="[key, label] in Object.entries(options)" :key="key">
            <label
                class="flex items-center justify-between px-4 py-2 cursor-pointer hover:bg-olive hover:text-white transition-colors rounded"
            >
                <div class="flex items-center gap-2">
                    <input type="radio" @click="open = false" :value="key" name="{{ $name }}" class="hidden" x-model="value">
                    <span x-text="label"></span>
                </div>
                <!-- Галочка для вибраної опції -->
                <svg x-show="value == key" class="w-4 h-4 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </label>
        </template>
    </div>
</div>

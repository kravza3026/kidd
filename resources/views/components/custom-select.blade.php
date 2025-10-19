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

<div
    x-data="{
        open: false,
        value: '{{ $selected }}',
        options: {{ Illuminate\Support\Js::from($options) }},
    }"
    class="{{ $customClass }} relative"
>
    @if ($label)
        <label for="{{ $fieldId }}" class="mb-1 block text-sm font-bold">{{ $label }}</label>
    @endif

    @if ($fieldId)
        <input id="{{ $fieldId }}" value="" type="hidden" />
    @endif

    <!-- Toggle button -->
    <button
        type="button"
        @click="open = !open"
        @keydown.escape="open = false"
        class="border-light-border mt-3 flex w-full items-center justify-between rounded-xl border bg-white p-3 text-left"
        :class="{'opacity-50 cursor-not-allowed': {{ $disabled ? 'true' : 'false' }}}"
        {{ $disabled ? 'disabled' : '' }}
    >
        <span x-text="value ? (options[value] ?? value) : '{{ $placeholder }}'"></span>
        <img src="{{ Vite::image('icons/select-arrows_o.svg') }}" alt="" />
    </button>

    <!-- Dropdown -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-xl border bg-white shadow-lg"
    >
        <template x-for="[key, label] in Object.entries(options)" :key="key">
            <label
                class="hover:bg-olive flex cursor-pointer items-center justify-between rounded px-4 py-2 transition-colors hover:text-white"
            >
                <div class="flex items-center gap-2">
                    <input
                        type="radio"
                        @click="open = false"
                        :value="key"
                        name="{{ $name }}"
                        class="hidden"
                        x-model="value"
                    />
                    <span x-text="label"></span>
                </div>
                <!-- Галочка для вибраної опції -->
                <svg
                    x-show="value == key"
                    class="text-olive h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </label>
        </template>
    </div>
</div>

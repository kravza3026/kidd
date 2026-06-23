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
    use Illuminate\Support\Js;
    use Illuminate\Support\Str;

    $fieldId = $id ?? Str::kebab($name);

    // Normalise the [value => label] map into a list of objects so Alpine can iterate it
    // with a plain `x-for="option in options"` (Object.entries + destructuring is brittle).
    $optionList = collect($options)
        ->map(fn ($label, $value) => ['value' => (string) $value, 'label' => $label])
        ->values();
@endphp

{{--
    v-pre: this is an Alpine island; stop the page-level Vue app (mounted on #app) from
    compiling its @click/x-for so Alpine can own the subtree.
--}}
<div
    v-pre
    x-data="{
        open: false,
        value: {{ Js::from((string) ($selected ?? '')) }},
        placeholder: {{ Js::from($placeholder) }},
        options: {{ Js::from($optionList) }},
        labelFor(v) {
            const found = this.options.find((o) => o.value === String(v))
            return found ? found.label : this.placeholder
        },
    }"
    class="{{ $customClass }} relative"
>
    @if ($label)
        <label for="{{ $fieldId }}" class="mb-1 block text-sm font-bold">{{ $label }}</label>
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
        <span x-text="labelFor(value)"></span>
        <img src="{{ Vite::image('icons/select-arrows_o.svg') }}" alt="" />
    </button>

    <!-- Dropdown (options rendered server-side; Alpine only toggles + tracks selection) -->
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition
        class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-xl border bg-white shadow-lg"
    >
        @foreach ($optionList as $option)
            <label
                class="hover:bg-olive flex cursor-pointer items-center justify-between rounded px-4 py-2 transition-colors hover:text-white"
            >
                <div class="flex items-center gap-2">
                    <input
                        type="radio"
                        @click="open = false"
                        value="{{ $option['value'] }}"
                        name="{{ $name }}"
                        class="hidden"
                        x-model="value"
                    />
                    <span>{{ $option['label'] }}</span>
                </div>
                <svg
                    x-show="value == '{{ $option['value'] }}'"
                    class="text-olive h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </label>
        @endforeach
    </div>
</div>

@props([
    'name',
    'label' => null,
    'multiple' => false,
    'current' => [],
])

@php
    $current = $current instanceof \Illuminate\Support\Collection ? $current->all() : (array) $current;
@endphp

<div class="flex flex-col gap-2">
    @if ($label)
        <label class="admin-label">{{ $label }}</label>
    @endif

    @if (! empty($current))
        <div class="flex flex-wrap gap-2">
            @foreach ($current as $media)
                <img
                    src="{{ is_string($media) ? $media : $media->getUrl() }}"
                    alt=""
                    class="h-16 w-16 rounded-lg border border-line object-cover"
                />
            @endforeach
        </div>
    @endif

    <input
        type="file"
        name="{{ $multiple ? $name.'[]' : $name }}"
        @if ($multiple) multiple @endif
        accept="image/*"
        {{ $attributes->merge(['class' => 'block w-full text-sm text-ink-muted file:mr-4 file:rounded-lg file:border-0 file:bg-surface-2 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-ink hover:file:bg-line']) }}
    />
</div>

@props([
    'name',
    'label' => null,
    'multiple' => false,
    'current' => [],
])

@php
    // $current may be a MediaLibrary media collection, an array of URLs, or a single URL.
    $current = $current instanceof \Illuminate\Support\Collection ? $current->all() : (array) $current;
@endphp

<div class="flex flex-col gap-2">
    @if ($label)
        <x-input-label>{{ $label }}</x-input-label>
    @endif

    @if (! empty($current))
        <div class="flex flex-wrap gap-3">
            @foreach ($current as $media)
                <img
                    src="{{ is_string($media) ? $media : $media->getUrl() }}"
                    alt=""
                    class="h-20 w-20 rounded-xl border border-[#eeeeee] object-cover"
                />
            @endforeach
        </div>
    @endif

    <input
        type="file"
        name="{{ $multiple ? $name.'[]' : $name }}"
        @if ($multiple) multiple @endif
        accept="image/*"
        {{ $attributes->merge(['class' => 'block w-full text-sm text-gray-600 file:mr-4 file:rounded-xl file:border-0 file:bg-gray-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-charcoal hover:file:bg-gray-200']) }}
    />
</div>

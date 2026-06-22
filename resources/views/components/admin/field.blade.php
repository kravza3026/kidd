@props(['label' => null, 'name' => null, 'required' => false, 'hint' => null])

@php($fieldError = $name ? $errors->first($name) : null)

<div {{ $attributes->only('class')->merge(['class' => 'flex flex-col gap-1.5']) }}>
    @if ($label)
        <label class="admin-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @if ($hint)
        <p class="text-xs text-ink-muted">{{ $hint }}</p>
    @endif

    @if ($fieldError)
        <p class="text-xs text-danger">{{ $fieldError }}</p>
    @endif
</div>

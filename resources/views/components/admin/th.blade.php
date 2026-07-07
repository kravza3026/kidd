@props([
    'field',
    'label',
    'sortField' => null,
    'sortDirection' => 'asc',
    'align' => 'left',
])

@php($isActive = $sortField === $field)

<th {{ $attributes->merge(['class' => 'admin-table-cell font-medium text-'.$align]) }}>
    <button type="button" wire:click="sortBy('{{ $field }}')" class="inline-flex items-center gap-1 hover:text-ink">
        <span>{{ $label }}</span>
        <span @class(['size-3 transition', 'opacity-0' => ! $isActive, 'text-olive' => $isActive])>
            {!! $isActive && $sortDirection === 'desc' ? '&#9662;' : '&#9652;' !!}
        </span>
    </button>
</th>

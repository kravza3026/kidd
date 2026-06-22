@props([
    'resource',
    'editUrl' => null,
    'deleteId' => null,
    'deleteConfirm' => null,
])

{{-- Compact icon actions for a table row. Extra actions can be passed as the slot
     (rendered before edit/delete), each using the .admin-icon-btn class. --}}
<div class="flex items-center justify-end gap-0.5">
    {{ $slot }}

    @if ($editUrl)
        @can("{$resource}.update")
            <a href="{{ $editUrl }}" wire:navigate title="{{ __('Edit') }}" aria-label="{{ __('Edit') }}" class="admin-icon-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4">
                    <path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a>
        @endcan
    @endif

    @if ($deleteId !== null)
        @can("{$resource}.delete")
            <button
                type="button"
                wire:click="delete({{ $deleteId }})"
                wire:confirm="{{ $deleteConfirm ?? __('Delete this item?') }}"
                title="{{ __('Delete') }}"
                aria-label="{{ __('Delete') }}"
                class="admin-icon-btn admin-icon-btn--danger"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4">
                    <path d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        @endcan
    @endif
</div>

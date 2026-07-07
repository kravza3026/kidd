@php
    $actionLabels = [
        'viewAny' => __('List'),
        'view' => __('View'),
        'create' => __('Create'),
        'update' => __('Edit'),
        'delete' => __('Delete'),
    ];
@endphp

<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Roles'), 'route' => 'admin.roles.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit role') : __('New role')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Role')">
            <x-admin.field :label="__('Name')" name="name" required class="max-w-sm">
                <input type="text" wire:model="name" class="admin-input" />
            </x-admin.field>
        </x-admin.card>

        <x-admin.card :title="__('Permissions')" :description="__('Tick the actions this role may perform per area.')">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-line text-sm">
                    <thead class="text-xs text-ink-muted uppercase">
                        <tr>
                            <th class="admin-table-cell text-left font-medium">{{ __('Area') }}</th>
                            @foreach ($actions as $action)
                                <th class="admin-table-cell text-center font-medium">{{ $actionLabels[$action] ?? $action }}</th>
                            @endforeach
                            <th class="admin-table-cell text-right font-medium">{{ __('All') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($resources as $key => $label)
                            <tr wire:key="res-{{ $key }}" class="hover:bg-surface-2">
                                <td class="admin-table-cell font-medium text-ink">{{ $label }}</td>
                                @foreach ($actions as $action)
                                    <td class="admin-table-cell text-center">
                                        <input type="checkbox" wire:model="selected" value="{{ $key }}.{{ $action }}" class="size-4 rounded border-line accent-[color:var(--olive)]" />
                                    </td>
                                @endforeach
                                <td class="admin-table-cell text-right">
                                    <button type="button" wire:click="toggleResource('{{ $key }}')" class="text-xs font-semibold text-olive hover:underline">{{ __('Toggle') }}</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create role') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.roles.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

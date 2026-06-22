<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Roles')]]" />

    <x-admin.page-header :title="__('Roles & permissions')" :subtitle="__('Control what each staff role can do')">
        <x-slot:actions>
            @can('role.create')
                <x-admin.button :href="route('admin.roles.create')" wire:navigate>{{ __('New role') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="admin-card overflow-hidden">
        <div class="flex items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Search…') }}" class="admin-input pl-8" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="name" :label="__('Role')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Permissions') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Users') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($roles as $role)
                        <tr wire:key="role-{{ $role->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                {{ $role->name }}
                                @if (in_array($role->name, $protected, true))
                                    <x-admin.status-badge color="purple" :label="__('System')" class="ml-1" />
                                @endif
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $role->permissions_count }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $role->users_count }}</td>
                            <td class="admin-table-cell">
                                <div class="flex items-center justify-end gap-1">
                                    @can('role.update')
                                        <a href="{{ route('admin.roles.edit', $role) }}" wire:navigate class="admin-btn admin-btn--ghost">{{ __('Edit') }}</a>
                                    @endcan
                                    @can('role.delete')
                                        @unless (in_array($role->name, $protected, true))
                                            <button type="button" wire:click="delete({{ $role->id }})" wire:confirm="{{ __('Delete this role?') }}" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Delete') }}</button>
                                        @endunless
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No roles found.') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $roles->links() }}</div>
    </div>
</div>

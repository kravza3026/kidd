<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Customers')]]" />

    <x-admin.page-header :title="__('Customers')" :subtitle="__('Manage customers')">
        <x-slot:actions>
            @can('create', App\Models\Customer::class)
                <x-admin.button :href="route('admin.customers.create')" wire:navigate>{{ __('New customer') }}</x-admin.button>
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
            <span wire:loading.delay wire:target="search" class="text-xs text-ink-muted">{{ __('Searching…') }}</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="first_name" :label="__('Name')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <x-admin.th field="email" :label="__('Email')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Phone') }}</th>
                        <th class="admin-table-cell text-left font-medium">{{ __('Orders') }}</th>
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($customers as $customer)
                        <tr wire:key="cust-{{ $customer->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.customers.show', $customer) }}" wire:navigate class="hover:text-olive">{{ $customer->name }}</a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $customer->email }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $customer->phone }}</td>
                            <td class="admin-table-cell text-ink-muted">{{ $customer->orders_count }}</td>
                            <td class="admin-table-cell">
                                <div class="flex items-center justify-end gap-1">
                                    @can('update', $customer)
                                        <a href="{{ route('admin.customers.edit', $customer) }}" wire:navigate class="admin-btn admin-btn--ghost">{{ __('Edit') }}</a>
                                    @endcan
                                    @can('delete', $customer)
                                        <button type="button" wire:click="delete({{ $customer->id }})" wire:confirm="{{ __('Delete this customer?') }}" class="admin-btn admin-btn--ghost text-danger hover:bg-danger/10">{{ __('Delete') }}</button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No customers found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $customers->links() }}</div>
    </div>
</div>

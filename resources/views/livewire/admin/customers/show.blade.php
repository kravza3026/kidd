<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Customers'), 'route' => 'admin.customers.index'],
        ['label' => $customer->name],
    ]" />

    <x-admin.page-header :title="$customer->name" :subtitle="$customer->email">
        <x-slot:actions>
            @can('update', $customer)
                <x-admin.button :href="route('admin.customers.edit', $customer)" wire:navigate>{{ __('Edit') }}</x-admin.button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        <x-admin.card :title="__('Contact')" class="lg:col-span-1">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Email') }}</dt>
                <dd class="text-ink">{{ $customer->email }}</dd>
                <dt class="text-ink-muted">{{ __('Phone') }}</dt>
                <dd class="text-ink">{{ $customer->phone }}</dd>
                <dt class="text-ink-muted">{{ __('Company') }}</dt>
                <dd class="text-ink">{{ $customer->company?->name ?? '—' }}</dd>
            </dl>
        </x-admin.card>

        <x-admin.card :title="__('Orders')" class="lg:col-span-2">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-line text-sm">
                    <thead class="text-xs text-ink-muted uppercase">
                        <tr>
                            <th class="admin-table-cell text-left font-medium">{{ __('Order') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Status') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Placed') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse ($customer->orders as $order)
                            <tr wire:key="order-{{ $order->id }}">
                                <td class="admin-table-cell text-ink">{{ $order->order_number }}</td>
                                <td class="admin-table-cell"><x-admin.status-badge color="gray" :label="$order->status?->label() ?? '—'" /></td>
                                <td class="admin-table-cell text-ink-muted">{{ $order->created_at?->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="admin-table-cell py-8 text-center text-ink-muted">{{ __('No orders yet.') }}</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-admin.card>
    </div>
</div>

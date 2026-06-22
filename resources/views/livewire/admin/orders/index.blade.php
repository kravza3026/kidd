@php
    $statusColor = fn ($s) => match ($s) {
        \App\Enums\OrderStatus::Delivered, \App\Enums\OrderStatus::Completed => 'green',
        \App\Enums\OrderStatus::Canceled, \App\Enums\OrderStatus::Failed, \App\Enums\OrderStatus::Returned, \App\Enums\OrderStatus::Refunded, \App\Enums\OrderStatus::Expired => 'red',
        \App\Enums\OrderStatus::Processing, \App\Enums\OrderStatus::Processed, \App\Enums\OrderStatus::OutForDelivery, \App\Enums\OrderStatus::Shipped => 'blue',
        \App\Enums\OrderStatus::Pending, \App\Enums\OrderStatus::New => 'yellow',
        default => 'gray',
    };
@endphp

<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Orders')]]" />
    <x-admin.page-header :title="__('Orders')" :subtitle="__('Manage customer orders')" />

    <div class="admin-card overflow-hidden">
        <div class="flex flex-wrap items-center gap-2 border-b border-line p-2.5">
            <div class="relative max-w-xs flex-1">
                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute top-1/2 left-2.5 size-4 -translate-y-1/2 text-ink-muted">
                    <path d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input type="search" wire:model.live.debounce.300ms="search" placeholder="{{ __('Order # or customer…') }}" class="admin-input pl-8" />
            </div>
            <select wire:model.live="status" class="admin-input max-w-[12rem] cursor-pointer">
                <option value="">{{ __('All statuses') }}</option>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-line text-sm">
                <thead class="bg-surface-2 text-xs tracking-wide text-ink-muted uppercase">
                    <tr>
                        <x-admin.th field="order_number" :label="__('Order #')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-left font-medium">{{ __('Customer') }}</th>
                        <x-admin.th field="status" :label="__('Status')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <x-admin.th field="total_amount" :label="__('Total')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <x-admin.th field="created_at" :label="__('Placed')" :sort-field="$sortField" :sort-direction="$sortDirection" />
                        <th class="admin-table-cell text-right font-medium">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($orders as $order)
                        <tr wire:key="ord-{{ $order->id }}" class="hover:bg-surface-2">
                            <td class="admin-table-cell font-medium text-ink">
                                <a href="{{ route('admin.orders.show', $order) }}" wire:navigate class="hover:text-olive">{{ $order->order_number }}</a>
                            </td>
                            <td class="admin-table-cell text-ink-muted">{{ $order->customer?->name ?? __('Guest') }}</td>
                            <td class="admin-table-cell"><x-admin.status-badge :color="$statusColor($order->status)" :label="$order->status->name" /></td>
                            <td class="admin-table-cell text-ink">{{ number_format($order->total_amount / 100, 2) }} MDL</td>
                            <td class="admin-table-cell text-ink-muted">{{ $order->created_at?->format('Y-m-d H:i') }}</td>
                            <td class="admin-table-cell">
                                <x-admin.row-actions :model="$order" :view-url="route('admin.orders.show', $order)" :delete-id="$order->id" :delete-confirm="__('Delete this order?')" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table-cell py-10 text-center text-ink-muted">{{ __('No orders found.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-line p-2.5">{{ $orders->links() }}</div>
    </div>
</div>

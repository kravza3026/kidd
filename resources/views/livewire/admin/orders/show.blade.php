<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Orders'), 'route' => 'admin.orders.index'],
        ['label' => $order->order_number],
    ]" />

    <x-admin.page-header :title="$order->order_number" :subtitle="$order->customer?->name ?? __('Guest')">
        <x-slot:actions>
            <a href="{{ route('admin.orders.invoice', $order->id) }}" class="admin-btn admin-btn--secondary">{{ __('Download invoice') }}</a>
            @can('delete', $order)
                <button type="button" wire:click="delete" wire:confirm="{{ __('Delete this order?') }}" class="admin-btn admin-btn--danger">{{ __('Delete') }}</button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        {{-- Items + addresses --}}
        <div class="space-y-4 lg:col-span-2">
            <x-admin.card :title="__('Items')">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-line text-sm">
                        <thead class="text-xs text-ink-muted uppercase">
                            <tr>
                                <th class="admin-table-cell text-left font-medium">{{ __('Item') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Qty') }}</th>
                                <th class="admin-table-cell text-left font-medium">{{ __('Unit') }}</th>
                                <th class="admin-table-cell text-right font-medium">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line">
                            @forelse ($order->items as $item)
                                <tr wire:key="item-{{ $item->id }}">
                                    <td class="admin-table-cell text-ink">{{ $item->variant?->sku ?? data_get($item->variant_snapshot, 'sku', '—') }}</td>
                                    <td class="admin-table-cell text-ink-muted">{{ $item->quantity }}</td>
                                    <td class="admin-table-cell text-ink-muted">{{ number_format(((int) $item->unit_price) / 100, 2) }}</td>
                                    <td class="admin-table-cell text-right text-ink">{{ number_format(((int) $item->total_price) / 100, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="admin-table-cell py-8 text-center text-ink-muted">{{ __('No items.') }}</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-admin.card>

            <div class="grid gap-4 sm:grid-cols-2">
                @foreach (['shipping' => __('Shipping address'), 'billing' => __('Billing address')] as $rel => $heading)
                    <x-admin.card :title="$heading">
                        @php($addr = $order->{$rel})
                        @if ($addr)
                            <div class="text-sm text-ink-muted">
                                <p class="font-medium text-ink">{{ trim(($addr->contact_first_name ?? '').' '.($addr->contact_last_name ?? '')) ?: '—' }}</p>
                                <p>{{ collect([$addr->street_name, $addr->building])->filter()->join(', ') }}</p>
                                <p>{{ collect([$addr->city?->getTranslation('name', app()->getLocale()) ?? null, $addr->postal_code])->filter()->join(', ') }}</p>
                                @if ($addr->contact_phone)<p>{{ $addr->contact_phone }}</p>@endif
                            </div>
                        @else
                            <p class="text-sm text-ink-muted">—</p>
                        @endif
                    </x-admin.card>
                @endforeach
            </div>
        </div>

        {{-- Status + summary --}}
        <div class="space-y-4">
            @can('update', $order)
                <x-admin.card :title="__('Status & notes')">
                    <div class="flex flex-col gap-3">
                        <x-admin.field :label="__('Status')" name="status">
                            <select wire:model="status" class="admin-input cursor-pointer">
                                @foreach ($statuses as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </x-admin.field>
                        <x-admin.field :label="__('Notes')" name="notes">
                            <textarea wire:model="notes" rows="3" class="admin-input"></textarea>
                        </x-admin.field>
                        <button type="button" wire:click="updateStatus" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="updateStatus">
                            <span wire:loading.remove wire:target="updateStatus">{{ __('Update order') }}</span>
                            <span wire:loading wire:target="updateStatus">{{ __('Saving…') }}</span>
                        </button>
                    </div>
                </x-admin.card>
            @endcan

            <x-admin.card :title="__('Summary')">
                <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                    <dt class="text-ink-muted">{{ __('Total') }}</dt>
                    <dd class="text-ink">{{ number_format($order->total_amount / 100, 2) }} MDL</dd>
                    <dt class="text-ink-muted">{{ __('Shipping') }}</dt>
                    <dd class="text-ink">{{ $order->shipping_method?->name ?? '—' }}</dd>
                    <dt class="text-ink-muted">{{ __('Payment') }}</dt>
                    <dd class="text-ink">{{ $order->payment_method?->name ?? '—' }}</dd>
                    <dt class="text-ink-muted">{{ __('Placed') }}</dt>
                    <dd class="text-ink">{{ $order->created_at?->format('Y-m-d H:i') }}</dd>
                </dl>
            </x-admin.card>
        </div>
    </div>
</div>

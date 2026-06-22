<div class="space-y-5">
    <x-admin.page-header :title="__('Dashboard')" :subtitle="__('Store overview')" />

    {{-- Stat cards --}}
    <div class="grid grid-cols-2 gap-3 lg:grid-cols-4">
        @php
            $cards = [
                ['label' => __('Products'), 'value' => $stats['products'], 'route' => 'admin.products.index'],
                ['label' => __('Categories'), 'value' => $stats['categories'], 'route' => 'admin.categories.index'],
                ['label' => __('Orders'), 'value' => $stats['orders'], 'route' => 'admin.orders.index'],
                ['label' => __('Customers'), 'value' => $stats['customers'], 'route' => 'admin.customers.index'],
            ];
        @endphp

        @foreach ($cards as $card)
            <a
                href="{{ \Illuminate\Support\Facades\Route::has($card['route']) ? route($card['route']) : '#' }}"
                wire:navigate
                wire:key="stat-{{ $card['label'] }}"
                class="admin-card flex flex-col gap-1 px-4 py-3 transition-colors hover:border-olive"
            >
                <span class="text-xs font-semibold tracking-wide text-ink-muted uppercase">{{ $card['label'] }}</span>
                <span class="text-2xl font-bold text-ink">{{ number_format($card['value']) }}</span>
            </a>
        @endforeach
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
        {{-- Low stock --}}
        <x-admin.card :title="__('Low stock')" :description="__('Variants at or below the threshold')">
            @forelse ($lowStock as $variant)
                <div
                    class="flex items-center justify-between gap-3 border-b border-line py-2 last:border-0"
                    wire:key="low-{{ $variant->id }}"
                >
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-ink">
                            {{ $variant->product?->getTranslation('name', app()->getLocale()) ?? __('Unknown product') }}
                        </p>
                        <p class="text-xs text-ink-muted">{{ $variant->sku ?? '—' }}</p>
                    </div>
                    <x-admin.status-badge
                        :color="$variant->quantity <= 0 ? 'red' : 'yellow'"
                        :label="$variant->quantity . ' ' . __('in stock')"
                    />
                </div>
            @empty
                <p class="py-6 text-center text-sm text-ink-muted">{{ __('Everything is well stocked.') }}</p>
            @endforelse
        </x-admin.card>

        {{-- Recent orders --}}
        <x-admin.card :title="__('Recent orders')">
            @forelse ($recentOrders as $order)
                <div
                    class="flex items-center justify-between gap-3 border-b border-line py-2 last:border-0"
                    wire:key="order-{{ $order->id }}"
                >
                    <div class="min-w-0">
                        <p class="truncate text-sm font-medium text-ink">{{ $order->order_number }}</p>
                        <p class="text-xs text-ink-muted">{{ $order->customer?->name ?? __('Guest') }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-admin.status-badge color="gray" :label="$order->status?->label() ?? '—'" />
                        <span class="text-xs text-ink-muted">{{ $order->created_at?->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <p class="py-6 text-center text-sm text-ink-muted">{{ __('No orders yet.') }}</p>
            @endforelse
        </x-admin.card>
    </div>
</div>

<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Order returns'), 'route' => 'admin.order-returns.index'],
        ['label' => $orderReturn->order?->order_number ?? '#'.$orderReturn->order_id],
    ]" />

    <x-admin.page-header
        :title="__('Return for :order', ['order' => $orderReturn->order?->order_number ?? '#'.$orderReturn->order_id])"
        :subtitle="$orderReturn->reason->label()"
    >
        <x-slot:actions>
            @if ($orderReturn->order)
                <a href="{{ route('admin.orders.show', $orderReturn->order) }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('View order') }}</a>
            @endif
            @can('delete', $orderReturn)
                <button type="button" wire:click="delete" wire:confirm="{{ __('Delete this return request?') }}" class="admin-btn admin-btn--danger">{{ __('Delete') }}</button>
            @endcan
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid gap-4 lg:grid-cols-3">
        <x-admin.card :title="__('Request')" class="lg:col-span-1">
            <dl class="grid grid-cols-2 gap-y-2.5 text-sm">
                <dt class="text-ink-muted">{{ __('Status') }}</dt>
                <dd><x-admin.status-badge :color="$orderReturn->status->color()" :label="$orderReturn->status->label()" /></dd>
                <dt class="text-ink-muted">{{ __('Reason') }}</dt>
                <dd class="text-ink">{{ $orderReturn->reason->label() }}</dd>
                <dt class="text-ink-muted">{{ __('Customer') }}</dt>
                <dd class="text-ink">{{ trim(($orderReturn->customer?->first_name ?? '').' '.($orderReturn->customer?->last_name ?? '')) ?: '—' }}</dd>
                <dt class="text-ink-muted">{{ __('Received') }}</dt>
                <dd class="text-ink">{{ $orderReturn->created_at?->format('Y-m-d H:i') }}</dd>
            </dl>

            @can('update', $orderReturn)
                <div class="mt-4 border-t border-line pt-4">
                    <p class="mb-2 text-xs font-medium text-ink-muted uppercase">{{ __('Set status') }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach (\App\Enums\ReturnStatus::cases() as $status)
                            <button
                                type="button"
                                wire:click="updateStatus({{ $status->value }})"
                                @disabled($orderReturn->status === $status)
                                class="admin-btn admin-btn--secondary text-xs disabled:opacity-40"
                            >
                                {{ $status->label() }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endcan
        </x-admin.card>

        <x-admin.card :title="__('Returned items')" class="lg:col-span-2">
            <ul class="divide-y divide-line text-sm">
                @forelse ($orderReturn->selectedItems() as $item)
                    <li class="flex items-center justify-between py-2" wire:key="ret-item-{{ $item->id }}">
                        <span class="text-ink">{{ $item->variant?->product?->name ?? ($item->variant_snapshot['name'] ?? '—') }}</span>
                        <span class="text-ink-muted">× {{ $item->quantity }}</span>
                    </li>
                @empty
                    <li class="py-2 text-ink-muted">{{ __('No items recorded.') }}</li>
                @endforelse
            </ul>

            @if ($orderReturn->comment)
                <div class="mt-4 border-t border-line pt-4">
                    <p class="mb-1 text-xs font-medium text-ink-muted uppercase">{{ __('Comment') }}</p>
                    <p class="text-sm whitespace-pre-line text-ink">{{ $orderReturn->comment }}</p>
                </div>
            @endif

            @if ($orderReturn->getMedia('images')->isNotEmpty())
                <div class="mt-4 border-t border-line pt-4">
                    <p class="mb-2 text-xs font-medium text-ink-muted uppercase">{{ __('Photos') }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($orderReturn->getMedia('images') as $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" rel="noopener" wire:key="ret-media-{{ $media->id }}">
                                <img src="{{ $media->getUrl() }}" alt="" class="size-20 rounded-lg border border-line object-cover" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-admin.card>
    </div>
</div>

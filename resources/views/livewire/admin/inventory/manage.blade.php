<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Inventory'), 'route' => 'admin.inventory.index'],
        ['label' => $variant->sku ?? __('Variant')],
    ]" />

    <x-admin.page-header
        :title="$variant->product?->getTranslation('name', app()->getLocale()) ?? __('Variant')"
        :subtitle="trim(($variant->color?->getTranslation('name', app()->getLocale()) ?? '').' · '.($variant->size?->getTranslation('name', app()->getLocale()) ?? '').' · '.($variant->sku ?? ''))" />

    {{-- Current levels --}}
    <x-admin.card :title="__('Stock by warehouse')" :description="__('Total in stock:').' '.$variant->fresh()->quantity">
        @if ($levels->isNotEmpty())
            <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($levels as $level)
                    <div class="flex items-center justify-between rounded-lg border border-line px-3 py-2" wire:key="lvl-{{ $level->id }}">
                        <span class="text-sm text-ink">{{ $level->warehouse?->getTranslation('name', app()->getLocale()) ?? '—' }}</span>
                        <span class="text-sm font-semibold text-ink">{{ $level->quantity }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-ink-muted">{{ __('No stock recorded yet.') }}</p>
        @endif
    </x-admin.card>

    <div class="grid gap-5 lg:grid-cols-3">
        {{-- Receive --}}
        <x-admin.card :title="__('Receive')">
            <form wire:submit="receive" class="space-y-3">
                <x-admin.field :label="__('Warehouse')" name="receiveWarehouse">
                    <select wire:model="receiveWarehouse" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($warehouses as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('Quantity')" name="receiveQuantity">
                    <input type="number" min="1" wire:model="receiveQuantity" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Note')" name="receiveNote">
                    <input type="text" wire:model="receiveNote" class="admin-input" />
                </x-admin.field>
                <button type="submit" class="admin-btn admin-btn--primary w-full">{{ __('Receive stock') }}</button>
            </form>
        </x-admin.card>

        {{-- Adjust --}}
        <x-admin.card :title="__('Adjust level')">
            <form wire:submit="adjust" class="space-y-3">
                <x-admin.field :label="__('Warehouse')" name="adjustWarehouse">
                    <select wire:model="adjustWarehouse" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($warehouses as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('Set to')" name="adjustLevel">
                    <input type="number" min="0" wire:model="adjustLevel" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Note')" name="adjustNote">
                    <input type="text" wire:model="adjustNote" class="admin-input" />
                </x-admin.field>
                <button type="submit" class="admin-btn admin-btn--secondary w-full">{{ __('Adjust') }}</button>
            </form>
        </x-admin.card>

        {{-- Transfer --}}
        <x-admin.card :title="__('Transfer')">
            <form wire:submit="transfer" class="space-y-3">
                <x-admin.field :label="__('From')" name="transferFrom">
                    <select wire:model="transferFrom" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($warehouses as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('To')" name="transferTo">
                    <select wire:model="transferTo" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($warehouses as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('Quantity')" name="transferQuantity">
                    <input type="number" min="1" wire:model="transferQuantity" class="admin-input" />
                </x-admin.field>
                <button type="submit" class="admin-btn admin-btn--secondary w-full">{{ __('Transfer') }}</button>
            </form>
        </x-admin.card>
    </div>

    {{-- Movement ledger --}}
    <x-admin.card :title="__('Recent movements')">
        @if ($movements->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-line text-sm">
                    <thead class="bg-surface-2 text-xs text-ink-muted uppercase">
                        <tr>
                            <th class="admin-table-cell text-left font-medium">{{ __('When') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Type') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Warehouse') }}</th>
                            <th class="admin-table-cell text-right font-medium">{{ __('Change') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('By') }}</th>
                            <th class="admin-table-cell text-left font-medium">{{ __('Note') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @foreach ($movements as $movement)
                            <tr wire:key="mv-{{ $movement->id }}">
                                <td class="admin-table-cell text-ink-muted">{{ $movement->created_at->format('Y-m-d H:i') }}</td>
                                <td class="admin-table-cell text-ink">{{ $movement->type->label() }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $movement->warehouse?->getTranslation('name', app()->getLocale()) ?? '—' }}</td>
                                <td @class([
                                    'admin-table-cell text-right font-semibold',
                                    'text-danger' => $movement->quantity < 0,
                                    'text-dark-olive dark:text-olive' => $movement->quantity > 0,
                                ])>{{ $movement->quantity > 0 ? '+' : '' }}{{ $movement->quantity }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $movement->user?->name ?? __('System') }}</td>
                                <td class="admin-table-cell text-ink-muted">{{ $movement->note ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-sm text-ink-muted">{{ __('No movements yet.') }}</p>
        @endif
    </x-admin.card>
</div>

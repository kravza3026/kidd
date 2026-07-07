<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Orders'), 'route' => 'admin.orders.index'],
        ['label' => __('New')],
    ]" />

    <x-admin.page-header :title="__('New order')" />

    <form wire:submit="save" class="grid gap-5 lg:grid-cols-3">
        <div class="space-y-5 lg:col-span-2">
            {{-- Customer --}}
            <x-admin.card :title="__('Customer')">
                <div class="mb-3 flex items-center gap-2">
                    <x-admin.toggle name="creatingCustomer" :checked="$creatingCustomer" wire:model.live="creatingCustomer" :label="__('Create a new customer')" />
                </div>

                @if ($creatingCustomer)
                    <div class="grid gap-4 sm:grid-cols-2">
                        <x-admin.field :label="__('First name')" name="new_first_name">
                            <input type="text" wire:model="new_first_name" class="admin-input" />
                        </x-admin.field>
                        <x-admin.field :label="__('Last name')" name="new_last_name">
                            <input type="text" wire:model="new_last_name" class="admin-input" />
                        </x-admin.field>
                        <x-admin.field :label="__('Email')" name="new_email">
                            <input type="email" wire:model="new_email" class="admin-input" />
                        </x-admin.field>
                        <x-admin.field :label="__('Phone')" name="new_phone">
                            <input type="text" wire:model="new_phone" class="admin-input" />
                        </x-admin.field>
                    </div>
                @else
                    <x-admin.field :label="__('Existing customer')" name="customer_id">
                        <select wire:model="customer_id" class="admin-input">
                            <option value="">{{ __('— Select —') }}</option>
                            @foreach ($customers as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                @endif
            </x-admin.card>

            {{-- Line items --}}
            <x-admin.card :title="__('Items')" :description="__('Search a product variant by name, SKU or barcode to add it.')">
                <div class="relative">
                    <input type="search" wire:model.live.debounce.300ms="variantSearch" placeholder="{{ __('Search variants…') }}" class="admin-input" />
                    @if (! empty($variantResults))
                        <div class="absolute z-20 mt-1 w-full overflow-hidden rounded-lg border border-line bg-surface shadow-lg">
                            @foreach ($variantResults as $result)
                                <button type="button" wire:click="addItem({{ $result['id'] }})" wire:key="res-{{ $result['id'] }}" class="block w-full px-3 py-2 text-left text-sm text-ink hover:bg-surface-2">
                                    {{ $result['label'] }}
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                @error('items') <p class="mt-2 text-xs text-danger">{{ $message }}</p> @enderror

                @if (! empty($items))
                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-line text-sm">
                            <thead class="bg-surface-2 text-xs text-ink-muted uppercase">
                                <tr>
                                    <th class="admin-table-cell text-left font-medium">{{ __('Variant') }}</th>
                                    <th class="admin-table-cell text-left font-medium">{{ __('Unit price') }}</th>
                                    <th class="admin-table-cell text-left font-medium">{{ __('Qty') }}</th>
                                    <th class="admin-table-cell text-right font-medium">{{ __('Line total') }}</th>
                                    <th class="admin-table-cell"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-line">
                                @foreach ($items as $i => $item)
                                    <tr wire:key="item-{{ $item['variant_id'] }}">
                                        <td class="admin-table-cell text-ink">{{ $item['label'] }}</td>
                                        <td class="admin-table-cell"><input type="number" step="0.01" min="0" wire:model.live="items.{{ $i }}.unit_price" class="admin-input w-24" /></td>
                                        <td class="admin-table-cell"><input type="number" min="1" wire:model.live="items.{{ $i }}.quantity" class="admin-input w-20" /></td>
                                        <td class="admin-table-cell text-right text-ink">{{ number_format((float) $item['unit_price'] * (int) $item['quantity'], 2) }}</td>
                                        <td class="admin-table-cell text-right">
                                            <button type="button" wire:click="removeItem({{ $i }})" class="admin-icon-btn admin-icon-btn--danger" title="{{ __('Remove') }}">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4"><path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t border-line">
                                    <td colspan="3" class="admin-table-cell text-right text-sm font-semibold text-ink">{{ __('Total') }}</td>
                                    <td class="admin-table-cell text-right text-sm font-bold text-ink">{{ number_format($this->total, 2) }} MDL</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <p class="mt-4 text-center text-sm text-ink-muted">{{ __('No items yet.') }}</p>
                @endif
            </x-admin.card>
        </div>

        {{-- Side: details --}}
        <div class="space-y-5">
            <x-admin.card :title="__('Details')">
                <div class="grid gap-4">
                    <x-admin.field :label="__('Status')" name="status">
                        <select wire:model="status" class="admin-input">
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                    <x-admin.field :label="__('Shipping method')" name="shipping_method">
                        <select wire:model="shipping_method" class="admin-input">
                            @foreach ($shippingMethods as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                    <x-admin.field :label="__('Payment method')" name="payment_method">
                        <select wire:model="payment_method" class="admin-input">
                            @foreach ($paymentMethods as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                    <x-admin.field :label="__('Notes')" name="notes">
                        <textarea wire:model="notes" rows="3" class="admin-input"></textarea>
                    </x-admin.field>
                </div>
            </x-admin.card>

            <div class="flex flex-col gap-2">
                <button type="submit" class="admin-btn admin-btn--primary w-full" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ __('Create order') }}</span>
                    <span wire:loading wire:target="save">{{ __('Creating…') }}</span>
                </button>
                <a href="{{ route('admin.orders.index') }}" wire:navigate class="admin-btn admin-btn--secondary w-full">{{ __('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>

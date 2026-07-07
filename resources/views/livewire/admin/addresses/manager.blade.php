<div class="space-y-3">
    {{-- Existing addresses --}}
    @forelse ($addresses as $address)
        <div class="flex items-start justify-between gap-3 rounded-lg border border-line px-3 py-2.5" wire:key="addr-{{ $address->id }}">
            <div class="min-w-0">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-sm font-medium text-ink">{{ $address->label }}</span>
                    <x-admin.status-badge :color="$address->address_type->value === 4 ? 'blue' : 'gray'" :label="$address->address_type->name" />
                    @if ($address->is_default)
                        <x-admin.status-badge color="green" :label="__('Default')" />
                    @endif
                </div>
                <p class="mt-0.5 truncate text-xs text-ink-muted">
                    {{ collect([
                        $address->city?->getTranslation('name', app()->getLocale()),
                        $address->street_name,
                        $address->building ? __('bld.').' '.$address->building : null,
                        $address->apartment ? __('apt.').' '.$address->apartment : null,
                        $address->postal_code,
                    ])->filter()->implode(', ') }}
                </p>
            </div>
            <div class="flex shrink-0 items-center gap-0.5">
                @unless ($address->is_default)
                    <button type="button" wire:click="makeDefault({{ $address->id }})" title="{{ __('Set default') }}" class="admin-icon-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4"><path d="M11.48 3.5a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.840.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" stroke-linecap="round" stroke-linejoin="round" /></svg>
                    </button>
                @endunless
                <button type="button" wire:click="edit({{ $address->id }})" title="{{ __('Edit') }}" class="admin-icon-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4"><path d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Z" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
                <button type="button" wire:click="delete({{ $address->id }})" wire:confirm="{{ __('Remove this address?') }}" title="{{ __('Delete') }}" class="admin-icon-btn admin-icon-btn--danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" class="size-4"><path d="m14.74 9-.346 9m-4.788 0L9.26 9M18.16 5.79 17.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.84 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916" stroke-linecap="round" stroke-linejoin="round" /></svg>
                </button>
            </div>
        </div>
    @empty
        @unless ($showForm)
            <p class="text-sm text-ink-muted">{{ __('No addresses yet.') }}</p>
        @endunless
    @endforelse

    {{-- Add / edit form --}}
    @if ($showForm)
        <form wire:submit="save" class="space-y-4 rounded-lg border border-line bg-surface-2/40 p-4">
            <div class="grid gap-3 sm:grid-cols-2">
                <x-admin.field :label="__('Label')" name="label" required>
                    <input type="text" wire:model="label" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Type')" name="address_type">
                    <select wire:model="address_type" class="admin-input cursor-pointer">
                        @foreach ($types as $value => $name)
                            <option value="{{ $value }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('Region')" name="region_id" required>
                    <select wire:model.live="region_id" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($regions as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('City')" name="city_id" required>
                    <select wire:model="city_id" class="admin-input cursor-pointer" @disabled(! $region_id)>
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($cities as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
                <x-admin.field :label="__('Street')" name="street_name" required>
                    <input type="text" wire:model="street_name" class="admin-input" />
                </x-admin.field>
                <div class="grid grid-cols-4 gap-2">
                    <x-admin.field :label="__('Building')" name="building" required>
                        <input type="text" wire:model="building" class="admin-input" />
                    </x-admin.field>
                    <x-admin.field :label="__('Entr.')" name="entrance">
                        <input type="text" wire:model="entrance" class="admin-input" />
                    </x-admin.field>
                    <x-admin.field :label="__('Floor')" name="floor">
                        <input type="text" wire:model="floor" class="admin-input" />
                    </x-admin.field>
                    <x-admin.field :label="__('Apt.')" name="apartment">
                        <input type="text" wire:model="apartment" class="admin-input" />
                    </x-admin.field>
                </div>
                <x-admin.field :label="__('Postal code')" name="postal_code">
                    <input type="text" wire:model="postal_code" class="admin-input" placeholder="MD-2001" />
                </x-admin.field>
                <x-admin.field :label="__('Intercom')" name="intercom">
                    <input type="text" wire:model="intercom" class="admin-input" />
                </x-admin.field>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <x-admin.field :label="__('Contact first name')" name="contact_first_name">
                    <input type="text" wire:model="contact_first_name" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Contact last name')" name="contact_last_name">
                    <input type="text" wire:model="contact_last_name" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Contact phone')" name="contact_phone">
                    <input type="text" wire:model="contact_phone" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Contact email')" name="contact_email">
                    <input type="email" wire:model="contact_email" class="admin-input" />
                </x-admin.field>
            </div>

            <x-admin.switch wire-model="is_default" :label="__('Default for this type')" />

            <div class="flex items-center gap-2">
                <button type="submit" class="admin-btn admin-btn--primary">{{ $editingId ? __('Save changes') : __('Add address') }}</button>
                <button type="button" wire:click="$set('showForm', false)" class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</button>
            </div>
        </form>
    @else
        <button type="button" wire:click="new" class="admin-btn admin-btn--secondary">{{ __('Add address') }}</button>
    @endif
</div>

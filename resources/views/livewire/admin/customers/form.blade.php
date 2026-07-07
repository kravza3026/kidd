<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Customers'), 'route' => 'admin.customers.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit customer') : __('New customer')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Customer details')">
            <div class="grid gap-4 sm:grid-cols-2">
                <x-admin.field :label="__('First name')" name="first_name" required>
                    <input type="text" wire:model="first_name" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Last name')" name="last_name" required>
                    <input type="text" wire:model="last_name" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Email')" name="email" required>
                    <input type="email" wire:model="email" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Phone')" name="phone" required>
                    <input type="text" wire:model="phone" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Company')" name="company_id" required>
                    <select wire:model="company_id" class="admin-input cursor-pointer">
                        <option value="">{{ __('— Select —') }}</option>
                        @foreach ($companies as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create customer') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.customers.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

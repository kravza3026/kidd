<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Warehouses'), 'route' => 'admin.warehouses.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit warehouse') : __('New warehouse')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Warehouse details')">
            <div class="grid gap-4">
                <x-admin.translatable wire-model="name" :label="__('Name')" required />
                <x-admin.field :label="__('Code')" name="code" required hint="{{ __('Up to 3 characters, unique.') }}">
                    <input type="text" wire:model="code" maxlength="3" class="admin-input w-32 uppercase" />
                </x-admin.field>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create warehouse') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.warehouses.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

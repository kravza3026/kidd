<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Companies'), 'route' => 'admin.companies.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit company') : __('New company')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Company details')">
            <div class="grid gap-4 sm:grid-cols-2">
                <x-admin.field :label="__('Name')" name="name" required>
                    <input type="text" wire:model="name" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('IDNO')" name="idno">
                    <input type="text" wire:model="idno" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Email')" name="email">
                    <input type="email" wire:model="email" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Phone')" name="phone">
                    <input type="text" wire:model="phone" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Website')" name="website">
                    <input type="text" wire:model="website" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('VAT %')" name="tva">
                    <input type="number" wire:model="tva" class="admin-input w-32" />
                </x-admin.field>
            </div>
            <div class="mt-4 border-t border-line pt-4">
                <x-admin.switch wire-model="active" :label="__('Active')" />
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create company') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.companies.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

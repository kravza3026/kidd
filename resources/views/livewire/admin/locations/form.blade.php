<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Locations'), 'route' => 'admin.locations.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit location') : __('New location')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Location details')">
            <div class="grid gap-4">
                <x-admin.translatable wire-model="name" :label="__('Name')" required />
                <x-admin.field :label="__('Type')" name="type" required>
                    <select wire:model="type" class="admin-input w-48 cursor-pointer">
                        @foreach ($types as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </x-admin.field>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create location') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route('admin.locations.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

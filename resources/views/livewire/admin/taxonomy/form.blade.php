<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => $title, 'route' => $routePrefix.'.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="($editing ? __('Edit') : __('New')).' · '.$title" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Details')">
            <div class="grid gap-4">
                <x-admin.translatable wire-model="name" :label="$nameLabel" required />

                @if ($withDescription)
                    <x-admin.translatable wire-model="description" :label="__('Description')" textarea />
                @endif

                @if (! empty($extraFields))
                    <div class="grid gap-4 sm:grid-cols-2">
                        @foreach ($extraFields as $field)
                            <x-admin.field :label="$field['label']" :name="$field['model']">
                                @if (($field['type'] ?? 'text') === 'select')
                                    <select wire:model="{{ $field['model'] }}" class="admin-input cursor-pointer">
                                        @foreach ($field['options'] ?? [] as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $field['type'] ?? 'text' }}" wire:model="{{ $field['model'] }}" class="admin-input" />
                                @endif
                            </x-admin.field>
                        @endforeach
                    </div>
                @endif

                <x-admin.field :label="__('Sort order')" name="sort_order">
                    <input type="number" wire:model="sort_order" class="admin-input w-32" />
                </x-admin.field>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
            <a href="{{ route($routePrefix.'.index') }}" wire:navigate class="admin-btn admin-btn--secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>

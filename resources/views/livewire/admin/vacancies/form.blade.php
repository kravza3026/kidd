<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Vacancies'), 'route' => 'admin.vacancies.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit vacancy') : __('New vacancy')" />

    <form wire:submit="save" class="grid gap-5 lg:grid-cols-3">
        <div class="space-y-5 lg:col-span-2">
            <x-admin.card :title="__('Content')">
                <div class="grid gap-4">
                    <x-admin.translatable wire-model="fields.title" :label="__('Title')" required />
                    <x-admin.translatable wire-model="fields.summary" :label="__('Summary')" textarea :rows="2" />
                    <x-admin.translatable wire-model="fields.responsibilities" :label="__('Responsibilities')" textarea :rows="4" />
                    <x-admin.translatable wire-model="fields.requirements" :label="__('Requirements')" textarea :rows="4" />
                    <x-admin.translatable wire-model="fields.extra" :label="__('Extra')" textarea :rows="3" />
                </div>
            </x-admin.card>
        </div>

        <div class="space-y-5">
            <x-admin.card :title="__('Settings')">
                <div class="grid gap-4">
                    <x-admin.field :label="__('Company')" name="company_id" required>
                        <select wire:model="company_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— Select —') }}</option>
                            @foreach ($companies as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                    <x-admin.field :label="__('Location')" name="location_id" required>
                        <select wire:model="location_id" class="admin-input cursor-pointer">
                            <option value="">{{ __('— Select —') }}</option>
                            @foreach ($locations as $id => $label)
                                <option value="{{ $id }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </x-admin.field>
                    <x-admin.switch wire-model="remote" :label="__('Remote')" />
                    <x-admin.field :label="__('Internal notes')" name="notes">
                        <textarea wire:model="notes" rows="3" class="admin-input"></textarea>
                    </x-admin.field>
                </div>
            </x-admin.card>

            <div class="flex flex-col gap-2">
                <button type="submit" class="admin-btn admin-btn--primary w-full" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create vacancy') }}</span>
                    <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
                </button>
                <a href="{{ route('admin.vacancies.index') }}" wire:navigate class="admin-btn admin-btn--secondary w-full">{{ __('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>

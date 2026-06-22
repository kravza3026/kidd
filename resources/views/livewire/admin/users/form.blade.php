<div class="space-y-5">
    <x-admin.breadcrumbs :items="[
        ['label' => __('Users'), 'route' => 'admin.users.index'],
        ['label' => $editing ? __('Edit') : __('New')],
    ]" />

    <x-admin.page-header :title="$editing ? __('Edit user') : __('New user')" />

    <form wire:submit="save" class="grid gap-5 lg:grid-cols-3">
        <div class="space-y-5 lg:col-span-2">
            <x-admin.card :title="__('Account details')">
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
                    <x-admin.field :label="__('Password')" name="password" :required="! $editing" :hint="$editing ? __('Leave blank to keep current.') : null">
                        <input type="password" wire:model="password" class="admin-input" autocomplete="new-password" />
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
        </div>

        <div class="space-y-5">
            <x-admin.card :title="__('Roles')">
                <div class="flex flex-col gap-2">
                    @forelse ($allRoles as $role)
                        <label class="flex cursor-pointer items-center gap-2 text-sm text-ink">
                            <input type="checkbox" wire:model="roles" value="{{ $role }}" class="size-4 rounded border-line accent-[color:var(--olive)]" />
                            {{ $role }}
                        </label>
                    @empty
                        <p class="text-sm text-ink-muted">{{ __('No roles defined.') }}</p>
                    @endforelse
                </div>
            </x-admin.card>

            <div class="flex flex-col gap-2">
                <button type="submit" class="admin-btn admin-btn--primary w-full" wire:loading.attr="disabled" wire:target="save">
                    <span wire:loading.remove wire:target="save">{{ $editing ? __('Save changes') : __('Create user') }}</span>
                    <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
                </button>
                <a href="{{ route('admin.users.index') }}" wire:navigate class="admin-btn admin-btn--secondary w-full">{{ __('Cancel') }}</a>
            </div>
        </div>
    </form>
</div>

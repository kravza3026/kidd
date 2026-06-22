<div class="space-y-5">
    <x-admin.breadcrumbs :items="[['label' => __('Settings')]]" />

    <x-admin.page-header :title="__('Settings')" :subtitle="__('Store profile shown on the storefront')" />

    <form wire:submit="save" class="space-y-5">
        <x-admin.card :title="__('Social links')" :description="__('Shown in the storefront footer.')">
            <div class="grid gap-4 sm:grid-cols-2">
                <x-admin.field :label="__('Facebook')" name="facebook_url">
                    <input type="url" wire:model="facebook_url" class="admin-input" placeholder="https://facebook.com/…" />
                </x-admin.field>
                <x-admin.field :label="__('Instagram')" name="instagram_url">
                    <input type="url" wire:model="instagram_url" class="admin-input" placeholder="https://instagram.com/…" />
                </x-admin.field>
                <x-admin.field :label="__('Messenger')" name="messenger_url">
                    <input type="url" wire:model="messenger_url" class="admin-input" placeholder="https://m.me/…" />
                </x-admin.field>
                <x-admin.field :label="__('YouTube')" name="youtube_url">
                    <input type="url" wire:model="youtube_url" class="admin-input" placeholder="https://youtube.com/…" />
                </x-admin.field>
                <x-admin.field :label="__('TikTok')" name="tiktok_url">
                    <input type="url" wire:model="tiktok_url" class="admin-input" placeholder="https://tiktok.com/…" />
                </x-admin.field>
            </div>
        </x-admin.card>

        <x-admin.card :title="__('Contact')" :description="__('Public contact details.')">
            <div class="grid gap-4 sm:grid-cols-2">
                <x-admin.field :label="__('Phone')" name="contact_phone">
                    <input type="text" wire:model="contact_phone" class="admin-input" />
                </x-admin.field>
                <x-admin.field :label="__('Email')" name="contact_email">
                    <input type="email" wire:model="contact_email" class="admin-input" />
                </x-admin.field>
            </div>
        </x-admin.card>

        <div class="flex items-center gap-3">
            <button type="submit" class="admin-btn admin-btn--primary" wire:loading.attr="disabled" wire:target="save">
                <span wire:loading.remove wire:target="save">{{ __('Save settings') }}</span>
                <span wire:loading wire:target="save">{{ __('Saving…') }}</span>
            </button>
        </div>
    </form>
</div>

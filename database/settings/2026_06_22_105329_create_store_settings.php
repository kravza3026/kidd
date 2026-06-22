<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Seed defaults from the current env-backed config so the storefront is unchanged
        // until an admin edits them.
        $this->migrator->add('store.facebook_url', config('services.social_links.facebook'));
        $this->migrator->add('store.instagram_url', config('services.social_links.instagram'));
        $this->migrator->add('store.messenger_url', config('services.social_links.messenger'));
        $this->migrator->add('store.youtube_url', config('services.social_links.youtube'));
        $this->migrator->add('store.tiktok_url', config('services.social_links.tiktok'));
        $this->migrator->add('store.contact_phone', null);
        $this->migrator->add('store.contact_email', null);
    }
};

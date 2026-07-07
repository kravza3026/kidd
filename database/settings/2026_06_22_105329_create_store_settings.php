<?php

use App\Support\SettingsSeeder;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    /**
     * Seed outside a transaction with a single insert. The spatie migrator issues an
     * exists()+insert per property; on some local Postgres setups (pooler + prepared
     * statements) the second bound statement in a transaction aborts it. One direct,
     * cast insert on a freshly reconnected (autocommit) session sidesteps that entirely.
     */
    public $withinTransaction = false;

    public function up(): void
    {
        DB::reconnect();

        SettingsSeeder::seed('store', [
            'facebook_url' => config('services.social_links.facebook'),
            'instagram_url' => config('services.social_links.instagram'),
            'messenger_url' => config('services.social_links.messenger'),
            'youtube_url' => config('services.social_links.youtube'),
            'tiktok_url' => config('services.social_links.tiktok'),
            'contact_phone' => null,
            'contact_email' => null,
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'store')->delete();
    }
};

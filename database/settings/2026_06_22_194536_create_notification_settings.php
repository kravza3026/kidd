<?php

use App\Support\SettingsSeeder;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    // See create_store_settings: seed outside a transaction with a single cast insert on a
    // fresh connection to avoid the pooler/prepared-statement abort.
    public $withinTransaction = false;

    public function up(): void
    {
        DB::reconnect();

        SettingsSeeder::seed('notifications', [
            'notify_new_order' => true,
            'notify_new_inquiry' => true,
            'notify_new_application' => true,
            'notify_low_stock' => true,
        ]);
    }

    public function down(): void
    {
        DB::table('settings')->where('group', 'notifications')->delete();
    }
};

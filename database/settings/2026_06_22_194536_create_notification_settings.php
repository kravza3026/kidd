<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('notifications.notify_new_order', true);
        $this->migrator->add('notifications.notify_new_inquiry', true);
        $this->migrator->add('notifications.notify_new_application', true);
        $this->migrator->add('notifications.notify_low_stock', true);
    }
};

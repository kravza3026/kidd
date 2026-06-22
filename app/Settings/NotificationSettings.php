<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

/**
 * Toggles for which admin notifications are sent. Consulted by AdminAudience so a disabled
 * type produces no recipients (and therefore no database row or broadcast).
 */
class NotificationSettings extends Settings
{
    public bool $notify_new_order = true;

    public bool $notify_new_inquiry = true;

    public bool $notify_new_application = true;

    public bool $notify_low_stock = true;

    public static function group(): string
    {
        return 'notifications';
    }
}

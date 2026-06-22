<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

/**
 * Store-wide profile shown on the storefront (footer social links + contact details).
 * Edited from the admin Settings screen; read by the storefront with a config fallback.
 */
class StoreSettings extends Settings
{
    public ?string $facebook_url = null;

    public ?string $instagram_url = null;

    public ?string $messenger_url = null;

    public ?string $youtube_url = null;

    public ?string $tiktok_url = null;

    public ?string $contact_phone = null;

    public ?string $contact_email = null;

    public static function group(): string
    {
        return 'store';
    }
}

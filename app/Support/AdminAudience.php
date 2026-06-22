<?php

namespace App\Support;

use App\Models\User;
use App\Settings\NotificationSettings;
use Illuminate\Support\Collection;

/**
 * Resolves which staff users should receive an admin notification for a given concern.
 * Returns an empty set when the concern is disabled in NotificationSettings, so no row is
 * stored and nothing is broadcast.
 */
class AdminAudience
{
    /**
     * @return Collection<int, User>
     */
    public static function for(string $concern): Collection
    {
        if (! self::enabled($concern)) {
            return collect();
        }

        $roles = match ($concern) {
            'order' => ['admin', 'manager', 'seller'],
            'application' => ['admin', 'manager', 'hr'],
            'inquiry', 'stock' => ['admin', 'manager'],
            default => ['admin'],
        };

        return User::query()
            ->whereHas('roles', fn ($q) => $q->whereIn('name', $roles))
            ->get();
    }

    protected static function enabled(string $concern): bool
    {
        $settings = app(NotificationSettings::class);

        return match ($concern) {
            'order' => $settings->notify_new_order,
            'inquiry' => $settings->notify_new_inquiry,
            'application' => $settings->notify_new_application,
            'stock' => $settings->notify_low_stock,
            default => true,
        };
    }
}

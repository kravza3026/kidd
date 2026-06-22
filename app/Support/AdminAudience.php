<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Collection;

/**
 * Resolves which staff users should receive an admin notification for a given concern.
 */
class AdminAudience
{
    /**
     * @return Collection<int, User>
     */
    public static function for(string $concern): Collection
    {
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
}

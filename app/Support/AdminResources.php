<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Central registry of admin-managed resources and the permission actions each supports.
 *
 * This is the single source of truth consumed by the permission seeder, the roles &
 * permissions management UI, and the resource policies, so a new admin module only needs
 * to be registered here once.
 */
class AdminResources
{
    /**
     * Policy abilities every managed resource supports.
     *
     * @var list<string>
     */
    public const ACTIONS = ['viewAny', 'view', 'create', 'update', 'delete'];

    /**
     * Managed resource key => human label.
     *
     * @var array<string, string>
     */
    public const RESOURCES = [
        // Core commerce
        'product' => 'Products',
        'category' => 'Categories',
        'order' => 'Orders',
        'customer' => 'Customers',
        // Inventory
        'warehouse' => 'Warehouses',
        'inventory' => 'Inventory',
        // Catalog taxonomy
        'brand' => 'Brands',
        'gender' => 'Genders',
        'season' => 'Seasons',
        'fabric' => 'Fabrics',
        'color' => 'Colors',
        'size' => 'Sizes',
        'careInstruction' => 'Care instructions',
        'tag' => 'Tags',
        // Content & ops
        'vacancy' => 'Vacancies',
        'vacancyApplication' => 'Vacancy applications',
        'contactInquire' => 'Contact inquiries',
        'region' => 'Regions',
        'city' => 'Cities',
        'location' => 'Locations',
        'company' => 'Companies',
        // Platform
        'user' => 'Users & staff',
        'role' => 'Roles & permissions',
        'setting' => 'Settings',
        'audit' => 'Audit log',
    ];

    /**
     * Resource keys that govern the platform itself (kept out of non-admin roles by default).
     *
     * @var list<string>
     */
    public const PLATFORM_RESOURCES = ['user', 'role', 'setting', 'company', 'audit'];

    /**
     * All permission names across every resource and action.
     *
     * @return list<string>
     */
    public static function permissions(): array
    {
        $permissions = [];

        foreach (array_keys(self::RESOURCES) as $resource) {
            foreach (self::ACTIONS as $action) {
                $permissions[] = "{$resource}.{$action}";
            }
        }

        return $permissions;
    }

    /**
     * Permission names for a subset of resource keys.
     *
     * @param  list<string>  $resources
     * @return list<string>
     */
    public static function permissionsFor(array $resources): array
    {
        return array_values(array_filter(
            self::permissions(),
            fn (string $permission): bool => in_array(Str::before($permission, '.'), $resources, true),
        ));
    }

    /**
     * Permission names grouped by resource key, for rendering the permission matrix.
     *
     * @return array<string, list<string>>
     */
    public static function grouped(): array
    {
        $grouped = [];

        foreach (array_keys(self::RESOURCES) as $resource) {
            $grouped[$resource] = array_map(
                fn (string $action): string => "{$resource}.{$action}",
                self::ACTIONS,
            );
        }

        return $grouped;
    }
}

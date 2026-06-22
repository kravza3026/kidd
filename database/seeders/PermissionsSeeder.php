<?php

namespace Database\Seeders;

use App\Support\AdminResources;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the full permission matrix and assign sensible subsets to each role.
     *
     * Runs after RolesSeeder. The `admin` role bypasses every check via Gate::before,
     * but is still granted all permissions explicitly so the roles UI reflects reality.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (AdminResources::permissions() as $name) {
            Permission::findOrCreate($name, 'web');
        }

        $this->assign('admin', AdminResources::permissions());

        // Managers run the shop but not the platform (users, roles, settings, companies).
        $this->assign('manager', $this->except(AdminResources::PLATFORM_RESOURCES));

        // Sellers handle orders, customers and read the catalog/inventory.
        $this->assign('seller', array_merge(
            AdminResources::permissionsFor(['order', 'customer']),
            $this->readOnly(['product', 'category', 'inventory', 'warehouse']),
        ));

        // Accountants review orders and companies (read-only).
        $this->assign('accountant', $this->readOnly(['order', 'customer', 'company']));

        // HR manages vacancies, applications and contact inquiries.
        $this->assign('hr', AdminResources::permissionsFor([
            'vacancy', 'vacancyApplication', 'contactInquire',
        ]));

        // Drivers only need to see orders for delivery.
        $this->assign('driver', $this->readOnly(['order']));
    }

    /**
     * @param  list<string>  $permissions
     */
    private function assign(string $role, array $permissions): void
    {
        Role::findOrCreate($role, 'web')->syncPermissions($permissions);
    }

    /**
     * All permissions except those of the given resource keys.
     *
     * @param  list<string>  $resources
     * @return list<string>
     */
    private function except(array $resources): array
    {
        return array_values(array_diff(
            AdminResources::permissions(),
            AdminResources::permissionsFor($resources),
        ));
    }

    /**
     * Only the viewAny/view permissions for the given resource keys.
     *
     * @param  list<string>  $resources
     * @return list<string>
     */
    private function readOnly(array $resources): array
    {
        $permissions = [];

        foreach ($resources as $resource) {
            $permissions[] = "{$resource}.viewAny";
            $permissions[] = "{$resource}.view";
        }

        return $permissions;
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Create the application roles. Permissions are attached by PermissionsSeeder,
     * which runs immediately after this seeder.
     */
    public function run(): void
    {
        $roles = ['admin', 'manager', 'accountant', 'hr', 'seller', 'driver'];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role, 'guard_name' => 'web'],
                ['company_id' => 1],
            );
        }
    }
}

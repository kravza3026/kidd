<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
            'company_id' => 1, //TODO change this to the company_id'
        ]);

        $manager = Role::create([
            'name' => 'manager',
            'company_id' => 1, //TODO change this to the company_id'
        ]);

        $accountant = Role::create([
            'name' => 'accountant',
            'company_id' => 1, //TODO change this to the company_id'
        ]);

        $hr = Role::create([
            'name' => 'hr',
            'company_id' => 1, //TODO change this to the company_id'
        ]);

        $seller = Role::create([
            'name' => 'seller',
            'company_id' => 1, //TODO change this to the company_id'
        ]);

        $driver = Role::create([
            'name' => 'driver',
            'company_id' => 1, //TODO change this to the company_id'
        ]);


        // User permissions
        Permission::create([
            'name' => 'user.viewAny'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'user.create'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'user.store'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'user.show'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'user.update'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'user.delete'
        ])->syncRoles([$admin]);

        // Family permissions
        Permission::create([
            'name' => 'family.viewAny'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'family.create'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'family.store'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'family.show'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'family.update'
        ])->syncRoles([$admin]);

        Permission::create([
            'name' => 'family.delete'
        ])->syncRoles([$admin]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Farm permissions
            'view farms',
            'create farms',
            'edit farms',
            'delete farms',
            'approve farms',

            // Wool batch permissions
            'view wool batches',
            'create wool batches',
            'edit wool batches',
            'delete wool batches',

            // Processing unit permissions
            'view processing units',
            'create processing units',
            'edit processing units',
            'delete processing units',

            // Batch process permissions
            'view batch processes',
            'create batch processes',
            'edit batch processes',
            'delete batch processes',

            // Distributor permissions
            'view distributors',
            'create distributors',
            'edit distributors',
            'delete distributors',

            // Shipment permissions
            'view shipments',
            'create shipments',
            'edit shipments',
            'delete shipments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'farm_owner']);
        $role->givePermissionTo([
            'view farms',
            'create farms',
            'edit farms',
            'view wool batches',
            'create wool batches',
            'edit wool batches',
            'view processing units',
            'view batch processes',
            'view shipments',
        ]);

        $role = Role::create(['name' => 'processor']);
        $role->givePermissionTo([
            'view processing units',
            'create processing units',
            'edit processing units',
            'view batch processes',
            'create batch processes',
            'edit batch processes',
            'view wool batches',
            'view shipments',
        ]);

        $role = Role::create(['name' => 'distributor']);
        $role->givePermissionTo([
            'view distributors',
            'create distributors',
            'edit distributors',
            'view shipments',
            'create shipments',
            'edit shipments',
            'view wool batches',
        ]);
    }
}
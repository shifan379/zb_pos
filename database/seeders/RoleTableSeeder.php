<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Super Admin',
            'Admin',
            'Manager',
            'Accountant',
            'Cashier',
            'Employee'
        ];

        echo '-------------------------' . "\n";
        echo '------------Role Seeding-------------' . "\n";

        foreach ($roles as $roleName) {
            // Create role if not exists
            $role = Role::firstOrCreate(['name' => $roleName]);
            echo "-------Role Added => $roleName ------------------" . "\n";

            // Assign all permissions only to Super Admin
            if ($roleName === 'Super Admin') {
                $permissions = Permission::all();
                foreach ($permissions as $permission) {
                    $role->givePermissionTo($permission->name);
                    echo "-----Added permission => {$permission->name} ---------" . "\n";
                }
            }
        }

        echo "-----Role seeding Completed-----------" . "\n";
        echo '-------------------------' . "\n";
    }
}

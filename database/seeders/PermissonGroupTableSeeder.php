<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;

class PermissonGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissonGroups = [
            [
                'name' => 'Dashboard'
            ],
            [
                'name' => 'Inventory'
            ],
            [
                'name' => 'Stock'
            ],
            [
                'name' => 'Sales'
            ],
            [
                'name' => 'Promo'
            ],
            [
                'name' => 'Purchases'
            ],
            [
                'name' => 'Finance_Accounts'
            ],
            [
                'name' => 'Peoples'
            ],
            [
                'name' => 'HRM',
            ],
            [
                'name' => 'Reports'
            ],
            [
                'name' => 'CMS'
            ],
            [
                'name' => 'User Management'
            ],
            [
                'name' => 'Pages'
            ],
            [
                'name' => 'Settings'
            ]
        ];

        echo '-------------------------' . "\n";
        echo '------------Permission Group Seeding-------------' . "\n";

        foreach ($permissonGroups as $key => $value) {
            $permissonGroup = new PermissionGroup;
            $permissonGroup->name = $value['name'];
            $permissonGroup->save();
            echo "-----Permission Group Name=>$permissonGroup->name-----------" . "\n";

        }
        echo '------------Permission Group Seeding Completed-------------' . "\n";

    }
}

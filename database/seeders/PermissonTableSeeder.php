<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissons =
        [
            [
                'name'                => 'Dashboard',
                'permission_group_id' => PermissionGroup::where('name', 'Dashboard')->first()->id
            ],
            [
                'name'                => 'Inventory Create',
                'permission_group_id' => PermissionGroup::where('name', 'Inventory')->first()->id
            ],
            [
                'name'                => 'Inventory List',
                'permission_group_id' => PermissionGroup::where('name', 'Inventory')->first()->id
            ],
            [
                'name'                => 'Inventory Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Inventory')->first()->id
            ],
            [
                'name'                => 'Inventory Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Inventory')->first()->id
            ],
            [
                'name'                => 'Stock Create',
                'permission_group_id' => PermissionGroup::where('name', 'Stock')->first()->id
            ],
            [
                'name'                => 'Stock List',
                'permission_group_id' => PermissionGroup::where('name', 'Stock')->first()->id
            ],
            [
                'name'                => 'Stock Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Stock')->first()->id
            ],
            [
                'name'                => 'Stock Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Stock')->first()->id
            ],
            [
                'name'                => 'Sales Create',
                'permission_group_id' => PermissionGroup::where('name', 'Sales')->first()->id
            ],
            [
                'name'                => 'Sales List',
                'permission_group_id' => PermissionGroup::where('name', 'Sales')->first()->id
            ],
            [
                'name'                => 'Sales Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Sales')->first()->id
            ],
            [
                'name'                => 'Sales Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Sales')->first()->id
            ],
            [
                'name'                => 'Promo Create',
                'permission_group_id' => PermissionGroup::where('name', 'Promo')->first()->id
            ],
            [
                'name'                => 'Promo List',
                'permission_group_id' => PermissionGroup::where('name', 'Promo')->first()->id
            ],
            [
                'name'                => 'Promo Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Promo')->first()->id
            ],
            [
                'name'                => 'Promo Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Promo')->first()->id
            ],
            [
                'name'                => 'Purchases Create',
                'permission_group_id' => PermissionGroup::where('name', 'Purchases')->first()->id
            ],
            [
                'name'                => 'Purchases List',
                'permission_group_id' => PermissionGroup::where('name', 'Purchases')->first()->id
            ],
            [
                'name'                => 'Purchases Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Purchases')->first()->id
            ],
            [
                'name'                => 'Purchases Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Purchases')->first()->id
            ],
            [
                'name'                => 'Finance_Accounts Create',
                'permission_group_id' => PermissionGroup::where('name', 'Finance_Accounts')->first()->id
            ],
            [
                'name'                => 'Finance_Accounts List',
                'permission_group_id' => PermissionGroup::where('name', 'Finance_Accounts')->first()->id
            ],
            [
                'name'                => 'Finance_Accounts Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Finance_Accounts')->first()->id
            ],
            [
                'name'                => 'Finance_Accounts Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Finance_Accounts')->first()->id
            ],
            [
                'name'                => 'Peoples Create',
                'permission_group_id' => PermissionGroup::where('name', 'Peoples')->first()->id
            ],
            [
                'name'                => 'Peoples List',
                'permission_group_id' => PermissionGroup::where('name', 'Peoples')->first()->id
            ],
            [
                'name'                => 'Peoples Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Peoples')->first()->id
            ],
            [
                'name'                => 'Peoples Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Peoples')->first()->id
            ],
            [
                'name'                => 'HRM Create',
                'permission_group_id' => PermissionGroup::where('name', 'HRM')->first()->id
            ],
            [
                'name'                => 'HRM List',
                'permission_group_id' => PermissionGroup::where('name', 'HRM')->first()->id
            ],
            [
                'name'                => 'HRM Edit',
                'permission_group_id' => PermissionGroup::where('name', 'HRM')->first()->id
            ],
            [
                'name'                => 'HRM Delete',
                'permission_group_id' => PermissionGroup::where('name', 'HRM')->first()->id
            ],
            [
                'name'                => 'Reports Create',
                'permission_group_id' => PermissionGroup::where('name', 'Reports')->first()->id
            ],
            [
                'name'                => 'Reports List',
                'permission_group_id' => PermissionGroup::where('name', 'Reports')->first()->id
            ],
            [
                'name'                => 'Reports Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Reports')->first()->id
            ],
            [
                'name'                => 'Reports Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Reports')->first()->id
            ],
                        [
                'name'                => 'CMS Create',
                'permission_group_id' => PermissionGroup::where('name', 'CMS')->first()->id
            ],
            [
                'name'                => 'CMS List',
                'permission_group_id' => PermissionGroup::where('name', 'CMS')->first()->id
            ],
            [
                'name'                => 'CMS Edit',
                'permission_group_id' => PermissionGroup::where('name', 'CMS')->first()->id
            ],
            [
                'name'                => 'CMS Delete',
                'permission_group_id' => PermissionGroup::where('name', 'CMS')->first()->id
            ],
            [
                'name'                => 'User Management Create',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name'                => 'User Management List',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name'                => 'User Management Edit',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name'                => 'User Management Delete',
                'permission_group_id' => PermissionGroup::where('name', 'User Management')->first()->id
            ],
            [
                'name'                => 'Pages Create',
                'permission_group_id' => PermissionGroup::where('name', 'Pages')->first()->id
            ],
            [
                'name'                => 'Pages List',
                'permission_group_id' => PermissionGroup::where('name', 'Pages')->first()->id
            ],
            [
                'name'                => 'Pages Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Pages')->first()->id
            ],
            [
                'name'                => 'Pages Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Pages')->first()->id
            ],
            [
                'name'                => 'Settings Create',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name'                => 'Settings List',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name'                => 'Settings Edit',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ],
            [
                'name'                => 'Settings Delete',
                'permission_group_id' => PermissionGroup::where('name', 'Settings')->first()->id
            ]


        ];

        echo '-------------------------' . "\n";
        echo '------------Permission Seeding-------------' . "\n";

        foreach ($permissons as $key => $value) {
            $permisson = new Permission;
            $permisson->name = $value['name'];
            $permisson->permission_group_id = $value['permission_group_id'];

            $permisson->save();
            echo "-----Permission Name=>$permisson->name-----------" . "\n";

        }
        echo '------------Permission Seeding Completed-------------' . "\n";

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo '-------------------------' . "\n";
        echo '------------User Seeding-------------' . "\n";

        $user = new User;
        $user->name = 'Super Admin';
        $user->email = 'superadmin@gmail.com';
        $user->emp_id = '1';
        $user->role = 'Super Admin';

        $user->phone = '0754105429';
        $user->password = Hash::make('password');
        $user->save();

        echo '--------User Created-----------------' . "\n";
        echo '----------------------------------' . "\n";
        echo '------------Assiging Super Admin role to =>' . $user->email . '-------------' . "\n";

        $user->assignRole('Super Admin');
        echo '-------Assinging Super Admin role to =>' . $user->email . ' Completed------ ' . "\n";

        echo '----User Seeding Completed-----' . "\n";

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $super_admin = new User();
        $super_admin->name = "Wai Linn Kyaw";
        $super_admin->email = "wailinnkyaw03@gmail.com";
        $super_admin->password = Hash::make('12345678');
        $super_admin->save();

        $super_admin->assignRole('super admin');

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = Hash::make('12345678');
        $admin->save();
        $admin->assignRole('admin');

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@gmail.com';
        $user->password = Hash::make('12345678');
        $user->save();
        $user->assignRole('user');
    }
}

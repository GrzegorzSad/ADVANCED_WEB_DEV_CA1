<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $role_admin = Role::where('name', 'admin')->first();

        $admin = new User();
        $admin->name = 'Greg';
        $admin->email = 'greg@example.com';
        $admin->password = 'password'; //Hash::make('password');
        $admin->save();

        $admin->roles()->attach($role_admin);

        // Create a regular user
        $role_user = Role::where('name', 'user')->first();

        $user = new User();
        $user->name = 'Joe';
        $user->email = 'joe@example.com';
        $user->password = 'password'; //Hash::make('password');
        $user->save();

        $user->roles()->attach($role_user);
    }
}


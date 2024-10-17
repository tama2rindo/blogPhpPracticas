<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Find a user by email
        $user = User::where('email', 'test@test.com')->first();

        // Find the admin role
        $adminRole = Role::where('name', 'admin')->first();
        if($user && $adminRole){
            $user->role()->associate($adminRole);      // Assign the role to the user
            $user->save();
        }
    }
}

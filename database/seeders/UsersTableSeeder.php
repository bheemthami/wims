<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Clear pivot first to avoid orphaned records
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();
        DB::table('users')->truncate();

        $userDetails = [
            'first_name' => 'Admin',
            'last_name' => 'Last',
            'email' => 'demo@gmail.com',
            'password' => 'demo@123'
        ];

        // Register and activate user via Sentinel
        $user = Sentinel::registerAndActivate($userDetails);

        // Attach admin role with null check
        $role = Sentinel::findRoleBySlug('admin');

        if ($role && $user) {
            $role->users()->attach($user);
        }
    }
}

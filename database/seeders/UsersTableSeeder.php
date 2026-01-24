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

        DB::table('users')->truncate();
        $userDetails = [
            'first_name' => 'Admin',
            'last_name' => 'Last',
            'email' => 'demo@gmail.com',
            'password' => 'demo@123'
        ];

        // sentinel user register and activation
        $user = Sentinel::registerAndActivate($userDetails);
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);
    }
}

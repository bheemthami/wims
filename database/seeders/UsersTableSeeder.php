<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

use DB;
use Sentinel;

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
            'email' => 'admin@gmail.com',
            'password' => 'password'
        ];

        // sentinel user register and activation
        $user = Sentinel::registerAndActivate($userDetails);
        $role = Sentinel::findRoleBySlug('admin');
        $role->users()->attach($user);
    }
}
<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermissions = [
            'rolls.index' => true,
            'rolls.create' => true,
            'rolls.store' => true,
            'rolls.edit' => true,
            'rolls.update' => true,
            'rolls.delete' => true,
        ];

        $userPermissions = [
            'posts.index' => true,
            'posts.create' => true,
            'posts.store' => true,
            'posts.edit' => true,
            'posts.update' => true,
            'posts.delete' => true,
        ];

        $roles = [
            [
                'name' => 'Admin',
                'slug' => Str::slug('Admin'),
                'permissions' => json_encode($adminPermissions)

            ],
            [
                'name' => 'User',
                'slug' => Str::slug('User'),
                'permissions' => json_encode($userPermissions)

            ]
        ];

        Role::truncate();
        foreach ($roles as $role) {
            Role::create($role);
        }

        $role = Sentinel::findRoleBySlug('admin');
        $user = Sentinel::findById(1);
        $role->users()->attach($user);
    }
}

<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\DB;
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
            // role permissions
            'roles.index' => true,
            'roles.create' => true,
            'roles.store' => true,
            'roles.view' => true,
            'roles.edit' => true,
            'roles.update' => true,
            'roles.delete' => true,
            // user permissions
            'users.index' => true,
            'users.create' => true,
            'users.store' => true,
            'users.view' => true,
            'users.edit' => true,
            'users.update' => true,
            'users.delete' => true,
            // role permissions
            'role-permissions.create' => true,
            'role-permissions.store' => true,
            'role-permissions.view' => true,
            'role-permissions.edit' => true,
            'role-permissions.update' => true,
            'role-permissions.delete' => true,
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
                'permissions' => $adminPermissions

            ],
            [
                'name' => 'User',
                'slug' => Str::slug('User'),
                'permissions' => $userPermissions

            ]
        ];

        // clear pivot table records
        DB::table('role_users')->truncate();
        // clear roles table records
        Role::truncate();

        //
        foreach ($roles as $role) {
            Role::create($role);
        }

        $role = Sentinel::findRoleBySlug('admin');
        $user = Sentinel::findById(1);

        if ($role && $user) {
            $role->users()->attach($user);
        }
    }
}

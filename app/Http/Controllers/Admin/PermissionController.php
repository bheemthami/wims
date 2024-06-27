<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PermissionRequest;
use Sentinel;
use Str;
use Validator;

class PermissionController extends Controller
{
    public function createUserPermissions(Request $request,$user_id)
    {
        $user = Sentinel::findById($user_id);
        return view('permissions.user_partial.create');
    }

    public function storeUserPermissions(Request $request)
    {
// code...
    }


    public function editUserPermissions($user_id)
    {
        $user = Sentinel::findById($user_id);
        return view('permissions.user_partial.create');
    }

    public function updateUserPermissions(Request $request,$user_id)
    {
    // code...
    }

    public function createRolePermissions(Request $request,$role_id)
    {

        try {

            if(Sentinel::hasAccess('role-permissions.create')){

                $role = Sentinel::findRoleById($role_id);
                // fetch from helper
                $lists = sidebarlist();

                return view('admin.permissions.role_partial.create',compact('role','lists'));
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }

    }

    public function storeRolePermissions(PermissionRequest $request,$role_id)
    {
        try {

            if(Sentinel::hasAccess('role-permissions.store')){


                $role = Sentinel::findRoleById($role_id);
                $permissions = [];
                $menu_perms = [];
                $menus = $request->menus;
                $perms = $request->permissions;


                if ($menus) {
                    foreach ($menus as  $menu_key => $child ) {
                        if (is_array($child)) {
                            foreach($child as $child_key => $val){
                                $menu_perms[Str::slug($menu_key).'.'.Str::slug($child_key)] = true;
                            }
                        }else{
                            $menu_perms[Str::slug($menu_key).'.'.Str::slug('index')] = true; 
                        }

                    }
                }

                if ($perms) {
                    foreach ($perms as  $parent => $children ) {

                        foreach($children as $child => $val){
                            $permissions[Str::slug($parent).'.'.Str::slug($child)] = true;
                        }
                    }
                }

                if ($menu_perms) {
                    $merged_perms = $menu_perms;
                }

                if ($permissions) {
                    $merged_perms = $permissions;
                }

                if ($menu_perms && $permissions) {
                    $merged_perms = array_merge($menu_perms,$permissions);
                }

                $role->permissions = $merged_perms;
                $role->save();
                return redirect()->route('roles.index')->with('success','Permissions granted successfully.');

            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }


    public function editRolePermissions($role_id)
    {

        try {

            if(Sentinel::hasAccess('role-permissions.edit')){
                if ($role_id){
                    $role = Sentinel::findRoleById($role_id);

                    $lists = sidebarlist();

                    $existing_permissions = $role->permissions;

                }

                return view('admin.permissions.role_partial.edit',compact('role','existing_permissions','lists'));
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('roles.index')->with('error','Oops! Something went wrong.');
        }

    }

    public function showRolePermissions($role_id)
    {
        try {

            if(Sentinel::hasAccess('role-permissions.view')){

                if ($role_id){
                    $role = Sentinel::findRoleById($role_id);
                    $lists = sidebarlist();
                    $existing_permissions = $role->permissions;
                }
                return view('admin.permissions.role_partial.view',compact('role','existing_permissions','lists'));
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('roles.index')->with('error','Oops! Something went wrong.');
        }
    }


    public function updateRolePermissions(PermissionRequest $request,$role_id)
    {
        try {
            if(Sentinel::hasAccess('role-permissions.update')){
                $role = Sentinel::findRoleById($role_id);
                $permissions = [];
                $menu_perms = [];
                $menus = $request->menus;
                $perms = $request->permissions;
                if ($menus) {
                    foreach ($menus as  $menu_key => $child ) {
                        if (is_array($child)) {
                            foreach($child as $child_key => $val){
                                $menu_perms[Str::slug($menu_key).'.'.Str::slug($child_key)] = true;
                            }
                        }else{
                            $menu_perms[Str::slug($menu_key).'.'.Str::slug('index')] = true; 
                        }

                    }
                }

                if ($perms) {
                    foreach ($perms as  $parent => $children ) {

                        foreach($children as $child => $val){
                            $permissions[Str::slug($parent).'.'.Str::slug($child)] = true;
                        }
                    }
                }

                if ($menu_perms) {
                    $merged_perms = $menu_perms;
                }

                if ($permissions) {
                    $merged_perms = $permissions;
                }

                if ($menu_perms && $permissions) {
                    $merged_perms = array_merge($menu_perms,$permissions);
                }

                $role->permissions = $merged_perms;
                $role->save();
                return redirect()->route('roles.index')->with('success','Permissions granted successfully.');
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }

    public function destroy($role_id = null, $user_id = null)
    {        
        try {

            if(Sentinel::hasAccess('role-permissions.delete')){

                if ($role_id) {
                    $role = Sentinel::findRoleById($role_id);
                    $role->permissions = null;
                    $role->save();
                }

                if ($user_id) {
                    $user = Sentinel::findUserById($user_id);
                    $user->permissions = null;
                    $user->save();
                }

                return redirect()->route('roles.index')->with('success','Permissions cleared successfully');

            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('roles.index')->with('error','Oops! Something went wrong.');
        }
    }
}

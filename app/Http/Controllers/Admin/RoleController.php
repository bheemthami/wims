<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;

use App\Http\Requests\RoleRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;
use Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if (Sentinel::hasAccess('roles.index')) {

                $roles = Role::paginate();
                return view('admin.roles.index', compact('roles'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            if (Sentinel::hasAccess('roles.create')) {
                return view('admin.roles.create');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try {

            if (Sentinel::hasAccess('roles.store')) {
                $roleDetails = $request->only('name');
                $roleDetails['slug'] = str_slug($request->name);

                Role::create($roleDetails);
                return redirect('admin/roles')->with('success', 'Created Successfully!!!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            if (Sentinel::hasAccess('roles.view')) {
                dd('DEvelopers are here.....');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            if (Sentinel::hasAccess('roles.edit')) {

                $role = Role::findOrFail($id);
                return view('admin.roles.edit', compact('role'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try {

            if (Sentinel::hasAccess('roles.update')) {
                $role = Role::find($id);
                $roleDetails = $request->only('name');
                $roleDetails['slug'] = str_slug($request->name);
                $role->update($roleDetails);
                return redirect('admin/roles')->with('success', 'Updated Successfully!!!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            if (Sentinel::hasAccess('roles.delete')) {
                $role = Role::find($id);

                $users = DB::table('role_users')->where(['role_id' => $role->id])->get();

                if (count($users) == 0) {
                    $role->delete();
                    return redirect('admin/roles')->with('success', 'Deleted Successfully!!!');
                }
                return redirect('admin/roles')->with('warning', 'Deletion not allowed!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}

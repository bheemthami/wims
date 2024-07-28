<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use App\Managers\RoleManager;

use App\Http\Requests\UserRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use DB;
use Exception;

class UserController extends Controller
{

    protected $roleManager;

    public function __construct(RoleManager $roleManager)
    {
        $this->roleManager = $roleManager;
    }

    public function index()
    {
        try {

            if (Sentinel::hasAccess('users.index')) {
                $setting = defaultSetting();
                $users = User::paginate($setting->per_page);
                return view('admin.user.index', compact('users'));
            }
            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/dashboard')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('users.create')) {

                $roleOptions = $this->roleManager->dropdown();
                return view('admin.user.create', compact('roleOptions'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/dashboard')->with('error', 'Oops! Something went wrong.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {

            if (Sentinel::hasAccess('users.store')) {
                $userDetails = $request->only('first_name', 'last_name', 'email', 'password');
                // user registation bu User model
                // $user = User::create($userDetails);
                // sentinel user register and activation
                $user = Sentinel::registerAndActivate($userDetails);
                $role = Sentinel::findRoleById($request->role_id);
                $role->users()->attach($user);
                return redirect('admin/users')->with('success', 'Successfully created.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/dashboard')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('users.view')) {

                return redirect('admin/users')->with('success', 'Successfully created.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect('admin/dashboard')->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('users.edit')) {
                $user = User::find($id);

                $userRole = DB::table('role_users')->where(['user_id' => $id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                $roleOptions = $this->roleManager->dropdown();
                return view('admin.user.edit', compact('user', 'roleOptions', 'role'));
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
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
    public function update(Request $request, $id)
    {
        try {

            if (Sentinel::hasAccess('users.update')) {
                $user = Sentinel::findById($id);
                $userDetails = $request->only('first_name', 'last_name', 'email');

                $user = Sentinel::update($user, $userDetails);
                return redirect('admin/users')->with('success', 'Successfully Updated.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
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

            if (Sentinel::hasAccess('users.delete')) {

                DB::beginTransaction();

                $user = Sentinel::findById($id);

                $userRole = DB::table('role_users')->where(['user_id' => $id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                if ($role->slug == 'admin') {
                    return redirect()->route('users.index')->with('warning', 'Admin user cannot be deleted');
                }

                $role->users()->detach($user);

                $user->delete();

                DB::commit();
                return redirect('admin/users')->with('success', 'Successfully Deleted.');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }


    public function restoreDefaultPassword($id)
    {
        try {
            if (Sentinel::hasAccess('users.restore-password')) {

                $user = Sentinel::findById($id);

                $user = Sentinel::findById($id);

                $userRole = DB::table('role_users')->where(['user_id' => $id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                if ($role->slug == 'admin') {
                    return redirect()->route('users.index')->with('warning', 'Admin user password cannot be restored');
                }

                $passwordDetails['password'] = bcrypt('password');
                $user->update($passwordDetails);
                return redirect()->route('users.index')->with('success', 'Default passpord restored Successfully!');
            }

            return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
}

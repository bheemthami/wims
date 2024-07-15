<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;

use App\User;


use App\Managers\CommonDataManager;
use App\Managers\LocalLevelTypeManager;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Exception;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $teacherManager;
    protected $commonDataManager;
    protected $localLevelTypeManager;

    function __construct(
        CommonDataManager $commonDataManager,
        LocalLevelTypeManager $localLevelTypeManager
    ) {
        $this->commonDataManager = $commonDataManager;
        $this->localLevelTypeManager = $localLevelTypeManager;
    }

    public function index()
    {
        try {


            if (Sentinel::hasAccess('profile.index')) {
                $user = Sentinel::getUser();

                $userRole = DB::table('role_users')->where(['user_id' => $user->id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);
                $profile = $user;
                return view('admin.profile.user.profile', compact('profile'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function edit($id)
    {
        try {

            if (Sentinel::hasAccess('profile.edit')) {

                $user = Sentinel::getUser();

                $userRole = DB::table('role_users')->where(['user_id' => $user->id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);
                $profile = $user;
                return view('admin.profile.user.edit', compact('profile'));
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }


    public function update(ProfileRequest $request, $id)
    {
        try {

            if (Sentinel::hasAccess('profile.update')) {
                $user = Sentinel::getUser();

                $userRole = DB::table('role_users')->where(['user_id' => $user->id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                $profileDetails = $request->only('first_name', 'last_name');
                $user = User::find($user->id);
                $user->update($profileDetails);

                return redirect()->route('profile.index')->with('success', 'Successfully updated!');
            } else {
                return redirect()->route('dashboard')->with('error', 'Oops! Permissions denied.');
            }
        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error', 'Oops! Something went wrong.');
        }
    }
}

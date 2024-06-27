<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProfileRequest;

use App\User;
use App\Models\Teacher;

use Sentinel;
use DB;

use App\Managers\TeacherManager;
use App\Managers\CommonDataManager;
use App\Managers\LocalLevelTypeManager;

class ProfileController extends Controller
{
    protected $teacherManager;
    protected $commonDataManager;
    protected $localLevelTypeManager;

    function __construct(TeacherManager $teacherManager,
        CommonDataManager $commonDataManager,
        LocalLevelTypeManager $localLevelTypeManager
    )
    {
        $this->teacherManager = $teacherManager;
        $this->commonDataManager = $commonDataManager;
        $this->localLevelTypeManager = $localLevelTypeManager;
    }

    public function index()
    {
        try {


            if(Sentinel::hasAccess('profile.index')){
                $user = Sentinel::getUser();

                $userRole = DB::table('role_users')->where(['user_id'=>$user->id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                if($role->slug == 'teachers' || $role->slug == 'teacher'){
                    $profile = $this->teacherManager->findByEmail($user->email);
                    return view('admin.profile.teacher.profile',compact('profile','user'));
                } else {
                    $profile = $user;
                    return view('admin.profile.user.profile',compact('profile'));
                }
            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }


    public function edit($id)
    {
        try {

            if(Sentinel::hasAccess('profile.edit')){

                $user = Sentinel::getUser();

                $userRole = DB::table('role_users')->where(['user_id'=>$user->id])->first();

                $role = Sentinel::findRoleById($userRole->role_id);

                if($role->slug == 'teachers' || $role->slug == 'teacher'){
                    $data['gender_options'] = $this->commonDataManager->genderDropdown(); 
                    $data['lltype_options'] = $this->localLevelTypeManager->dropdown();

                    $profile = $this->teacherManager->findByEmail($user->email);
                    return view('admin.profile.teacher.edit',compact('profile','data'));
                } else {
                    $profile = $user;
                    return view('admin.profile.user.edit',compact('profile'));
                }

            }else{
                return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
            }

        } catch (Exception $e) {
            return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
        }
    }


    public function update(ProfileRequest $request, $id)
    {
        try {

            if(Sentinel::hasAccess('profile.update')){
               $user = Sentinel::getUser();

               $userRole = DB::table('role_users')->where(['user_id'=>$user->id])->first();

               $role = Sentinel::findRoleById($userRole->role_id);

               if($role->slug == 'teachers' || $role->slug == 'teacher'){

                $profileDetails = $request->only('first_name','middle_name','last_name','dob','gender','district','local_level_type_id','municipality','ward_no','mobile','degree','major_subject');
                $teacher = $this->teacherManager->findByEmail($user->email);

                $teacher->update($profileDetails);
            } else {
                $profileDetails = $request->only('first_name','last_name');
                $user = User::find($user->id);
                $user->update($profileDetails);
            }

            return redirect()->route('profile.index')->with('success','Successfully updated!');
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('users.index')->with('error','Oops! Something went wrong.');
    }
}

}

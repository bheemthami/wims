<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


use Sentinel;
use DB;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $errors = [];


        $user = Sentinel::getUser();

        $userRole = DB::table('role_users')->where(['user_id'=>$user->id])->first();

        $role = Sentinel::findRoleById($userRole->role_id);

        if($role->slug == 'teachers' || $role->slug == 'teacher'){
            $errors['first_name'] = 'required|min:3|max:255';
            $errors['last_name'] = 'required|min:3|max:255';
        } else {
            $errors['first_name'] = 'required|min:3|max:255';
            $errors['middle_name'] = 'required|min:3|max:255';
            $errors['last_name'] = 'required|min:3|max:255';
            $errors['dob'] = 'required';
            $errors['gender'] = 'required';

            $errors['disctrict'] = 'required';
            $errors['local_level_type_id'] = 'required';
            $errors['municipality'] = 'required';
            $errors['ward_no'] = 'required|numeric';

            $errors['mobile'] = 'required|numeric|digits:10';
            $errors['degree'] = 'required|min:3|max:255';
            $errors['major_subject'] = 'required|min:3|max:255';

        }

        return $errors;
    }
}

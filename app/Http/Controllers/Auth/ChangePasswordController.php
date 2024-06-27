<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ChangePasswordRequest;

use App\User;
use Sentinel;

class ChangePasswordController extends Controller
{
        //
    public function changePasswordForm()
    {
        return view('auth.passwords.change_password');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Sentinel::getUser();

        $credentials['email'] = $user->email;
        $credentials['password'] = $request->old_password;

        if($user && Sentinel::authenticate($credentials)){
            $user->password = bcrypt($request->input('password'));
            $user->save();

            Sentinel::logout($user,true);

            return redirect()->route('login')->with('success','Password change successfully.');
        }else{
            return redirect()->route('change_password.create')->with('warning','Incorrect old password');
        }
    }
}

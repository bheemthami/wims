<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(LoginRequest $request)
    {


        $credentials = $request->only('email', 'password');

        // Check if user exists first
        $user = Sentinel::findByCredentials(['email' => $credentials['email']]);

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'No account found with this email address.'
                ]);
        }

        // Check password / authenticate
        $authenticated = Sentinel::authenticate($credentials);

        if (!$authenticated) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'The password is incorrect.'
                ]);
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Sentinel::logout();

        return redirect('/');
    }
}

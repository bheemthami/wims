<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function resetPassword($user, $password)
    {
        // Find user through Sentinel first, then update
        $sentinelUser = Sentinel::findById($user->id);
        // Update via Sentinel (handles hashing automatically)
        Sentinel::update($sentinelUser, ['password' => $password]);

        // Flush old session to avoid conflicts
        request()->session()->flush();
        request()->session()->regenerate();

        // Login the user via Sentinel
        Sentinel::login($sentinelUser, true);
    }

    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectTo);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\APIInterface;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends APIInterface
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        try {
            // Validate inputs
            $request->validate([
                'login' => 'required|string',
                'password' => 'required|string',
            ]);
        } catch (ValidationException $ex) {
            return $this->APIResponse(false, array_values($ex->errors())[0][0], null, 422);
        }

        // get some credentials
        $field = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request->merge([$field => $request->input('login')]);

        $credentials = $request->only(['email', 'password', 'username']);

        if (Auth::attempt($credentials)) {
            $token = Auth::issue();
            return $this->APIResponse(true, null, $token, 200);
        }

        return $this->APIResponse(false, "INVALID_CREDENTIALS", null, 401);
    }
}

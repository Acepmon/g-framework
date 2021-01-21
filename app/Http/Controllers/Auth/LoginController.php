<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Group;
use App\Config;
use Auth;
use Illuminate\Http\Request;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function redirectTo()
    {
        $path = '/home';

        if (Auth::user()->is_admin()) {
            $path = config('system.auth.adminRedirectPath');
        } else if (Auth::user()->is(8)) {
            $path = '/admin/profile/edit';
        } else if (Auth::user()->is_operator()) {
            $path = config('system.auth.operatorRedirectPath');
        } else if (Auth::user()->is_member()) {
            $path = config('system.auth.memberRedirectPath');
        } else {
            $path = config('system.auth.guestRedirectPath');
        }

        return $path;
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
}

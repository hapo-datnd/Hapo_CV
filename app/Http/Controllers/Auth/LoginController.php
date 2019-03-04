<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');

    }

    public function showUserLoginForm()
    {
        return view('auth.login');
    }

    public function userLogin(LoginRequest $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/home');
        }
        return back()->withInput($request->only('email'))->with('message', 'Sai mật khẩu hoặc tài khoản!');
    }

    public function logout()
    {
        if (Auth::guard('user')->check())
        {
            Auth::guard('user')->logout();
            return redirect()->route('home');
        }
        elseif(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin');
        }
    }
}

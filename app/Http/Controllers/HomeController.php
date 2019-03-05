<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth:user');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('user')->check())
        {
            return view('home');
        }
        elseif(!Auth::guard('user')->check())
        {
            return redirect()->route('user_login_form');
        }

    }

//    public function  indexAdmin()
//    {
//        $users = User::paginate(5);
//        $admins = Admin::paginate(5);
//        return view('admin',compact('users','admins'));
//    }
}

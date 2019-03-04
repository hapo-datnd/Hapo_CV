<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getChangePassword($id)
    {
        $user = User::findOrFail($id);
        if (Auth::guard('user')->check())
        {
            return view('auth/user/change_password',compact('user'));
        }
        elseif(!Auth::guard('user')->check())
        {
            return redirect()->route('user_login_form');
        }
    }

    public function patchChangePassword(ChangePasswordRequest $request,$id)
    {
        $user = User::findOrFail($id);
        $email = $user->email;
        if (Auth::guard('user')->attempt(['email' => $email, 'password' => $request->oldPassword]))
        {
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->route('home')->with('message','Bạn đã thay đổi mật khẩu thành công!');
        }
        else
        {
            return redirect()->route('user.change_password')->with('message','Bạn đã nhập sai mật khẩu cữ!');

        }
    }
}

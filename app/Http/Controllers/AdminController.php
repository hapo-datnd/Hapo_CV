<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Http\Requests\CreateAdminRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function  indexAdmin()
    {
        $users = User::paginate(5);
        $admins = Admin::paginate(5);
        return view('admin',compact('users','admins'));
    }

    public function index()
    {
//        $users = User::all();
//        return view('admin',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->check())
        {
            return view('auth/admin/add_admin');
        }
        elseif(!Auth::guard('admin')->check())
        {
            return redirect()->route('admin_login_form');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAdminRequest $request)
    {

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->type = 2;
        $admin->save();
        return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getChangePassword($id)
    {

        $admin = Admin::findOrFail($id);
        if (Auth::guard('admin')->check())
        {
            return view('auth/admin/change_password',compact('admin'));
        }
        elseif(!Auth::guard('admin')->check())
        {
            return redirect()->route('admin_login_form');
        }
    }

    public function patchChangePassword(ChangePasswordRequest $request,$id)
    {
        $admin = Admin::findOrFail($id);
        $email = $admin->email;
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $request->oldPassword]))
        {
            $admin->password = bcrypt($request->password);
            $admin->save();
            return redirect()->route('admin')->with('message','Bạn đã thay đổi mật khẩu thành công!');
        }
        else
        {
            return redirect()->route('admin.change_password')->with('message','Bạn đã nhập sai mật khẩu cữ!');

        }
    }

    public function patchUpdateTypeUser(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->type = $request->type;
        $user->save();
        return redirect()->route('admin')->with('message','Bạn đã thay đổi quyền của User thành công!');
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();
        return redirect()->route('admin');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin');
    }
}

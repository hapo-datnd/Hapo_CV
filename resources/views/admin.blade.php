<?php
/**
 * Created by PhpStorm.
 * User: Dat
 * Date: 3/1/2019
 * Time: 3:25 PM
 */
?>
@extends('layouts.app_admin')

@section('content')
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <div class="justify-content-center align-content-center ">
            <h1 class="card-header text-center">Admin-Manager</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Admin Name</td>
                    <td>Email</td>
                    <td>Phân Quyền</td>
                    <td>Hành Động</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                        <td>
                            @if($admin->type === $admin::SUPER_ADMIN )
                                Super Admin
                            @elseif($admin->type === $admin::ADMIN)
                                Admin
                            @endif
                        </td>
                        <td class="justify-content-center flex align-content-around">
                            {{--<a href="users/{{$admin->id}}/edit"><button type="button" class="btn btn-outline-primary">Save</button></a>--}}
                            @if($adminNow->type === $admin::SUPER_ADMIN)
                                @if($admin->type === $admin::ADMIN)
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myAdminModal{{$admin->id}}"> Delete </button>
                                    <div class="modal" id="myAdminModal{{$admin->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>Bạn có chắc chắc muốn <b>{{$admin->name}}</b> không ? </p>
                                                </div>
                                                <form action="{{route('admin.destroy_admin',$admin->id)}}" method="post">
                                                    @method('DELETE')
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <div class="message row justify-content-center">
                                                        <button type="submit" name="submit" class="btn btn-outline-danger">Xóa</button>
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Không Xóa</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $admins->links() }}
            </div>
        </div>
        <div class="justify-content-center align-content-center ">
            <h1 class="card-header text-center">User-Manager</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>User Name</td>
                    <td>Email</td>
                    <td>Phân Quyền</td>
                    <td>Hành Động</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {{--@if($user->type === 1)--}}
                            {{--Candidate--}}
                            {{--@elseif($user->type === 2)--}}
                            {{--HR--}}
                            {{--@endif--}}
                            <form action="{{ route('update_type_user',$user->id) }}" id="update-form{{$user->id}}" method="post">
                                @method('PATCH')
                                @csrf
                                <select class="form-control" name="type" id="type">
                                    <option @if($user->type === $user::CANDIDATE) selected="selected" @endif value="{{$user::CANDIDATE}}">Candidate</option>
                                    <option @if($user->type === $user::HR) selected="selected" @endif value="{{$user::HR}}">HR</option>
                                </select>
                            </form>
                        </td>
                        <td class="justify-content-center flex align-content-around">
                            <a  href="{{ route('update_type_user',$user->id) }}"
                                onclick="event.preventDefault();
                                    document.getElementById('update-form{{$user->id}}').submit();">
                                <button type="button" class="btn btn-outline-primary">Save</button>
                            </a>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#myModal{{$user->id}}"> Delete </button>
                            <div class="modal" id="myModal{{$user->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <p>Bạn có chắc chắc muốn <b>{{$user->name}}</b> không ? </p>
                                        </div>
                                        <form action="{{route('admin.destroy_user',$user->id)}}" method="post">
                                            @method('DELETE')
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <div class="message row justify-content-center">
                                                <button type="submit" name="submit" class="btn btn-outline-danger">Xóa</button>
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Không Xóa</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{ $users->links() }}
            </div>

        </div>

    </div>
@endsection

@section('top-right')
    @if(!Auth::guard('admin')->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin_login_form') }}">{{ __('Login') }}</a>
        </li>
    @elseif(Auth::guard('admin')->check())
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ $adminNow->name}} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if($adminNow->type === 1)
                <a class="dropdown-item" href="{{ route('create_admin') }}">{{ __('Create admin') }}</a>
                @endif
                <a class="dropdown-item" href="{{ route('admin.change_password',$adminNow->id) }}">{{ __('Change password') }}</a>
                <a class="dropdown-item" href="{{ route('logout_admin') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout_admin') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endif
@endsection

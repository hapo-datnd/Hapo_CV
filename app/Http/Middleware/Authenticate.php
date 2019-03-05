<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson())
        {
            if (Route::is('admin.*'))
            {
                return route('admin_login_form');
            }
            elseif (!Route::is('admin.*'))
            {
                return route('user_login_form');
            }

        }
//        if (!$request->expectsJson()) {
//            return route('admin_login_form');
////        }
    }
}

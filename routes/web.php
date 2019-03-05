<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

//Auth::routes();
//Register
Route::get('/register','Auth\RegisterController@showRegistrationForm')->middleware('guest:user')->name('register');
Route::post('/register','Auth\RegisterController@register')->middleware('guest:user');

//home
Route::get('/home', 'HomeController@index')->name('home');

//user_login
Route::get('/login','Auth\LoginController@showUserLoginForm')->middleware('guest:user')->name('user_login_form');
Route::post('/login','Auth\LoginController@userLogin')->middleware('guest:user')->name('user_login');

//user_logout
Route::post('/logout','Auth\LoginController@logout')->name('logout');

//user_change
Route::get('/change_password/{id}','UserController@getChangePassword')->name('user.change_password');
Route::patch('/change_password/{id}','UserController@patchChangePassword')->name('update_password_user');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@indexAdmin')->name('admin');
    Route::get('/login','Auth\AdminLoginController@showAdminLoginForm')->middleware('guest:admin')->name('admin_login_form');
    Route::post('/login','Auth\AdminLoginController@adminLogin')->middleware('guest:admin')->name('admin_login');
//    Route::get('/add','Auth\AdminLoginController@addAdmin')->name('add_admin');
    Route::get('/create','AdminController@create')->name('create_admin');
    Route::post('/store','AdminController@store')->name('store_admin');
    Route::delete('/destroy_user/{user}','AdminController@destroyUser')->name('admin.destroy_user');
    Route::delete('/destroy/{admin}','AdminController@destroy')->name('admin.destroy_admin');
    Route::get('/change_password/{id}','AdminController@getChangePassword')->name('admin.change_password');
    Route::patch('/change_password/{id}','AdminController@patchChangePassword')->name('update_password_admin');
    Route::patch('/update_type_user/{id}','AdminController@patchUpdateTypeUser')->name('update_type_user');
    Route::post('/logout','Auth\AdminLoginController@logout')->name('logout_admin');
});




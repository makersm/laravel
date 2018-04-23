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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [
    'as' => 'root',
    'uses' => 'WelcomeController@index'
]);

Route::get('home', [
    'as' => 'home',
    'uses' => 'WelcomeController@home'
]);

/* User Registration */
Route::group(['prefix' => 'auth', 'as' => 'user.'], function() {
    Route::get('register', [
        'as' => 'create',
        'uses' => 'Auth\LoginController@getRegister'
    ]);

    Route::get('register', [
        'as' => 'store',
        'uses' => 'Auth\LoginController@postRegister'
    ]);
});

Route::group(['prefix' => 'auth', 'as' => 'session.'], function() {
    Route::get('login', [
        'as' => 'create',
        'uses' => 'Auth\LoginController@getLogin'
    ]);

    Route::post('login', [
        'as' => 'store',
        'uses' => 'Auth\LoginController@postLogin'
    ]);

    Route::get('logout', [
        'as' => 'destroy',
        'uses' => 'Auth\LoginController@getLogout'
    ]);
});

/* Password Reminder */
Route::group(['prefix' => 'password'], function () {
    Route::get('remind', [
        'as'   => 'reminder.create',
        'uses' => 'Auth\ResetPasswordController@getEmail'
    ]);
    Route::post('remind', [
        'as'   => 'reminder.store',
        'uses' => 'Auth\ResetPasswordController@postEmail'
    ]);
    Route::get('reset/{token}', [
        'as'   => 'reset.create',
        'uses' => 'Auth\ResetPasswordController@getReset'
    ]);
    Route::post('reset', [
        'as'   => 'reset.store',
        'uses' => 'Auth\ResetPasswordController@postReset'
    ]);
});

Route::get('posts', [
    'as' => 'posts.index',
    'uses' => 'PostsController@index'
]);

Route::get('home', [
    'middleware' => 'auth',
    'uses' => 'UserController@index'
]);
//Route::get('post', [
//    'as' => 'pi',
//    'uses' => view('posts.index')
//]);

//Route::resource('posts', 'PostsController');

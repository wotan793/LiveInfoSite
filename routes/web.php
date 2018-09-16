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
Route::get('/', 'WelcomeController@index');
// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// イベント、ユーザー関連
Route::group(['middleware' => ['auth']], function () {
    Route::resource('events', 'EventsController', ['except' => ['show']]);
    Route::group(['prefix' => 'events/{id}'], function () {
        Route::post('participate', 'EventUserController@participate')->name('event.participate');
        Route::post('interested', 'EventUserController@interested')->name('event.interested');
        Route::delete('participate', 'EventUserController@unparticipate')->name('event.unparticipate');
        Route::delete('interested', 'EventUserController@uninterested')->name('event.uninterested');
    });
    Route::resource('users', 'UsersController');
});
Route::resource('events', 'EventsController', ['only' => ['show']]);

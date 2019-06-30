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
    return view('auth/login');
});

Auth::routes();

Route::get('auth/google/redirect', 'Auth\SocialAuthGoogleController@redirect');
Route::get('auth/google/callback', 'Auth\SocialAuthGoogleController@callback');
Route::get('auth/facebook/redirect', 'Auth\SocialAuthFacebookController@redirect');
Route::get('auth/facebook/callback', 'Auth\SocialAuthFacebookController@callback');

Route::get('/home', 'HomeController@index')->name('home');

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





Route::group(['prefix' => 'profile', 'middleware' => []], function () {
    Route::get('/', 'ProfileController@showProfilePage')->name('profile.showProfilePage');
});


//RegisApplicant

Route::post('register', ['as' => 'registerApplicant', 'uses' => 'Auth\LoginApplicantController@register']);
Route::post('/login/repass', 'Auth\LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::get('login', 'Auth\LoginApplicantController@showLoginForm')->name('showLogin');
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginApplicantController@postLogin']);
Route::get('logout', 'Auth\LoginApplicantController@getLogout')->name('logout');

//SetLangues
Route::get('language', 'LoginApplicantController@language');





// หน้าในของ User ที่ต้องการ auth ให้ใส่ที่นี้ครับ
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/home', function () {
        return view('index');
    });
});





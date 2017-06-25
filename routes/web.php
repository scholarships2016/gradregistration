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
    return view('index');
});

 

Route::group(['prefix' => 'profile', 'middleware' => []], function () {
    Route::get('/', 'ProfileController@showProfilePage')->name('profile.showProfilePage');
});


//loginApplicant
Route::get('/login', 'LoginApplicantController@showLoginPage')->name('showLoginApplicant');
Route::post('/login', 'LoginApplicantController@postLogin')->name('postLoginApplicant');
Route::post('/login/rePass', 'LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::post('/login/register', 'LoginApplicantController@register')->name('registerApplicant');



//Master

//Bank
Route::any('/bank/', 'BankController@show');
Route::get('/bank/bank_form/{id}', 'BankController@getForm');
Route::get('/bank/bank_form/', 'BankController@getForm');
Route::post('/bank/bank_form/', 'BankController@postForm');
Route::get('/bank/delete/{id}', 'BankController@delete');

//Nation
Route::any('/nation/', 'NationController@show');
Route::get('/nation/nation_form/{id}', 'NationController@getForm');
Route::get('/nation/nation_form/', 'NationController@getForm');
Route::post('/nation/nation_form/', 'NationController@postForm');
Route::get('/nation/delete/{id}', 'NationController@delete');

//Degree
Route::any('/degree/', 'DegreeController@show');
Route::get('/degree/degree_form/{id}', 'DegreeController@getForm');
Route::get('/degree/degree_form/', 'DegreeController@getForm');
Route::post('/degree/degree_form/', 'DegreeController@postForm');
Route::get('/degree/delete/{id}', 'DegreeController@delete');




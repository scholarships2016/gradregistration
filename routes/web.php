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

//RegisApplicant

Route::get('usersldap','Auth\LoginUserController@checkuserldap');
Route::post('register', ['as' => 'registerApplicant', 'uses' => 'Auth\LoginApplicantController@register']);
Route::post('/login/repass', 'Auth\LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::get('login', 'Auth\LoginApplicantController@showLoginForm')->name('showLogin');
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginApplicantController@postLogin']);
Route::get('logout', 'Auth\LoginApplicantController@getLogout')->name('logout');

//SetLangues just call function
Route::get('language', 'LoginApplicantController@language');

//Apply
Route::get('apply', 'ApplyController@showAnnouncement');
Route::get('apply/register/', 'ApplyController@managementRegister')->name('managementRegister');
 


// หน้าในของ User ที่ต้องการ auth ให้ใส่ที่นี้ครับ
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/home', function () {
        return view('index');
    });
});


Route::group(['prefix' => 'profile', 'middleware' => []], function () {
    Route::get('/', 'ProfileController@showProfilePage')->name('profile.showProfilePage');
    Route::post('/doSavePersInfo', 'ProfileController@doSavePersonalInfomation')->name('profile.doSavePersInfo');
    Route::post('/doSavePretAddr', 'ProfileController@doSavePresentAddress')->name('profile.doSavePretAddr');
    Route::post('/doSaveKnowSkill', 'ProfileController@doSaveKnowledgeSkill')->name('profile.doSaveKnowSkill');
    Route::post('/doSaveEduBak', 'ProfileController@doSaveEduBackground')->name('profile.doSaveEduBak');
    Route::post('/doSaveWorkExp', 'ProfileController@doSaveWorkExp')->name('profile.doSaveWorkExp');
});

Route::group(['prefix' => 'masterdata', 'middleware' => []], function () {
    Route::get('/getDistrictListByProvinceId', 'MasterDataController@getDistrictByProvinceIdForDropdown')->name('masterdata.getDistrictListByProvinceId');
});


//loginApplicant
Route::get('/login', 'LoginApplicantController@showLoginPage')->name('showLoginApplicant');
Route::post('/login', 'LoginApplicantController@postLogin')->name('postLoginApplicant');
Route::post('/login/repass', 'LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::post('/login/register', 'LoginApplicantController@register')->name('registerApplicant');




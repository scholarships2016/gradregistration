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

Route::get('usersldap', 'Auth\LoginUserController@checkuserldap');
Route::post('register', ['as' => 'registerApplicant', 'uses' => 'Auth\LoginApplicantController@register']);
Route::post('/login/repass', 'Auth\LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::get('login', 'Auth\LoginApplicantController@showLoginForm')->name('showLogin');
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginApplicantController@postLogin']);
Route::get('logout', 'Auth\LoginApplicantController@getLogout')->name('logout');
 
//SetLangues just call function
Route::get('language', 'Auth\LoginApplicantController@language');


//Apply
Route::get('apply', 'ApplyController@showAnnouncement');


//PageMain
Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('home');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/faq', function () {
    return view('faqs');
});
Route::get('/download', function () {
    return view('download');
});
 Route::any('apply/register/', 'ApplyController@managementRegister')->name('managementRegister');
 
 Route::get('apply/manageMyCourse/', 'ApplyController@manageMyCourse')->name('manageMyCourse');
  Route::get('apply/getRegisterCourse/', 'ApplyController@getRegisterCourse')->name('manageMyCourse.data');
 Route::get('apply/registerCourse/{id}', 'ApplyController@registerCourse')->name('registerCourse');
 Route::get('apply/registerDetailForapply/{id}', 'ApplyController@registerDetailForapply')->name('registerDetailForapply');
 Route::get('apply/confDocApply/{id}', 'ApplyController@confDocApply')->name('confDocApply');
 Route::get('apply/peopleData/{id}', 'ApplyController@getPeopoleRef')->name('datatables.data');
 Route::post('apply/savePeopoleRef', 'ApplyController@savePeopoleRef')->name('datatables.savePeopoleRef');
 Route::post('apply/submitregisterDetailForapply', 'ApplyController@submitregisterDetailForapply')->name('submitregisterDetailForapply');
 Route::get('apply/actionCourse/{action}/{id}', 'ApplyController@actionCourse')->name('confDocApply');
 Route::post('apply/submitDocApply', 'ApplyController@submitDocApply')->name('submitDocApply');
  Route::get('util/downloadFile', 'Controller@doDownloadFile')->name('downloadFile');
 Route::get('showRegisHead', 'ApplyController@showRegisHead')->name('showRegisHead');
 
 
// หน้าในของ User ที่ต้องการ auth ให้ใส่ที่นี้ครับ
Route::group(['middleware' => 'auth'], function () {
   
 
   
});


Route::group(['prefix' => 'profile', 'middleware' => []], function () {
    Route::get('/', 'ProfileController@showPersonalProfilePage')->name('profile.showProfilePage');
    Route::post('/doSavePersInfo', 'ProfileController@doSavePersonalInfomation')->name('profile.doSavePersInfo');
    Route::post('/doSavePretAddr', 'ProfileController@doSavePresentAddress')->name('profile.doSavePretAddr');
    Route::post('/doSaveKnowSkill', 'ProfileController@doSaveKnowledgeSkill')->name('profile.doSaveKnowSkill');
    Route::post('/doSaveEduBak', 'ProfileController@doSaveEduBackground')->name('profile.doSaveEduBak');
    Route::post('/doSaveWorkExp', 'ProfileController@doSaveWorkExp')->name('profile.doSaveWorkExp');
});

Route::group(['prefix' => 'masterdata', 'middleware' => []], function () {
    Route::get('/getDistrictListByProvinceId', 'MasterDataController@getDistrictByProvinceIdForDropdown')->name('masterdata.getDistrictListByProvinceId');
    Route::get('/getDepartmentByFacultyId', 'MasterDataController@getDepartmentByFacultyIdForDropdown')->name('masterdata.getDepartmentByFacultyId');
    Route::get('/getCurriculaByDepartmentId', 'MasterDataController@getCurriculaByDepartmentIdForDropdown')->name('masterdata.getCurriculaByDepartmentId');
});







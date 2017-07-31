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

//ไม่ล๊อกอินก็สามารถเห็นได้
//login  User
Route::post('/login/repass', 'Auth\LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::get('login', 'Auth\LoginApplicantController@showLoginForm')->name('showLogin');
Route::post('login', 'Auth\LoginApplicantController@postLogin')->name('logins');
Route::post('register', ['as' => 'registerApplicant', 'uses' => 'Auth\LoginApplicantController@register']);

//login Admin
//Route::get('login/admin', 'Auth\LoginUserController@checkuserldap');
Route::get('login/admin', 'Auth\LoginUserController@showLoginForm')->name('showLoginAdmin');
Route::post('login_admin', 'Auth\LoginUserController@postLogin')->name('adminlogin');








//SetLangues just call function
Route::get('language', 'Auth\LoginApplicantController@language');


//Head
Route::get('showRegisHead', 'ApplyController@showRegisHead')->name('showRegisHead');
//Apply
Route::any('apply/register/', 'ApplyController@managementRegister')->name('managementRegister');
Route::get('apply/getRegisterCourse/', 'ApplyController@getRegisterCourse')->name('manageMyCourse.data');
Route::get('apply/registerDetailForapply/{id}', 'ApplyController@registerDetailForapply')->name('registerDetailForapply');




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





// หน้าในของ User ที่ต้องการ auth ให้ใส่ที่นี้ครับ
Route::group(['middleware' => 'auth'], function () {
    
    Route::get('logout', 'Auth\LoginApplicantController@getLogout')->name('logout');
//Apply 
    Route::get('apply', 'ApplyController@showAnnouncement');
    Route::get('apply/manageMyCourse/', 'ApplyController@manageMyCourse')->name('manageMyCourse');
    Route::get('apply/registerCourse/{id}', 'ApplyController@registerCourse')->name('registerCourse');
    Route::get('apply/confDocApply/{id}', 'ApplyController@confDocApply')->name('confDocApply');
    Route::get('apply/peopleData/{id}', 'ApplyController@getPeopoleRef')->name('datatables.data');
    Route::post('apply/savePeopoleRef', 'ApplyController@savePeopoleRef')->name('datatables.savePeopoleRef');
    Route::post('apply/submitregisterDetailForapply', 'ApplyController@submitregisterDetailForapply')->name('submitregisterDetailForapply');
    Route::get('apply/actionCourse/{action}/{id}', 'ApplyController@actionCourse')->name('confDocApply');
    Route::post('apply/submitDocApply', 'ApplyController@submitDocApply')->name('submitDocApply');
    Route::get('apply/docMyCourse/{id}', 'ApplyController@docMyCourse')->name('docMyCourse');
    Route::get('apply/docMyCourserintPDF/{id}', 'ApplyController@docMyCourserintPDF')->name('docMyCourserintPDF');
    Route::get('apply/docAppfeePDF/{id}', 'ApplyController@docApplicationFee')->name('docAppfeePDF');
    Route::get('apply/docAppEnvelopPDF/{id}', 'ApplyController@docApplicationEnvelop')->name('docAppEnvelopPDF');
    Route::get('util/downloadFile', 'Controller@doDownloadFile')->name('downloadFile');
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
    Route::get('/getAllFaculty', 'MasterDataController@getAllFacultyForDropdown')->name('masterdata.getAllFacultyForDropdown');
    Route::get('/getMajorByDepartmentId', 'MasterDataController@getMajorByDepartmentIdForDropdown')->name('masterdata.getMajorByDepartmentIdForDropdown');
    Route::get('/getSubMajorByMajorId', 'MasterDataController@getSubMajorByMajorIdForDropdown')->name('masterdata.getSubMajorByMajorIdForDropdown');
    Route::get('/getMcourseStudyByMajorId', 'MasterDataController@getMcourseStudyByMajorId')->name('masterdata.getMcourseStudyByMajorId');
    Route::get('/getApplySettingByAcademicYear', 'MasterDataController@getApplySettingByAcademicYear')->name('masterdata.getApplySettingByAcademicYear');
    Route::get('/getApplySettingBySemesterAndAcademicYear', 'MasterDataController@getApplySettingBySemesterAndAcademicYear')->name('masterdata.getApplySettingBySemesterAndAcademicYear');

});


Route::group(['prefix' => 'admin', 'middleware' => []], function () {
    Route::group(['prefix' => 'curriculum', 'middleware' => []], function () {
        Route::get('add', 'BackOffice\CurriculumController@showAddPage')->name('admin.curriculum.showAdd');
        Route::get('edit/{id}', 'BackOffice\CurriculumController@showEditPage')->name('admin.curriculum.showEdit');
        Route::post('save', 'BackOffice\CurriculumController@doSave')->name('admin.curriculum.doSave');
        Route::get('getCurrProgListByCurriculumId', 'BackOffice\CurriculumController@getCurrProgListByCurriculumId')->name('admin.curriculum.getCurrProgListByCurriculumId');
        Route::get('getCurrActByCurriculumId', 'BackOffice\CurriculumController@getCurrActByCurriculumId')->name('admin.curriculum.getCurrActByCurriculumId');
        Route::get('getCurrSubMajorByCurriculumId', 'BackOffice\CurriculumController@getCurrSubMajorByCurriculumId')->name('admin.curriculum.getCurrSubMajorByCurriculumId');
        Route::get('downloadCurriculumDoc', 'BackOffice\CurriculumController@downloadCurriculumDoc')->name('admin.curriculum.downloadCurriculumDoc');
    });
});





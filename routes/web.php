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
Route::get('admin/login/', 'Auth\LoginUserController@showLoginForm')->name('showLoginAdmin');
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

//payment

Route::get('admin/ManagePay', 'ManageApplyController@showManagePay')->name('ManagePay');
Route::get('admin/getRegisterCourse', 'ManageApplyController@getRegisterCourse')->name('admin.getRegisterCourse');
Route::get('admin/manageDocument/{id}/{pid}', 'ManageApplyController@manageApplicantDocument')->name('manageApplicantDocument');
Route::post('apply/savePayment', 'ManageApplyController@savePayment')->name('datatables.savePayment');

//GS03

Route::get('admin/ManageGS03', 'ManageApplyController@showManageGS03')->name('ManageGS03');
Route::get('admin/getCourse', 'ManageApplyController@getCourse')->name('getCourse');
Route::get('admin/getStatusExam', 'ManageApplyController@getStatusExam')->name('getStatusExam');
Route::get('admin/getEngTest', 'ManageApplyController@getEngTest')->name('getEngTest');
Route::post('admin/updateApplication', 'ManageApplyController@updateApplication')->name('updateApplication');
Route::post('admin/sentMailGS03', 'ManageApplyController@sentMailGS03')->name('sentMailGS03');
Route::get('admin/applicantGS03', 'ManageApplyController@checkApplicant')->name('applicantGS03');
 
//GS05
Route::get('admin/ManageGS05', 'ManageApplyController@showManageGS05')->name('ManageGS05');
Route::post('admin/sentMailGS05', 'ManageApplyController@sentMailGS05')->name('sentMailGS05');
Route::get('admin/getStatusAdmission', 'ManageApplyController@getStatusAdmission')->name('getStatusAdmission');



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
    Route::post('/doChangePassword', 'ProfileController@doChangePassword')->name('profile.doChangePassword');

    //ProfilePic
    Route::get('/getProfileImg', 'ProfileController@getProfileImg')->name('profile.getProfileImg');

});

Route::group(['prefix' => 'masterdata', 'middleware' => []], function () {
    Route::get('/getDistrictListByProvinceId', 'MasterDataController@getDistrictByProvinceIdForDropdown')->name('masterdata.getDistrictListByProvinceId');
    Route::get('/getDepartmentByFacultyId', 'MasterDataController@getDepartmentByFacultyIdForDropdown')->name('masterdata.getDepartmentByFacultyId');
    Route::get('/getCurriculaByDepartmentId', 'MasterDataController@getCurriculaByDepartmentIdForDropdown')->name('masterdata.getCurriculaByDepartmentId');
    Route::get('/getAllFaculty', 'MasterDataController@getAllFacultyForDropdown')->name('masterdata.getAllFacultyForDropdown');
    Route::get('/getMajorByDepartmentId', 'MasterDataController@getMajorByDepartmentIdForDropdown')->name('masterdata.getMajorByDepartmentIdForDropdown');
    Route::get('/getSubMajorByMajorId', 'MasterDataController@getSubMajorByMajorIdForDropdown')->name('masterdata.getSubMajorByMajorIdForDropdown');
    Route::get('/getMcourseStudyByMajorIdAndDegreeId', 'MasterDataController@getMcourseStudyByMajorIdAndDegreeId')->name('masterdata.getMcourseStudyByMajorIdAndDegreeId');
    Route::get('/getApplySettingByAcademicYear', 'MasterDataController@getApplySettingByAcademicYear')->name('masterdata.getApplySettingByAcademicYear');
    Route::get('/getApplySettingBySemesterAndAcademicYear', 'MasterDataController@getApplySettingBySemesterAndAcademicYear')->name('masterdata.getApplySettingBySemesterAndAcademicYear');
    Route::get('/getAllDegreeForDropdown', 'MasterDataController@getAllDegreeForDropdown')->name('masterdata.getAllDegreeForDropdown');

});


Route::group(['prefix' => 'admin', 'middleware' => []], function () {

    Route::group(['prefix' => 'management', 'middleware' => []], function () {
        Route::group(['prefix' => 'curriculum', 'middleware' => []], function () {
            Route::get('add', 'BackOffice\CurriculumController@showAddPage')->name('admin.curriculum.showAdd');
            Route::get('edit/{id}', 'BackOffice\CurriculumController@showEditPage')->name('admin.curriculum.showEdit');
            Route::post('save', 'BackOffice\CurriculumController@doSave')->name('admin.curriculum.doSave');
            Route::get('getCurrProgListByCurriculumId', 'BackOffice\CurriculumController@getCurrProgListByCurriculumId')->name('admin.curriculum.getCurrProgListByCurriculumId');
            Route::get('getCurrActByCurriculumId', 'BackOffice\CurriculumController@getCurrActByCurriculumId')->name('admin.curriculum.getCurrActByCurriculumId');
            Route::get('getCurrSubMajorByCurriculumId', 'BackOffice\CurriculumController@getCurrSubMajorByCurriculumId')->name('admin.curriculum.getCurrSubMajorByCurriculumId');
            Route::get('downloadCurriculumDoc', 'BackOffice\CurriculumController@downloadCurriculumDoc')->name('admin.curriculum.downloadCurriculumDoc');

            Route::get('manage', 'BackOffice\CurriculumController@showManagePage')->name('admin.curriculum.showManagePage');
            Route::get('paging1', 'BackOffice\CurriculumController@doCurriculumManagePaging')->name('admin.curriculum.doPaging1');

            Route::post('doSendToApprove', 'BackOffice\CurriculumController@doSendToApprove')->name('admin.curriculum.doSendToApprove');
            Route::post('doApprove', 'BackOffice\CurriculumController@doApprove')->name('admin.curriculum.doApprove');
            Route::post('doReject', 'BackOffice\CurriculumController@doReject')->name('admin.curriculum.doReject');
            Route::post('doDelete', 'BackOffice\CurriculumController@doDelete')->name('admin.curriculum.doDelete');
        });
    });

    Route::group(['prefix' => 'setting', 'middleware' => []], function () {
        Route::group(['prefix' => 'applysetting', 'middleware' => []], function () {
            Route::get('add', 'BackOffice\ApplySettingController@showAddPage')->name('admin.applysetting.showAdd');
            Route::get('edit', 'BackOffice\ApplySettingController@showEditPage')->name('admin.applysetting.showEdit');
            Route::post('save', 'BackOffice\ApplySettingController@doSave')->name('admin.applysetting.doSave');
            Route::get('manage', 'BackOffice\ApplySettingController@showManagePage')->name('admin.applysetting.showManagePage');
            Route::get('paging', 'BackOffice\ApplySettingController@doPaging')->name('admin.applysetting.doPaging');
            Route::post('doDelete', 'BackOffice\ApplySettingController@doDelete')->name('admin.applysetting.doDelete');
        });

        Route::group(['prefix' => 'applicantManage', 'middleware' => []], function () {
        });

        Route::group(['prefix' => 'adminManage', 'middleware' => []], function () {
            Route::get('add', 'BackOffice\AdminManagementController@showAddPage')->name('admin.adminManage.showAdd');
            Route::get('edit', 'BackOffice\AdminManagementController@showEditPage')->name('admin.adminManage.showEdit');
            Route::post('save', 'BackOffice\AdminManagementController@doSave')->name('admin.adminManage.doSave');
        });

    });

});


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
Route::get('/admin/index.html', function () {
    return Redirect::to('/index.html');
});

Route::post('syncProgram', 'BackOffice\MasterInfoController@updateMcourseTable')->name('syncProgram');
//ไม่ล๊อกอินก็สามารถเห็นได้
//login  User
Route::post('login/repass', 'Auth\LoginApplicantController@reLogin')->name('rePassLoginApplicant');
Route::get('login', 'Auth\LoginApplicantController@showLoginForm')->name('showLogin');
Route::post('login', 'Auth\LoginApplicantController@postLogin')->name('logins');
Route::post('register', ['as' => 'registerApplicant', 'uses' => 'Auth\LoginApplicantController@register']);

//login Admin
//Route::get('login/admin', 'Auth\LoginUserController@checkuserldap');
Route::get('admin/login/', 'Auth\LoginUserController@showLoginForm')->name('showLoginAdmin');
Route::post('login_admin', 'Auth\LoginUserController@postLogin')->name('adminlogin');
Route::get('admin/logout', 'Auth\LoginUserController@getLogout')->name('logout');

//SetLangues just call function
Route::get('language', 'Auth\LoginApplicantController@language');


//Head
Route::get('showRegisHead', 'HomeController@showRegisHead')->name('showRegisHead');
//Apply
Route::any('apply/register/', 'ApplyController@managementRegister')->name('managementRegister');
Route::get('apply/getRegisterCourse/', 'ApplyController@getRegisterCourse')->name('manageMyCourse.data');
Route::get('apply/registerDetailForapply/{id}', 'ApplyController@registerDetailForapply')->name('registerDetailForapply');


//PageMain
Route::get('/home', 'HomeController@viewHome')->name('viewHome');
Route::get('/', 'HomeController@viewHome');
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/faq', function () {
    return view('faqs');
});
Route::get('/download', function () {
    return view('download');
});

//View file for visitor
Route::get('util/viewFile', 'Controller@doDownloadFile')->name('viewFile');
//download Files in Media folder for visotor
Route::get('viewMedia', function (\Illuminate\Http\Request $request) {
    $input_path = $request->input('path');
    $real_path = Crypt::decrypt($input_path);
    $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('MEDIA\\' . $real_path);
    return response()->download($path);
})->name('viewMedia');
// หน้าในของ User ที่ต้องการ auth ให้ใส่ที่นี้ครับ
Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', 'Auth\LoginApplicantController@getLogout')->name('logout');

    //Apply
    Route::get('apply', 'ApplyController@showAnnouncement');
    Route::get('application/manageMyCourse/', 'ApplyController@manageMyCourse')->name('manageMyCourse');
    Route::get('application/registerCourse/{id}', 'ApplyController@registerCourse')->name('registerCourse');
    Route::get('application/confDocApply/{id}', 'ApplyController@confDocApply')->name('confDocApply');
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
    Route::get('util/downloadMediaFile', 'Controller@doDownloadMediaFile')->name('downloadMediaFile');

    //payment
    Route::post('apply/savePayment', 'ManageApplyController@savePayment')->name('datatables.savePayment');


    Route::group(['prefix' => 'admin'], function () {
        //download Files
        Route::get('getMedia', function (\Illuminate\Http\Request $request) {
            $input_path = $request->input('path');
            $real_path = Crypt::decrypt($input_path);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix('MEDIA\\' . $real_path);
            return response()->download($path);
        })->name('admin.getMedia');
        Route::get('manageDocument/{id}/{pid}', 'ManageApplyController@manageApplicantDocument')->name('manageApplicantDocument');

        //Notice
        Route::get('getWorkflowNotification', 'BackOffice\BackOfficeController@getWorkflowNotification')->name('admin.backoffice.getWorkflowNotification');


        Route::get('toDoList', 'BackOffice\BackOfficeController@showToDoListPage')->name('admin.backoffice.showToDoListPage');
        Route::get('doPaging', 'BackOffice\BackOfficeController@doPaging')->name('admin.backoffice.doPaging');


        //P'M ROUTING START
        //payment
        Route::get('ManagePay', 'ManageApplyController@showManagePay')->name('ManagePay');
        Route::get('getRegisterCourse', 'ManageApplyController@getRegisterCourse')->name('admin.getRegisterCourse');


        Route::get('docMyCourserintPDF/{id}/{pid}', 'ManageApplyController@docMyCourserintPDF')->name('admin.docMyCourserintPDF');
        Route::get('docMyCourse/{id}/{pid}', 'ManageApplyController@docMyCourse')->name('admin.docMyCourse');
        //GS03

        Route::get('ManageGS03', 'ManageApplyController@showManageGS03')->name('ManageGS03');
        Route::get('getCourse', 'ManageApplyController@getCourse')->name('getCourse');
        Route::get('getStatusExam', 'ManageApplyController@getStatusExam')->name('getStatusExam');
        Route::get('getEngTest', 'ManageApplyController@getEngTest')->name('getEngTest');
        Route::post('updateApplication', 'ManageApplyController@updateApplication')->name('updateApplication');
        Route::post('sentMailGS03', 'ManageApplyController@sentMailGS03')->name('sentMailGS03');
        Route::get('applicantGS03', 'ManageApplyController@checkApplicant')->name('applicantGS03');
        Route::post('addUserExamGS03', 'ManageApplyController@addUserExamGS03')->name('addUserExamGS03');
        Route::post('addUserExamGS05', 'ManageApplyController@addUserExamGS05')->name('addUserExamGS05');



        Route::get('getRegisterCourseReport', 'ManageApplyController@getRegisterCourseReport')->name('admin.getRegisterCourseReport');
        Route::get('printRegisterCourseReport/{flow}/{curr_act_id}/{sub_major}/{program_type_id}/{thaiDegree}/{program_id}/{print}/{suser}/{sposistion}/{txt1}/{reportNmae}', 'ManageApplyController@printRegisterCourseReport')->name('admin.printRegisterCourseReport');
        Route::get('printMoreExamReport/{year}/{semester}/{roundNo}/{faculty_id}/{flow}/{sub_major}/{program_type_id}/{major_id}/{print}', 'ManageApplyController@printMoreExamReport')->name('admin.printMoreExamReport');
        Route::get('printForeignerReport/{year}/{semester}/{roundNo}/{faculty_id}/{flow}/{sub_major}/{program_type_id}/{major_id}/{print}', 'ManageApplyController@printForeignerReport')->name('admin.printForeignerReport');
        Route::get('getRegisterCourseMoreReport', 'ManageApplyController@getRegisterCourseMoreReport')->name('admin.getRegisterCourseMoreReport');
        Route::get('getforeignerReport', 'ManageApplyController@getforeignerReport')->name('admin.getforeignerReport');

        //GS05
        Route::get('ManageGS05', 'ManageApplyController@showManageGS05')->name('ManageGS05');
        Route::post('sentMailGS05', 'ManageApplyController@sentMailGS05')->name('sentMailGS05');
        Route::get('getStatusAdmission', 'ManageApplyController@getStatusAdmission')->name('getStatusAdmission');
        Route::get('showMangePayBarcode', 'ManageApplyController@showMangePayBarcode')->name('showMangePayBarcode');
        Route::get('getRegisterCourseBarcode', 'ManageApplyController@getRegisterCourseBarcode')->name('admin.getRegisterCourseBarcode');
        Route::post('savePaymentBarcode', 'ManageApplyController@savePaymentBarcode')->name('savePaymentBarcode');
        Route::get('ShowRecommenReport/{id}', 'ManageApplyController@ShowRecommenReport')->name('ShowRecommenReport');
        Route::get('docRecommenPDF', 'ManageApplyController@docRecommenPDF')->name('docRecommenPDF');
        Route::get('deleteCourse/{id}', 'ManageApplyController@deleteCourse')->name('deleteCourse');

        //util M
        Route::get('importApplicant', 'ManageApplyController@importApplicant')->name('importApplicant');
        Route::get('importExport', 'Controller@importExport');
        Route::post('importExcel', 'Controller@importExcel')->name('importExcel');
        Route::post('importApplicantSave', 'ManageApplyController@importApplicantSave')->name('importApplicantSave');
        Route::get('manageNews', 'ManageApplyController@manageNews');
        Route::post('DeleteNews', 'ManageApplyController@DeleteNews')->name('DNews');
        Route::post('postNews', 'ManageApplyController@SaveNews')->name('postNews');
        Route::get('editNews/{id}', 'ManageApplyController@editNews')->name('editNews');
        Route::get('manageAnnounc', 'ManageApplyController@manageAnnounc');
        Route::post('DeleteAnnounc', 'ManageApplyController@DeleteAnnounc')->name('DAnnounc');
        Route::post('postAnnounc', 'ManageApplyController@SaveAnnounc')->name('postAnnounc');
        Route::get('editAnnounc/{id}', 'ManageApplyController@editAnnounc')->name('editAnnounc');
        //importApplication
        Route::get('importApplication', 'ManageApplyController@importApplicationShow')->name('importApplication');

        //P'M ROUTING END


        Route::group(['prefix' => 'management', 'middleware' => []], function () {
            Route::group(['prefix' => 'curriculum', 'middleware' => ['backoffice:1']], function () {
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

//report
        Route::group(['prefix' => 'report'], function () {
            Route::get('payment-summary-report', 'BackOffice\ReportController@showReport01Page')->name('admin.report.showReport01Page');
            Route::get('doReport01', 'BackOffice\ReportController@doReport01')->name('admin.report.doReport01');
            Route::get('doReport01Excel', 'BackOffice\ReportController@doReport01Excel')->name('admin.report.doReport01Excel');

            Route::get('register-applicant-report', 'BackOffice\ReportController@showReport02Page')->name('admin.report.showReport02Page');
            Route::get('doReport02', 'BackOffice\ReportController@doReport02')->name('admin.report.doReport02');
            Route::get('doReport02Excel', 'BackOffice\ReportController@doReport02Excel')->name('admin.report.doReport02Excel');

            Route::get('applicant-summary-report', 'BackOffice\ReportController@showReport03Page')->name('admin.report.showReport03Page');
            Route::get('doReport03', 'BackOffice\ReportController@doReport03')->name('admin.report.doReport03');
            Route::get('doReport03Excel', 'BackOffice\ReportController@doReport03Excel')->name('admin.report.doReport03Excel');

            Route::get('applicant-application-data', 'BackOffice\ReportController@showReport04Page')->name('admin.report.showReport04Page');
            Route::get('doReport04Excel', 'BackOffice\ReportController@doReport04Excel')->name('admin.report.doReport04Excel');



            Route::get('gs03-report', 'ManageApplyController@showReportGS03')->name('report.GS03');
            Route::get('b21-report', 'ManageApplyController@showReportB21')->name('report.B21');
            Route::get('gs05-report', 'ManageApplyController@showReportGS05')->name('report.GS05');
            Route::get('multiple-application-report', 'ManageApplyController@showReportExamMore')->name('report.ReportExamMore');
            Route::get('foreigner-report', 'ManageApplyController@showReportforeigner')->name('report.foreigner');
        });

        Route::get('profile', 'BackOffice\AdminManagementController@showProfileEditPage')->name('admin.showProfileEditPage');
        Route::post('saveProfile', 'BackOffice\AdminManagementController@doSave2')->name('admin.doSaveProfile');

        Route::group(['prefix' => 'setting', 'middleware' => []], function () {
            Route::group(['prefix' => 'applysetting', 'middleware' => ['backoffice:11']], function () {
                Route::get('add', 'BackOffice\ApplySettingController@showAddPage')->name('admin.applysetting.showAdd');
                Route::get('edit', 'BackOffice\ApplySettingController@showEditPage')->name('admin.applysetting.showEdit');
                Route::post('save', 'BackOffice\ApplySettingController@doSave')->name('admin.applysetting.doSave');
                Route::get('manage', 'BackOffice\ApplySettingController@showManagePage')->name('admin.applysetting.showManagePage');
                Route::get('paging', 'BackOffice\ApplySettingController@doPaging')->name('admin.applysetting.doPaging');
                Route::post('doDelete', 'BackOffice\ApplySettingController@doDelete')->name('admin.applysetting.doDelete');
            });

            Route::group(['prefix' => 'applicantManage', 'middleware' => ['backoffice:9']], function () {
                Route::get('view/{id}', 'BackOffice\ApplicantManagementController@showViewPage')->name('admin.applicantManage.showViewPage');
                Route::get('edit/{id}', 'BackOffice\ApplicantManagementController@showEditPage')->name('admin.applicantManage.showEditPage');
                Route::get('manage', 'BackOffice\ApplicantManagementController@showManagePage')->name('admin.applicantManage.showManagePage');
                Route::get('doPaging', 'BackOffice\ApplicantManagementController@doPaging')->name('admin.applicantManage.doPaging');
                Route::post('doDelete', 'BackOffice\ApplicantManagementController@doDelete')->name('admin.applicantManage.doDelete');

                Route::post('/doSavePersInfo', 'BackOffice\ApplicantManagementController@doSavePersonalInfomation')->name('admin.applicantManage.doSavePersInfo');
                Route::post('/doSavePretAddr', 'BackOffice\ApplicantManagementController@doSavePresentAddress')->name('admin.applicantManage.doSavePretAddr');
                Route::post('/doSaveKnowSkill', 'BackOffice\ApplicantManagementController@doSaveKnowledgeSkill')->name('admin.applicantManage.doSaveKnowSkill');
                Route::post('/doSaveEduBak', 'BackOffice\ApplicantManagementController@doSaveEduBackground')->name('admin.applicantManage.doSaveEduBak');
                Route::post('/doSaveWorkExp', 'BackOffice\ApplicantManagementController@doSaveWorkExp')->name('admin.applicantManage.doSaveWorkExp');
                Route::post('/doChangePassword', 'BackOffice\ApplicantManagementController@doChangePassword')->name('admin.applicantManage.doChangePassword');

                //Application
                Route::get('getApplicationAndProgramInfo', 'BackOffice\ApplicantManagementController@getApplicationAndProgramInfo')->name('admin.applicantManage.getApplicationAndProgramInfo');
                Route::post('doDeleteApplication', 'BackOffice\ApplicantManagementController@doDeleteApplication')->name('admin.applicantManage.doDeleteApplication');
            });


            Route::group(['prefix' => 'adminManage', 'middleware' => ['backoffice']], function () {
                Route::get('manage', 'BackOffice\AdminManagementController@showManagePage')->name('admin.adminManage.showManagePage');
                Route::get('add', 'BackOffice\AdminManagementController@showAddPage')->name('admin.adminManage.showAdd');
                Route::get('edit/{id}', 'BackOffice\AdminManagementController@showEditPage')->name('admin.adminManage.showEditPage');
                Route::post('save', 'BackOffice\AdminManagementController@doSave')->name('admin.adminManage.doSave');
                Route::post('doDelete', 'BackOffice\AdminManagementController@doDelete')->name('admin.adminManage.doDelete');

                //Paging
                Route::get('doPaging', 'BackOffice\AdminManagementController@doPaging')->name('admin.adminManage.doPaging');
            });

            Route::group(['prefix' => 'masterInfo', 'middleware' => ['backoffice:10']], function () {
                Route::get('courseManage', 'BackOffice\MasterInfoController@showManageCoursePage')->name('admin.masterInfo.showManageCoursePage');
                Route::get('add', 'BackOffice\MasterInfoController@showMCourseAddPage')->name('admin.masterInfo.showMCourseAddPage');
                Route::get('edit/{id}', 'BackOffice\MasterInfoController@showMCourseEditPage')->name('admin.masterInfo.showMCourseEditPage');
                Route::post('save', 'BackOffice\MasterInfoController@doSaveMcourse')->name('admin.masterInfo.doSaveMcourse');
                Route::post('updateMcourse', 'BackOffice\MasterInfoController@updateMcourseTable')->name('admin.masterInfo.updateMcourse');
                Route::post('doDelete', 'BackOffice\MasterInfoController@doDelete')->name('admin.masterInfo.doDelete');
                Route::get('getMCourseData', 'BackOffice\MasterInfoController@getMCourseData')->name('admin.masterInfo.getMCourseData');
            });

            Route::group(['prefix' => 'audit', 'middleware' => ['backoffice:7']], function () {
                Route::get('manage', 'BackOffice\AuditController@showAuditManagePage')->name('admin.audit.showManagePage');
                Route::get('doPaging', 'BackOffice\AuditController@doPaging')->name('admin.audit.doPaging');
            });
        });
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

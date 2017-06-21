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

//    $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
//    /* Note: any element you append to a document must reside inside of a Section. */
//
//// Adding an empty Section to the document...
//    $section = $phpWord->addSection();
//// Adding Text element to the Section having font styled by default...
//    $section->addText(
//        '"Learn from yesterday, live for today, hope for tomorrow. '
//        . 'The important thing is not to stop questioning." '
//        . '(Albert Einstein)'
//    );
//
//    /*
//     * Note: it's possible to customize font style of the Text element you add in three ways:
//     * - inline;
//     * - using named font style (new font style object will be implicitly created);
//     * - using explicitly created font style object.
//     */
//
//// Adding Text element with font customized inline...
//    $section->addText(
//        '"Great achievement is usually born of great sacrifice, '
//        . 'and is never the result of selfishness." '
//        . '(Napoleon Hill)',
//        array('name' => 'Tahoma', 'size' => 10)
//    );
//
//// Adding Text element with font customized using named font style...
//    $fontStyleName = 'oneUserDefinedStyle';
//    $phpWord->addFontStyle(
//        $fontStyleName,
//        array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
//    );
//    $section->addText(
//        '"The greatest accomplishment is not in never falling, '
//        . 'but in rising again after you fall." '
//        . '(Vince Lombardi)',
//        $fontStyleName
//    );
//
//// Adding Text element with font customized using explicitly created font style object...
//    $fontStyle = new \PhpOffice\PhpWord\Style\Font();
//    $fontStyle->setBold(true);
//    $fontStyle->setName('TH SarabunPSK');
//    $fontStyle->setSize(20);
//    $fontStyle->setColor('00FF00');
//    $myTextElement = $section->addText('เราชอบเทอมอส');
//    $myTextElement->setFontStyle($fontStyle);
//// Saving the document as HTML file...
//
//    header("Content-Description: File Transfer");
//    header('Content-Disposition: attachment; filename="' . 'helloWorld.docx' . '"');
//    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
//    header('Content-Transfer-Encoding: binary');
//    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//    header('Expires: 0');
//    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//    $objWriter->save('php://output');


    return view('index');
});
 Route::get('/nation/','NationController@show');
 Route::get('/nation/{id}','NationController@show');
 
 
// Route::get('/home', function () {
//     return view('index');
// })->middleware('auth')->name('home');

//'role:' . Util::ROLE_ROOT

// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role']], function () {
//     Route::group(['prefix' => 'user'], function () {
//         Route::get('search', 'Admin\UserManagementController@showSearchPage')->name('admin.user.showSearch');
//         Route::post('search', 'Admin\UserManagementController@showSearchPage')->name('admin.user.doShowSearch');
//         Route::get('edit/{id}', 'Admin\UserManagementController@showEditPageById')->name('admin.user.showEdit');
//         Route::post('edit', 'Admin\UserManagementController@updateUser')->name('admin.user.doUpdate');
//         Route::get('add', 'Admin\UserManagementController@showAddPage')->name('admin.user.showAdd');
//         Route::post('add', 'Admin\UserManagementController@saveNewUser')->name('admin.user.doCreate');
//         //Paginate Search
//         Route::get('paging', 'Admin\UserManagementController@doPaginate')->name('admin.user.doPaginate');
//         //Search Profile
//         Route::get('searchProfile', 'Admin\UserManagementController@getProfileByEmpId')->name('admin.user.doSearchProfile');
// 
// 
//     });
//     Route::group(['prefix' => 'role'], function () {
//         Route::get('search', 'Admin\RoleManagementController@showSearchPage')->name('admin.role.showSearch');
//         Route::get('add', 'Admin\RoleManagementController@showAddPage')->name('admin.role.showAdd');
//         Route::post('add', 'Admin\RoleManagementController@createNewRole')->name('admin.role.doCreate');
//         Route::get('edit/{id}', 'Admin\RoleManagementController@showEditPage')->name('admin.role.showEdit');
//         Route::get('edit', 'Admin\RoleManagementController@showEditPage')->name('admin.role.showEdit');
//         Route::post('edit', 'Admin\RoleManagementController@updateRole')->name('admin.role.doUpdate');
//         //Paginate Search
//         Route::get('paging', 'Admin\RoleManagementController@doPaginate')->name('admin.role.doPaginate');
//     });
// });



Auth::routes();



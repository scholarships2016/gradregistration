<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnnouncementRepositoryImpl;
use App\Repositories\FacultyRepositoryImpl;
use App\Repositories\DepartmentRepositoryImpl;
use App\Repositories\ProgramTypeRepositoryImpl;
use App\Repositories\BankRepositoryImpl;
use App\Repositories\DocumentsApplyRepositoryImpl;
use App\Repositories\ApplicationPeopleRefRepositoryImpl;
use App\Repositories\CurriculumRepositoryImpl;
use Illuminate\Support\Facades\Lang;
use App\Repositories\CurriculumSubMajorRepositoryImpl;
use App\Repositories\CurriculumProgramRepositoryImpl;
use App\Repositories\ApplicationRepositoryImpl;
use App\Repositories\ApplicationDocumentFileRepositoryImpl;
use App\Repositories\FileRepositoryImpl;
use App\Repositories\SatisfactionRepositoryImpl;
use App\Repositories\ApplicantRepositoryImpl;
use App\Repositories\TblExamStatusRepositoryImpl;
use App\Repositories\TblAdmissionStatusRepositoryImpl;
use App\Models\TblCertificateApprover;
use Illuminate\Support\Facades\Mail;
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\NewsRepositoryImpl;
use PhpOffice\Common\File;

class ManageApplyController extends Controller {

    protected $part_doc = "applymanagement.";
    protected $AnnouncementRepo;
    protected $FacultyRepo;
    protected $DepRepo;
    protected $ProgramType;
    protected $BankRepo;
    protected $DocumentApply;
    protected $ApplicationPeopleRef;
    protected $CurriculumRepo;
    protected $SubCurriculumRepo;
    protected $CurriculumProgramRepo;
    protected $ApplicationRepo;
    protected $ApplicationDocumentFileRepo;
    protected $FileRepo;
    protected $SatisfactionRepo;
    protected $ApplicantRepo;
    protected $ExamStatus;
    protected $AdmissionStatus;
    protected $NewsRepo;

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl $DepRepo, ProgramTypeRepositoryImpl $ProgramType, BankRepositoryImpl $BankRepo, DocumentsApplyRepositoryImpl $DocumentApply, ApplicationPeopleRefRepositoryImpl $ApplicationPeopleRef
    , CurriculumRepositoryImpl $CurriculumRepo, CurriculumSubMajorRepositoryImpl $SubCurriculumRepo, CurriculumProgramRepositoryImpl $CurriculumProgramRepo
    , ApplicationRepositoryImpl $ApplicationRepo, ApplicationDocumentFileRepositoryImpl $ApplicationDocumentFileRepo, FileRepositoryImpl $FileRepo
    , SatisfactionRepositoryImpl $SatisfactionRepo, ApplicantRepositoryImpl $ApplicantRepo, TblExamStatusRepositoryImpl $ExamStatus
    , TblAdmissionStatusRepositoryImpl $AdmissionStatus, NewsRepositoryImpl $NewsRepo) {
        $this->AnnouncementRepo = $AnnouncementRepo;
        $this->FacultyRepo = $FacultyRepo;
        $this->DepRepo = $DepRepo;
        $this->ProgramType = $ProgramType;
        $this->BankRepo = $BankRepo;
        $this->DocumentApply = $DocumentApply;
        $this->ApplicationPeopleRef = $ApplicationPeopleRef;
        $this->CurriculumRepo = $CurriculumRepo;
        $this->SubCurriculumRepo = $SubCurriculumRepo;
        $this->CurriculumProgramRepo = $CurriculumProgramRepo;
        $this->ApplicationRepo = $ApplicationRepo;
        $this->ApplicationDocumentFileRepo = $ApplicationDocumentFileRepo;
        $this->FileRepo = $FileRepo;
        $this->SatisfactionRepo = $SatisfactionRepo;
        $this->ApplicantRepo = $ApplicantRepo;
        $this->ExamStatus = $ExamStatus;
        $this->AdmissionStatus = $AdmissionStatus;
        $this->NewsRepo = $NewsRepo;
    }

    public function showManagePay() {
        $Bank = $this->BankRepo->getBank();

        return view($this->part_doc . 'manage_pay', ['banks' => $Bank]);
    }

    public function showMangePayBarcode() {
        return view($this->part_doc . 'manage_GS03_barcode');
    }

    public function savePaymentBarcode(Request $request) {
        $curDiss = $this->ApplicationRepo->getDataForMange(null, $request->application_id, null, null, null, null, null, null, null, null, null, null, null, null);
        $res = false;
        if (count($curDiss) > 0) {
            if (!$curDiss[0]['payment_date']) {
                $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
                $gdata = ['application_id' => $request->application_id,
                    'payment_date' => Carbon::now(),
                    'exam_status' => 1,
                    'flow_id' => 3
                    , 'modifier' => $user];
                $res = $this->ApplicationRepo->saveApplication($gdata);
            } else {
                return 'have';
            }
        }
        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return 'true';
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return 'false';
        }
    }

    public function getRegisterCourseBarcode(Request $request = null) {


        $application_id = $request->application_id;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDiss = $this->ApplicationRepo->getDataForMange(null, $application_id, null, null, null, null, null, $user, null, null, null, null, null, null, session('user_type')->user_role);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function savePayment(Request $request) {
        $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
        $gdata = ['application_id' => $request->application_id,
            'payment_date' => $request->payment_date,
            'receipt_book' => $request->receipt_book,
            'receipt_no' => $request->receipt_no,
            'bank_id' => $request->bank_id,
            'exam_status' => 1,
            'flow_id' => $request->flow_id
            , 'modifier' => $user];
        $res = $this->ApplicationRepo->saveApplication($gdata);
        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function importApplicationShow() {
        return view($this->part_doc . 'manage_importApplication');
    }

    public function deleteCourse($id) {
        $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
        $gdata = ['modifier' => $user,
            'application_id' => $id,
            'flow_id' => 0];

        $res = $this->ApplicationRepo->saveApplication($gdata);

        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
        return back();
    }

    public function getRegisterCourse(Request $request = null) {

        $status = explode(',', $request->flow);
        $semester = $request->semester;
        $year = $request->year;
        $roundNo = $request->roundNo;
        $criteria = $request->criteria;
        $curr_act_id = $request->curr_act_id;
        $exam_status = $request->exams;
        $program_id = $request->program_id;
        if (isset($request->sub_major_id)) {
            $sub_major_id = ($request->sub_major_id != null) ? $request->sub_major_id : '-1';
        } else {
            $sub_major_id = null;
        }

        $program_type_id = $request->program_type_id;

        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMange(null, null, $status, $semester, $year, $roundNo, $criteria, $user, $curr_act_id, null, $exam_status, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function manageApplicantDocument($id, $pid) {
        $user_data = $this->ApplicantRepo->find($id);
        $appc = new \stdClass();
        $appc->applicant_id = $user_data->applicant_id;
        $appc->stu_citizen_card = $user_data->stu_citizen_card;
        $appc->stu_email = $user_data->stu_email;
        $appc->nation_id = $user_data->nation_id;
        session()->put('Applicant', $appc);

        $DocumentApplys = $this->DocumentApply->getDetail();
        $DocumentApplyGroup = $this->DocumentApply->getGroup();
        $Datas = $this->ApplicationRepo->getData(null, $pid);
        $files = $this->ApplicationDocumentFileRepo->GetData($pid);
        return view('Apply.confDocApply', ['Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Datas' => $Datas, 'Files' => $files, 'programID' => $pid, 'Year' => $Datas[0]->academic_year, 'Flo' => $Datas[0]->flow_id]);
    }

    public function docMyCourse($id, $pid) {

        $user_data = $this->ApplicantRepo->find($id);
        $appc = new \stdClass();
        $appc->applicant_id = $user_data->applicant_id;
        $appc->stu_citizen_card = $user_data->stu_citizen_card;
        $appc->stu_email = $user_data->stu_email;
        $appc->nation_id = $user_data->nation_id;
        session()->put('Applicant', $appc);

        $dataApplication = $this->ApplicationRepo->getData(null, $pid);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);
        $people = $this->ApplicationPeopleRef->getDetail($pid);
        $DocumentApplys = $this->DocumentApply->getDetailReport();
        $DocumentApplyGroup = $this->DocumentApply->getGroupReport();
        $files = $this->ApplicationDocumentFileRepo->GetData($pid);
        $pic = $this->FileRepo->getImageFileAsBase64ById($applicantProfile['applicant']->stu_img);
        $age = Carbon::parse($applicantProfile['applicant']->stu_birthdate)->diff(Carbon::now())->format('%y ปี[year], %m เดือน[month]  %d วัน[day]');

        return view('Apply.docMyCourse', ['apps' => $dataApplication,
            'applicant' => $applicantProfile['applicant']
            , 'appEdus' => $applicantProfile['applicantEdu']
            , 'appapplicantWorks' => $applicantProfile['applicantWork']
            , 'peoples' => $people
            , 'Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Files' => $files
            , 'age' => $age, 'id' => $pid, 'pictrue' => $pic]);
    }

    public function docMyCourserintPDF($id, $pid) {
        $user_data = $this->ApplicantRepo->find($id);
        $appc = new \stdClass();
        $appc->applicant_id = $user_data->applicant_id;
        $appc->stu_citizen_card = $user_data->stu_citizen_card;
        $appc->stu_email = $user_data->stu_email;
        $appc->nation_id = $user_data->nation_id;
        session()->put('Applicant', $appc);

        $dataApplication = $this->ApplicationRepo->getData(null, $pid);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);
        $people = $this->ApplicationPeopleRef->getDetail($pid);
        $DocumentApplys = $this->DocumentApply->getDetailReport();
        $DocumentApplyGroup = $this->DocumentApply->getGroupReport();
        $files = $this->ApplicationDocumentFileRepo->GetData($pid);


        $pic = $this->doPDFImg($applicantProfile['applicant']->stu_img);

        $age = Carbon::parse($applicantProfile['applicant']->stu_birthdate)->diff(Carbon::now())->format('%y ปี[year], %m เดือน[month]  %d วัน[day]');

        $page = View('Apply.docApplicationForm', ['apps' => $dataApplication,
            'applicant' => $applicantProfile['applicant']
            , 'appEdus' => $applicantProfile['applicantEdu']
            , 'appapplicantWorks' => $applicantProfile['applicantWork']
            , 'peoples' => $people
            , 'Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Files' => $files
            , 'age' => $age, 'pictrue' => $pic])->render();


        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsPhpEnabled(true);
        $options->setDebugKeepTemp(true);
        $options->setIsHtml5ParserEnabled(true);

        $options->set('defaultFont', 'THSarabunNew');
        $pdf = new Dompdf($options);
        $pdf->loadHtml((string) $page);
        $pdf->setPaper('A4', 'portrait');

        $pdf->render();

        //return $pdf->stream("CU_Application" .'_'. $user_data->stu_first_name_en . ".pdf");
        $citizen = $applicantProfile['applicant']->stu_citizen_card;
        $app_id = str_pad($dataApplication[0]->application_id, 5, '0', STR_PAD_LEFT);
        $app_no = $dataApplication[0]->program_id . "-" . str_pad($dataApplication[0]->curriculum_num, 4, '0', STR_PAD_LEFT);
        return $pdf->stream("{$app_id}_{$app_no}_ApplicationForm.pdf");
    }

    //GS03
    public function showManageGS03() {
        return view($this->part_doc . 'manage_GS03');
    }

    public function showManageGS05() {
        return view($this->part_doc . 'manage_GS05');
    }

    public function getCourse(Request $request = null) {
        $academic_year = $request->year;
        $semester = $request->semester;
        $round_no = $request->roundNo;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDiss = $this->CurriculumRepo->searchByCriteria(null, null, null, null, null, null, null, null, false, false, $academic_year, $semester, $round_no, $user, session('user_type')->user_role);
        return response()->json($curDiss->sortBy('faculty_name'));
    }

    public function getStatusExam() {
        $exam = $this->ExamStatus->all();
        return response()->json($exam);
    }

    public function getStatusAdmission() {
        $exams = $this->AdmissionStatus->all();
        return response()->json($exams);
    }

    public function getEngTest() {
        $exam = \App\Models\TblEngTest::get();
        return response()->json($exam);
    }

    public function updateApplication(Request $request = null) {

        $data = '';
        $res = false;
        $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
        if ($request->exam_remark) {
            $data = ['exam_remark' => $request->exam_remark, 'application_id' => $request->application_id, 'modifier' => $user];
        }
        if ($request->exam_status) {
            $flow_id = ($request->exam_status == 2 || $request->exam_status == 3 ) ? 4 : 3;

            $data = ['exam_status' => $request->exam_status, 'admission_status_id' => 0, 'flow_id' => $flow_id, 'application_id' => $request->application_id, 'modifier' => $user];
        }
        if ($request->exam_remark || $request->exam_status) {
            $res = $this->ApplicationRepo->saveApplication($data);
        }

        if ($request->admission_remark) {
            $data = ['admission_remark' => $request->admission_remark, 'application_id' => $request->application_id, 'modifier' => $user];
        }

        if ($request->admission_status_id || $request->admission_status_id == "0") {
            $flow_id = ($request->admission_status_id != 'X' && $request->admission_status_id != '0') ? 5 : 4;
            $data = ['admission_status_id' => $request->admission_status_id, 'flow_id' => $flow_id, 'application_id' => $request->application_id, 'modifier' => $user];
        }
        if ($request->admission_remark || $request->admission_status_id || $request->admission_status_id == "0") {
            $res = $this->ApplicationRepo->saveApplication($data);
        }




        if ($request->eng_test_id_admin) {
            $data = ['eng_test_id_admin' => $request->eng_test_id_admin, 'applicant_id' => $request->applicant_id, 'modifier' => $user];
        }
        if ($request->eng_test_score_admin) {
            $data = ['eng_test_score_admin' => $request->eng_test_score_admin, 'applicant_id' => $request->applicant_id, 'modifier' => $user];
        }
        if ($request->eng_date_taken_admin) {
            $data = ['eng_date_taken_admin' => $request->eng_date_taken_admin, 'applicant_id' => $request->applicant_id, 'modifier' => $user];
        }
        if ($request->eng_test_id_admin || $request->eng_test_score_admin || $request->eng_date_taken_admin) {
            $res = $this->ApplicantRepo->saveApplicant($data);
        }
        return response()->json($res);
    }

    public function checkApplicant(Request $request) {
        if ($request) {
            $curDiss = null;
            $citizencard = $request->citiz;
            $curr_act_id = $request->curr_act_id;
            $sub_major_id = $request->sub_major_id;
            $program_id = $request->program_id;
            $program_type_id = $request->program_type_id;
            $res = $this->ApplicantRepo->getByCitizenOrEmail($citizencard, null);
            if ($res) {
                $curDiss = $this->ApplicationRepo->getDataForMange($res['applicant_id'], null, null, null, null, null, null, null, $curr_act_id, null, null, $sub_major_id, $program_id, $program_type_id);
            }
            if ($curDiss && $curDiss->count() > 0) {
                return response()->json(['mess' => 'มีข้อมูลนี้ในระบบแล้วไม่สามารถเพิ่มได้']);
            }
            return response()->json($res);
        }
    }

    public function addUserExamGS03(Request $request) {
        $res = null;
        try {
            $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
            if ($request) {
                $data = ['curr_act_id' => $request->curr_act_id,
                    'sub_major_id' => $request->sub_major_id,
                    'program_id' => $request->program_id,
                    'program_type_id' => $request->program_type_id,
                    'stu_citizen_card' => $request->idCard,
                    'curriculum_id' => $request->curriculum_id,
                    'flow_id' => 1,
                    'bank_id' => 10,
                    'special_apply_by' => session('user_id'),
                    'special_apply_datetime' => Carbon::now(),
                    'exam_remark' => $request->apply_comment,
                    'creator' => $user,
                    'modifier' => $user,
                    'applicant_id' => $request->applicant_ID];
                $res = $this->ApplicationRepo->saveApplication($data);
                $dataup = ['application_id' => $res->application_id, 'flow_id' => 3];
                $res = $this->ApplicationRepo->saveApplication($dataup);
            }
        } catch (Exception $e) {
            Controller::WLog('addUserExam( ApplicaintID[ ' . $request->application . ']', 'Gs03', $e->getMessage());
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function addUserExamGS05(Request $request) {

        $res = null;
        try {
            $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
            if ($request) {

                $curr_prog_id = $this->CurriculumProgramRepo->getCurrProgByProgramID($request->program_id, $request->curriculum_id);

                $data = ['curr_act_id' => $request->curr_act_id,
                    'sub_major_id' => $request->sub_major_id,
                    'curr_prog_id' => $curr_prog_id->curr_prog_id,
                    'program_id' => $request->program_id,
                    'program_type_id' => $request->program_type_id,
                    'stu_citizen_card' => $request->stu_citizen_card,
                    'curriculum_id' => $request->curriculum_id,
                    'flow_id' => 1,
                    'bank_id' => 10,
                    'special_admission_by' => session('user_id'),
                    'special_admission_date' => Carbon::today()->format('d-m-Y'),
                    'admission_status_id' => $request->admission_status,
                    'admission_remark' => $request->apply_comment,
                    'creator' => $user,
                    'modifier' => $user,
                    'exam_status' => 2,
                    'applicant_id' => $request->applicant_ID];
                $res = $this->ApplicationRepo->saveApplication($data);

                $dataup = ['application_id' => $res->application_id, 'flow_id' => 5];
                $res = $this->ApplicationRepo->saveApplication($dataup);
            }
        } catch (Exception $e) {
            Controller::WLog('addUserExam( ApplicaintID[ ' . $request->application . ']', 'Gs03', $e->getMessage());
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function ShowRecommenReport($id) {
        $application_id = $id;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDis = $this->ApplicationRepo->getDataForMange(null, $application_id, null, null, null, null, null, $user, null, null, null, null, null, null, session('user_type')->user_role);

        foreach ($curDis as $curDiss) {
            $year = $curDiss->academic_year;
            $round_no = $curDiss->round_no;
            $name = $curDiss->stu_first_name . '  ' . $curDiss->stu_last_name;
            $title = $curDiss->name_title;
            $detail = 'ได้ผ่านการสอบคัดเลือกให้เข้าศึกษา ในหลักสูตร' . $curDiss->degree_name . ' สาขาวิชา' . $curDiss->degree_name . '  คณะ' . $curDiss->faculty_name . '  จุฬาลงกรณ์มหาวิทยาลัย   ภาคการศึกษา' . (($curDiss->semester == 1) ? 'ต้น' : 'ปลาย') . '   ปีการศึกษา  ' . $curDiss->academic_year;
            $dateMake = $this->ConvertDateThaiNotWeek(Carbon::now());
            $approve = TblCertificateApprover::all();
            return view($this->part_doc . 'manage_report_Recommentdation', ['year' => $year, 'round' => $round_no, 'name' => $name, 'detail' => $detail, 'dateMake' => $dateMake, 'title' => $title, 'approves' => $approve]);
        }
    }

    public function docRecommenPDF(Request $request) {

        $year = $request->year;
        $round_no = $request->round;
        $name = $request->names;
        $title = $request->title;
        $detail = $request->detail;
        $dateMake = $request->dateMake;
        $doctorPo = explode('|', $request->doctor);
        $doctor = $doctorPo[0];
        $positionDoc = (count($doctorPo) > 1) ? $doctorPo[1] : '';
        $positionDoc2 = (count($doctorPo) > 2) ? $doctorPo[2] : '';
        $page = View($this->part_doc . 'doc_report_Reccomment', ['year' => $year,
            'round' => $round_no,
            'name' => $name,
            'detail' => $detail,
            'dateMake' => $dateMake,
            'title' => $title,
            'doctor' => $doctor,
            'positionDoc' => $positionDoc, 'positionDoc2' => $positionDoc2])->render();



        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $options->setIsPhpEnabled(true);
        $options->setDebugKeepTemp(true);
        $options->setIsHtml5ParserEnabled(true);

        $options->set('defaultFont', 'THSarabunNew');
        $pdf = new Dompdf($options);
        $pdf->loadHtml((string) $page);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        return $pdf->stream("CU_Report_recommendation.pdf");
    }

    public function sentMailGS03(Request $request) {
        try {
            if ($request) {
                $curr_act_id = $request->curr_act_id;
                $applications = json_decode($request->application);

                $currs = $this->CurriculumRepo->searchByCriteria(null, $curr_act_id, null, null, null, null, null, null, true, false, null, null, null);
                $apps = $this->ApplicationRepo->getDataForMange(null, null, null, null, null, null, null, null, null, $applications);

                foreach ($currs as $curr) {


                    foreach ($apps as $app) {

                        $data = [
                            'stu_name' => $app->stu_first_name . ' ' . $app->stu_last_name,
                            'thai' => $curr->thai,
                            'coursecodeno' => $curr->coursecodeno,
                            'sub_major_name' => $curr->sub_major_name,
                            'sub_major_id' => $curr->sub_major_id,
                            'major_name' => $curr->major_name,
                            'major_id' => $curr->major_id,
                            'department_name' => $curr->department_name,
                            'department_id' => $curr->department_id,
                            'faculty_id' => $curr->faculty_id,
                            'faculty_name' => $curr->faculty_name,
                            'round_no' => $curr->round_no,
                            'semester' => $curr->semester,
                            'year' => $curr->academic_year,
                            'statusExam' => $app->exam_name,
                            'stu_name_en' => $app->stu_first_name_en . ' ' . $app->stu_last_name_en,
                            'english' => $curr->english,
                            'sub_major_name_en' => $curr->sub_major_name_en,
                            'major_name_en' => $curr->major_name_en,
                            'department_name_en' => $curr->department_name_en,
                            'faculty_name_en' => $curr->faculty_full,
                            'statusExam_en' => $app->exam_name_en
                        ];
                        if ($app->stu_email != "") {
                            Mail::send('email.gs03', $data, function($message)use ($app) {
                                $message->to($app->stu_email, $app->stu_first_name)->subject('Registration Result ');
                            });
                            Controller::WLog('Gs03 [' . $app->stu_email . ']', 'Gs03', null);
                            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                        } else {
                            Controller::WLog('Gs03 [' . $app->stu_email . ']', 'Gs03', "Invalid Email Address ({$app->stu_email})");
                            session()->flash('errorMsg', Lang::get('resource.lbError'));
                        }

                        return;
                    }
                }
            }
        } catch (Exception $e) {
            Controller::WLog('Gs03 [application_ID ' . $request->application . ']', 'Gs03', $e->getMessage());

            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function sentMailGS05(Request $request) {
        try {
            if ($request) {
                $curr_act_id = $request->curr_act_id;
                $applications = json_decode($request->application);

                $currs = $this->CurriculumRepo->searchByCriteria(null, $curr_act_id, null, null, null, null, null, null, true, false, null, null, null);
                $apps = $this->ApplicationRepo->getDataForMange(null, null, null, null, null, null, null, null, null, $applications);

                foreach ($currs as $curr) {


                    foreach ($apps as $app) {

                        $data = [
                            'stu_name' => $app->stu_first_name . ' ' . $app->stu_last_name,
                            'thai' => $curr->thai,
                            'coursecodeno' => $curr->coursecodeno,
                            'sub_major_name' => $curr->sub_major_name,
                            'sub_major_id' => $curr->sub_major_id,
                            'major_name' => $curr->major_name,
                            'major_id' => $curr->major_id,
                            'department_name' => $curr->department_name,
                            'department_id' => $curr->department_id,
                            'faculty_id' => $curr->faculty_id,
                            'faculty_name' => $curr->faculty_name,
                            'round_no' => $curr->round_no,
                            'semester' => $curr->semester,
                            'year' => $curr->academic_year,
                            'statusExam' => (($app->admission_status_id == '0' || $app->admission_status_id == 'X') ? 'ไม่ผ่านการสอบคัดเลือก' : 'ผ่านการสอบคัดเลือก' ) . ' [' . $app->admission_status_name_th . ']',
                            'stu_name_en' => $app->stu_first_name_en . ' ' . $app->stu_last_name_en,
                            'english' => $curr->english,
                            'sub_major_name_en' => $curr->sub_major_name_en,
                            'major_name_en' => $curr->major_name_en,
                            'department_name_en' => $curr->department_name_en,
                            'faculty_name_en' => $curr->faculty_full,
                            'statusExam_en' => (($app->admission_status_id == '0' || $app->admission_status_id == 'X') ? 'Not Pass' : 'Pass' ) . ' [' . $app->admission_status_name_en . ']'
                        ];

                        if ($app->stu_email != "") {
                            Mail::send('email.gs05', $data, function($message)use($app) {
                                $message->to($app->stu_email, $app->stu_first_name)->subject('Admission Result ');
                            });
                            Controller::WLog('Gs05 [' . $app->stu_email . ']', 'Gs05', null);
                            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                        } else {
                            Controller::WLog('Gs05 [' . $app->stu_email . ']', 'Gs05', "Invalid Email Address ({$app->stu_email})");
                            session()->flash('errorMsg', Lang::get('resource.lbError'));
                        }


                        return;
                    }
                }
            }
        } catch (Exception $e) {
            Controller::WLog('Gs05 [application_ID ' . $request->application . ']', 'Gs05', $e->getMessage());

            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function importApplicant() {
        return view($this->part_doc . 'manageImportApplicant');
    }

    public function importApplicantSave(Request $request) {
        try {
            $datas = json_decode($request->values, true);
            $user = (session('user_type')->user_type != 'applicant') ? session('email_address') : session('user_id');
            $cur_prog_id = $this->ApplicationRepo->getCurriculumProgram($request->curriculum_id, $request->program_id, $request->program_type_id, null);

            foreach ($datas as $data) {

                $applicant = null;
                $applicanData = $this->ApplicantRepo->getByCitizenOrEmail($data['id_card'], null);

                if (count($applicanData) == 0) {
                    $applicante = ["stu_citizen_card" => $data['id_card'],
                        "stu_first_name" => $data['name_th'],
                        "stu_last_name" => $data['lname_th'],
                        "stu_first_name_en" => $data['name_en'],
                        "stu_last_name_en" => $data['lname_en'],
                        "stu_sex" => $data['sexID'],
                        "nation_id" => $data['nationalityID'],
                        "name_title_id" => $data['title_nameID'],
                        "stu_birthdate" => ($data['birth_day']) ? strtotime($data['birth_day']) : '',
                        "stu_phone" => " ",
                        "stu_religion" => $data['religionID'],
                        "stu_password" => "",
                        "stu_email" => "",
                        "stu_addr_no" => $data['address_no'],
                        "stu_addr_village" => $data['address_moo'],
                        "stu_addr_soi" => $data['address_soi'],
                        "stu_addr_road" => $data['address_str'],
                        "district_code" => $data['address_distID'],
                        "Admission_Status" => $data['Admission_StatusID'],
                        "creator" => $user,
                        "province_id" => $data['address_provID'],
                        "stu_phone" => $data['stu_phone'],
                        "eng_test_id" => $data['eng_test_id'],
                        "eng_test_score" => $data['eng_test_score'],
                        "eng_date_taken" => $data['eng_date_taken']
                    ];

                    $result = $this->ApplicantRepo->saveApplicant($applicante, true);

                    if ($result > -1) {

                        $applicant = $result;
                        $applicanteWork = ["work_stu_position" => $data['work_position'],
                            "work_status_id" => $data['work_statusID'],
                            "app_work_status" => 1,
                            "work_stu_detail" => $data['work_place_name'],
                            "creator" => $user,
                            "applicant_id" => $applicant];
                        $result = $this->ApplicantRepo->saveWorkApplicant($applicanteWork);


                        if ($data['university_id'] != "" && $data['university_id'] != null) {
                            $applicantedu = [ "edu_pass_id" => $data['edu_pass_id'],
                                "university_id" => $data['university_id'],
                                "grad_level" => "BACHELOR",
                                "edu_gpax" => $data['edu_gpax'],
                                "edu_faculty" => $data['edu_faculty'],
                                "edu_major" => $data['edu_major'],
                                "edu_degree" => $data['edu_degree'],
                                "creator" => $user,
                                "applicant_id" => $applicant];
                            $result = $this->ApplicantRepo->saveEduApplicant($applicantedu);
                        }

                        if ($data['university_idM'] != "" && $data['university_idM'] != null) {
                            $applicantedum = [ "edu_pass_id" => $data['edu_pass_idM'],
                                "university_id" => $data['university_idM'],
                                "grad_level" => "MASTER",
                                "edu_gpax" => $data['edu_gpaxM'],
                                "edu_faculty" => $data['edu_facultyM'],
                                "edu_major" => $data['edu_majorM'],
                                "edu_degree" => $data['edu_degreeM'],
                                "creator" => $user,
                                "applicant_id" => $applicant];
                            $result = $this->ApplicantRepo->saveEduApplicant($applicantedum);
                        }
                    }
                } else {
                    $applicant = $applicanData->applicant_id;
                }
                if ($applicant != null) {

                    $application = ["applicant_id" => $applicant,
                        "stu_citizen_card" => $data['id_card'],
                        "curr_act_id" => $request->curr_act_id,
                        "curriculum_id" => $request->curriculum_id,
                        "program_id" => $request->program_id,
                        "exam_status" => 2,
                        "admission_status_id" => $data['Admission_StatusID'],
                        "curr_prog_id" => $cur_prog_id->curr_prog_id,
                        "sub_major_id" => $request->sub_major_id,
                        "creator" => $user,
                        "modifier" => $user
                    ];

                    DB::table('application')->where('curr_act_id', $request->curr_act_id)
                            ->where('applicant_id', $applicant)
                            ->where('curriculum_id', $request->curriculum_id)
                            ->where('program_id', $request->program_id)
                            ->where('sub_major_id', $request->sub_major_id)
                            ->delete();

                    $result = $this->ApplicationRepo->saveApplication($application);

                    $application2 = ["application_id" => $result->application_id,
                        "modifier" => $user,
                        "flow_id" => 5
                    ];
                    $result = $this->ApplicationRepo->saveApplication($application2);
                }
            }
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return "true";
        } catch (Exception $e) {
            Controller::WLog('Gs03 [application_ID ' . $request->application . ']', 'Gs03', $e->getMessage());
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return "false";
        }
    }

    public function manageNews() {
        $data = $this->NewsRepo->getNewsAll();
        return view('backoffice.news_announcement.news_management', ['datas' => $data]);
    }

    public function DeleteNews(Request $request) {
        $res = $this->NewsRepo->DeleteNews($request->id);
        return ($res) ? 'true' : 'false';
    }

    public function editNews($id) {
        $news_id = null;
        $news_title = null;
        $news_detail = null;
        $news_title_en = null;
        $news_detail_en = null;
        $news_seq = null;
        $news_is_active = null;
        if ($id != 0) {
            $data = $this->NewsRepo->find($id);
            $news_id = $id;
            $news_title = $data->news_title;
            $news_detail = $data->news_detail;
            $news_title_en = $data->news_title_en;
            $news_detail_en = $data->news_detail_en;
            $news_seq = $data->news_seq;
            $news_is_active = $data->news_is_active;
        }
        return view('backoffice.news_announcement.news_edit', ['news_id' => $news_id
            , 'news_title' => $news_title
            , 'news_detail' => $news_detail
            , 'news_title_en' => $news_title_en
            , 'news_detail_en' => $news_detail_en
            , 'news_seq' => $news_seq
            , 'news_is_active' => $news_is_active]);
    }

    public function SaveNews(Request $request) {

        if ($request->news_title != '' && $request->news_title_en != '') {

            $res = $this->NewsRepo->save($request->all());
            if ($res) {
                session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                return redirect('admin/manageNews');
            } else {
                session()->flash('errorMsg', Lang::get('resource.lbError'));
                return back();
            }
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function manageAnnounc() {

        $data = $this->AnnouncementRepo->getAnnouncementAll();
        return view('backoffice.news_announcement.announcement_management', ['datas' => $data]);
    }

    public function DeleteAnnounc(Request $request) {
        $res = $this->AnnouncementRepo->delete($request->id);
        return ($res) ? 'true' : 'false';
    }

    public function editAnnounc($id) {
        $anno_id = null;
        $anno_title = null;
        $anno_detail = null;
        $anno_title_en = null;
        $anno_detail_en = null;
        $anno_seq = null;
        $anno_flag = null;
        if ($id != 0) {
            $data = $this->AnnouncementRepo->find($id);
            $anno_id = $id;
            $anno_title = $data->anno_title;
            $anno_detail = $data->anno_detail;
            $anno_title_en = $data->anno_title_en;
            $anno_detail_en = $data->anno_detail_en;
            $anno_seq = $data->anno_seq;
            $anno_flag = $data->anno_flag;
        }
        return view('backoffice.news_announcement.announcement_edit', ['anno_id' => $anno_id
            , 'anno_title' => $anno_title
            , 'anno_detail' => $anno_detail
            , 'anno_title_en' => $anno_title_en
            , 'anno_detail_en' => $anno_detail_en
            , 'anno_seq' => $anno_seq
            , 'anno_flag' => $anno_flag]);
    }

    public function SaveAnnounc(Request $request) {

        if ($request->anno_title != '' && $request->anno_title_en != '') {

            $res = $this->AnnouncementRepo->saveAnnouncement($request->all());
            if ($res) {
                session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                return redirect('admin/manageAnnounc');
            } else {
                session()->flash('errorMsg', Lang::get('resource.lbError'));
                return back();
            }
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    //Report
    public function showReportGS03() {
        return view('backoffice.reports.report_GS03');
    }

    public function showReportGS05() {
        return view('backoffice.reports.report_GS05');
    }

    public function showReportB21() {
        return view('backoffice.reports.report_B21');
    }

    public function showNewsSourceSumApplicant() {
        return view('backoffice.reports.report_News_Source');
    }

    public function showReportforeigner() {
        $fac = $this->FacultyRepo->all();
        $progType = $this->ProgramType->all();
        return view('backoffice.reports.report_Exam_foreigner', ["facs" => $fac, "progTypes" => $progType]);
    }

    public function showReportExamMore() {

        $fac = $this->FacultyRepo->all();
        $progType = $this->ProgramType->all();

        return view('backoffice.reports.report_Exam_More', ["facs" => $fac, "progTypes" => $progType]);
    }

    public function printRegisterCourseReport($flow, $curr_act_id, $sub_major, $program_type_id, $thaiDegree, $program_id, $print, $suser, $sposistion, $txt1, $reportNmae) {

        $status = explode(',', $flow);

        if (isset($sub_major)) {
            $sub_major_id = ($sub_major != null && $sub_major != 'null' ) ? $sub_major : null;
        } else {
            $sub_major_id = null;
        }
        $suser = ($suser == 'null') ? '' : $suser;
        $sposistion = ($sposistion == 'null') ? '' : $sposistion;

        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDiss = $this->ApplicationRepo->getDataForMangeReport(null, null, $status, null, null, null, null, $user, $curr_act_id, null, null, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role);


        if ($print == 'PDF') {
            if ($reportNmae == 'GS03') {
                $page = View('backoffice.reports.pdf.pdf_GS03', ['reports' => $curDiss, 'lbthai' => $thaiDegree, 'lbYear' => $curDiss[0]['academic_year'], 'lbsemester' => $curDiss[0]['semester'], 'datenow' => Carbon::today()->format('d-m-Y'), 'suser' => $suser, 'sposition' => $sposistion])->render();
            } else if ($reportNmae == 'GS05') {
                $page = View('backoffice.reports.pdf.pdf_GS05', ['reports' => $curDiss, 'lbthai' => $thaiDegree, 'lbYear' => $curDiss[0]['academic_year'], 'lbsemester' => $curDiss[0]['semester'], 'datenow' => Carbon::today()->format('d-m-Y'), 'suser' => $suser, 'sposition' => $sposistion])->render();
            } else if ($reportNmae == 'B21') {

                $cur1 = count($this->ApplicationRepo->getDataForMangeReport(null, null, null, null, null, null, null, $user, $curr_act_id, null, null, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role, null, null, [3])->toArray());
                $cur2 = count($this->ApplicationRepo->getDataForMangeReport(null, null, null, null, null, null, null, $user, $curr_act_id, null, "2", $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role, null, null, [4])->toArray());
                $orientation = "";
                if (count($curDiss) > 0) {
                    $orientation = 'วันที่' . $curDiss[0]->orientation_date . '  สถานที่' . $curDiss[0]->orientation_location;
                }
                $name = explode('|', $suser);
                $position = explode('|', $sposistion);
                $page = View('backoffice.reports.pdf.pdf_B21', ['reports' => $curDiss, 'orientation' => $orientation, 'cur1' => $cur1, 'cur2' => $cur2, 'lbthai' => $thaiDegree, 'lbYear' => $curDiss[0]['academic_year'], 'lbsemester' => $curDiss[0]['semester'], 'datenow' => Carbon::today()->format('d-m-Y'), 'suser' => $name[0], 'sposition' => $position[0], 'suser1' => $name[1], 'sposition1' => $position[1], "txt1" => $txt1])->render();
            }
            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $options->setIsPhpEnabled(true);
            $options->setDebugKeepTemp(true);
            $options->setIsHtml5ParserEnabled(true);

            $options->set('defaultFont', 'THSarabunNew');
            $pdf = new Dompdf($options);
            $pdf->loadHtml((string) $page);
            $pdf->setPaper('A4', 'portrait');

            $pdf->render();

            return $pdf->stream('REPORT_' . $reportNmae . ".pdf");
        } else if ($print == 'EXCEL') {
            $data = [];
            $i = 0;

            if ($reportNmae == 'GS03') {
                foreach ($curDiss as $value) {
                    array_push($data, [ "No" => ($i + 1), "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en), "มีสิทธิ์สอบ" => ((($value->exam_status == 2) ? 'ผ่าน' : '') . (($value->exam_status == 3) ? 'ไม่ผ่าน' : '')), "หมายเหตุ" => $value->exam_remark, "เลขที่ใบสมัคร" => $value->app_ida, "คะแนนภาษาอังกฤษ" => (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score)]);
                    $i = $i + 1;
                }
            } else if ($reportNmae == 'GS05') {
                foreach ($curDiss as $value) {
                    array_push($data, ["เลขที่ใบสมัคร" => $value->app_ida, "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en), "สัญชาติ" => ($value->nation_name . '[' . $value->nation_name_en . ']'), "เพศ" => (($value->stu_sex == 1) ? 'ชาย[Male]' : 'หญิง[Female]'), "รหัสโครงการ" => $value->project_id, "สถานะ" => $value->admission_status_id, "สำเร็จปริญญาตรี" => $value->bachlor_year, "สำเร็จปริญญาโท" => $value->master_year, "คะแนนภาษาอังกฤษ" => (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score), "หมายเหตุ" => $value->admission_remark]);
                }
            } else if ($reportNmae == 'B21') {
                foreach ($curDiss as $value) {
                    array_push($data, ["ที่" => ($i + 1), "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en), "สัญชาติ" => ($value->nation_name . '[' . $value->nation_name_en . ']'), "สามัญ" => (($value->admission_status_id == '5' || $value->admission_status_id == 'B' || $value->admission_status_id == 'C') ? 'ใช่' : ''), "ทดลองศึกษา" => (($value->admission_status_id == '7' || $value->admission_status_id == 'E' || $value->admission_status_id == 'D') ? 'ใช่' : ''), "สํารอง" => (($value->admission_status_id == 'A') ? 'ใช่' : ''), "GPA เกรดเฉลีย" => $value->edu_gpax, "คะแนนภาษาอังกฤษ" => (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin . '(' . $value->engTAdmin . ')' : $value->eng_test_score . '(' . $value->engT . ')'), "หมายเหตุ" => $value->admission_remark]);
                    $i = $i + 1;
                }
            }
            return $this->exportExcel('REPORT_' . $reportNmae . '.xls', $data);
        } else if ($print == 'TEXT') {
            $string = "";
            $i = 0;
            if ($reportNmae == 'GS03') {
                foreach ($curDiss as $value) {
                    $string .= ($i + 1) . ',' . $value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name . ',' . $value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en . ',' . (($value->exam_status == 2) ? 'ผ่าน' : '') . (($value->exam_status == 3) ? 'ไม่ผ่าน' : '') . ',' . $value->exam_remark . ',' . $value->app_ida . ',' . (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score . PHP_EOL);
                    $i = $i + 1;
                }
            } else if ($reportNmae == 'GS05') {
                foreach ($curDiss as $value) {
                    $string .= $value->app_ida . ',' . $value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name . ',' . $value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en . ',' . $value->nation_name . '[' . $value->nation_name_en . '],' . (($value->stu_sex == 1) ? 'ชาย[Male]' : 'หญิง[Female]') . ',' . $value->project_id . ',' . $value->admission_status_id . ',' . $value->bachlor_year . ',' . $value->master_year . ',' . $value->exam_remark . ',' . (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score) . ',' . $value->admission_remark . PHP_EOL;
                }
            } else if ($reportNmae == 'B21') {
                foreach ($curDiss as $value) {
                    $string .= ($i + 1) . ',' . ($value->name_title . ' ' . $value->stu_first_name . '  ' . $value->stu_last_name) . ',' . ($value->name_title_en . ' ' . $value->stu_first_name_en . '  ' . $value->stu_last_name_en) . ',' . ($value->nation_name . '[' . $value->nation_name_en . ']') . ',' . (($value->admission_status_id == '5' || $value->admission_status_id == 'B' || $value->admission_status_id == 'C') ? 'สามัญ' : '') . (($value->admission_status_id == '7' || $value->admission_status_id == 'E' || $value->admission_status_id == 'D') ? 'ทดลองศึกษา' : '') . (($value->admission_status_id == 'A') ? 'สํารอง' : '') . ',' . $value->edu_gpax . ',' . (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin . '(' . $value->engTAdmin . ')' : $value->eng_test_score . '(' . $value->engT . ')') . ',' . $value->admission_remark . PHP_EOL;

                    $i = $i + 1;
                }
            }

            $fileText = $string;

            $myName = 'REPORT_' . $reportNmae . ".txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName)];
            return response()->make($fileText, 200, $headers);
        }
    }

    public function printMoreExamReport($year, $semester, $roundNo, $faculty_id, $flow, $sub_major, $program_type_id, $major_id, $print) {

        $status = explode(',', $flow);


        $sub_major_id = ($sub_major != null && $sub_major != 'null' ) ? $sub_major : null;
        $major = ($major_id != null && $major_id != 'null' ) ? $major_id : null;
        $faculty = ($faculty_id != null && $faculty_id != 'null' ) ? $faculty_id : null;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDiss = $this->ApplicationRepo->getDataMoreThanOneMajorForMangeReport(null, null, $status, $semester, $year, $roundNo, null, $user, null, null, null, $sub_major_id, null, $program_type_id, session('user_type')->user_role, $major, $faculty);


        if ($print == 'PDF') {

            $page = View('backoffice.reports.pdf.pdf_MoreExam', ['reports' => $curDiss, 'lbYear' => $curDiss[0]['academic_year'], 'lbsemester' => $curDiss[0]['semester'], 'datenow' => Carbon::today()->format('d-m-Y')])->render();

            $options = new Options();
            $options->setIsRemoteEnabled(true);
            $options->setIsPhpEnabled(true);
            $options->setDebugKeepTemp(true);
            $options->setIsHtml5ParserEnabled(true);

            $options->set('defaultFont', 'THSarabunNew');
            $pdf = new Dompdf($options);
            $pdf->loadHtml((string) $page);
            $pdf->setPaper('A4', 'portrait');

            $pdf->render();

            return $pdf->stream("ReportMoreThan1.pdf");
        } else if ($print == 'EXCEL') {
            $data = [];
            $i = 0;
            foreach ($curDiss as $value) {
                array_push($data, ["No" => ($i + 1), "เลขที่ใบสมัคร" => $value->app_ida, "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en), "หลักสูตร" => $value->majorcode, "ชื่อหลักสูตร" => $value->prog_name, "รหัสประเภทหลักสูตร" => $value->cond_id, "ประเภทหลักสูตร" => ($value->degree_level_name . ' ' . $value->office_time), "หมายเหตุ" => $value->admission_remark]);
                $i = $i + 1;
            }
            return $this->exportExcel('ReportMoreThan1', $data);
        } else if ($print == 'TEXT') {
            $string = '';
            $i = 0;

            foreach ($curDiss as $value) {
                $string .= ($i + 1) . ',' . $value->app_ida . ',' . $value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name . ',' . $value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en . ',' . $value->majorcode . ',' . $value->prog_name . ',' . $value->cond_id . ',' . $value->degree_level_name . ' ' . $value->office_time . ',' . $value->admission_remark . PHP_EOL;
                $i = $i + 1;
            }
            $fileText = $string;
            $myName = "ReportMoreThan1.txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName)];
            return response()->make($fileText, 200, $headers);
        }
    }

    public function printForeignerReport($year, $semester, $roundNo, $faculty_id, $flow, $sub_major, $program_type_id, $major_id, $print) {

        $status = explode(',', $flow);

        $roundNos = ($roundNo == 'null') ? null : $roundNo;
        $program_type_ids = ($program_type_id == 'null') ? null : $program_type_id;

        $sub_major_id = ($sub_major != null && $sub_major != 'null' ) ? $sub_major : null;
        $major = ($major_id != null && $major_id != 'null' ) ? $major_id : null;
        $faculty = ($faculty_id != null && $faculty_id != 'null' ) ? $faculty_id : null;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;
        $curDiss = $this->ApplicationRepo->getforeignerReport(null, null, $status, $semester, $year, $roundNos, null, $user, null, null, null, $sub_major_id, null, $program_type_ids, session('user_type')->user_role, $major, $faculty);

        if ($print == 'EXCEL') {
            $data = [];
            $i = 0;
            foreach ($curDiss as $value) {
                array_push($data, ["No" => ($i + 1), "เลขประจำตัวประชาชน" => $value->stu_citizen_card, "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en), "สัญชาติ" => $value->nation_name . ' ' . $value->nation_name_en, "หลักสูตร" => $value->majorcode, "ชื่อหลักสูตร" => $value->prog_name, "รหัสประเภทหลักสูตร" => $value->cond_id, "ประเภทหลักสูตร" => ($value->degree_level_name . ' ' . $value->office_time), "สาขาวิชา" => $value->major_name, "ภาควิชา" => $value->department_name, "คณะ" => $value->faculty_name, "สถานะ" => $value->flow_name]);
                $i = $i + 1;
            }
            return $this->exportExcel('ReportForeignerExam', $data);
        } else if ($print == 'TEXT') {
            $string = '';
            $i = 0;

            foreach ($curDiss as $value) {
                $string .= ($i + 1) . ',' . $value->stu_citizen_card . ',' . $value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name . ',' . $value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en . ',' . $value->nation_name . ' ' . $value->nation_name_en . ',' . $value->majorcode . ',' . $value->prog_name . ',' . $value->cond_id . ',' . $value->degree_level_name . ' ' . $value->office_time . ',' . $value->major_name . ',' . $value->department_name . ',' . $value->faculty_name . ',' . $value->flow_name . PHP_EOL;
                $i = $i + 1;
            }
            $fileText = $string;
            $myName = "ReportForeignerExam.txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName)];
            return response()->make($fileText, 200, $headers);
        }
    }

    public function getRegisterCourseMoreReport(Request $request = null) {

        $status = explode(',', $request->flow);
        $semester = $request->semester;
        $year = $request->year;
        $roundNo = $request->roundNo;
        $criteria = $request->criteria;
        $curr_act_id = $request->curr_act_id;
        $exam_status = $request->exams;
        $program_id = $request->program_id;
        $major_id = $request->major_id;
        $faculty_id = $request->faculty_id;

        if (isset($request->sub_major_id)) {
            $sub_major_id = ($request->sub_major_id != null) ? $request->sub_major_id : '-1';
        } else {
            $sub_major_id = null;
        }

        $program_type_id = $request->program_type_id;

        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataMoreThanOneMajorForMangeReport(null, null, $status, $semester, $year, $roundNo, $criteria, $user, $curr_act_id, null, $exam_status, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role, $major_id, $faculty_id);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function getforeignerReport(Request $request = null) {

        $status = explode(',', $request->flow);
        $semester = $request->semester;
        $year = $request->year;
        $roundNo = ($request->roundNo == 'null') ? null : $request->roundNo;
        $program_type_id = ($request->program_type_id == 'null') ? null : $request->program_type_id;
        $criteria = $request->criteria;
        $curr_act_id = $request->curr_act_id;
        $exam_status = $request->exams;
        $program_id = $request->program_id;
        $major_id = $request->major_id;
        $faculty_id = $request->faculty_id;

        if (isset($request->sub_major_id)) {
            $sub_major_id = ($request->sub_major_id != null) ? $request->sub_major_id : '-1';
        } else {
            $sub_major_id = null;
        }


        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getforeignerReport(null, null, $status, $semester, $year, $roundNo, $criteria, $user, $curr_act_id, null, $exam_status, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role, $major_id, $faculty_id);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function getRegisterCourseReport(Request $request = null) {

        $status = explode(',', $request->flow);
        $semester = $request->semester;
        $year = $request->year;
        $roundNo = $request->roundNo;
        $criteria = $request->criteria;
        $curr_act_id = $request->curr_act_id;
        $exam_status = $request->exams;
        $program_id = $request->program_id;
        $major_id = $request->major_id;
        $faculty_id = $request->faculty_id;

        if (isset($request->sub_major_id)) {
            $sub_major_id = ($request->sub_major_id != null) ? $request->sub_major_id : '-1';
        } else {
            $sub_major_id = null;
        }

        $program_type_id = $request->program_type_id;

        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMangeReport(null, null, $status, $semester, $year, $roundNo, $criteria, $user, $curr_act_id, null, $exam_status, $sub_major_id, $program_id, $program_type_id, session('user_type')->user_role, $major_id, $faculty_id);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function getDataNewsSourceSumApplicant(Request $request = null) {

        $semester = $request->semester;
        $year = $request->year;

//        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataNewsSourceSumApplicant($year, $semester);

        return ['data' => $curDiss, 'recordsTotal' => count($curDiss), 'recordsFiltered' => count($curDiss)];
    }

    public function printDataNewsSourceSumApplicant($year, $semester, $print) {
        $curDiss = $this->ApplicationRepo->getDataNewsSourceSumApplicant($year, $semester);


        if ($print == 'EXCEL') {
            $data = [];
            $i = 0;
            foreach ($curDiss as $value) {
                array_push($data, ["No" => ($i + 1), "ชื่อแหล่งข่าว" => $value->news_source_name, "จำนวน" => $value->cnum]);
            }
            return $this->exportExcel('ReportNewsSourceSumApplicant', $data);
        } else if ($print == 'TEXT') {
            $string = '';
            $i = 0;

            foreach ($curDiss as $value) {
                $string .= ($i + 1) . ',' . $value->news_source_name . ',' . $value->cnum . PHP_EOL;
                $i = $i + 1;
            }
            $fileText = $string;
            $myName = "ReportNewsSourceSumApplicant.txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName), 'Content-Length' => sizeof($fileText)];
            return response()->make($fileText, 200, $headers);
        }
    }

    public function getGrantsReport(Request $request = null) {

        $semester = $request->semester;
        $year = $request->year;
        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMangeReport(null, null, null, $semester, $year, null, null, $user, null, null, null, null, null, null, session('user_type')->user_role, null, null);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function grantsReport() {
        return view('backoffice.reports.report_Grants');
    }

    public function printGrantsReport($year, $semester, $print) {

        $user = (session('user_type')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMangeReport(null, null, null, $semester, $year, null, null, $user, null, null, null, null, null, null, session('user_type')->user_role, null, null, null, 1);

        if ($print == 'EXCEL') {
            $data = [];
            $i = 0;
            foreach ($curDiss as $value) {
                array_push($data, ["No" => ($i + 1), "เลขประจำตัวประชาชน" => $value->stu_citizen_card, "ชื่อ-สกุล" => ($value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name), "ชื่อ-สกุล(ภาษาอังกฤษ)" => ($value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en), "คะแนนภาษาอังกฤษ" => (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score), "GPAX ป.ตรี" => $value->edu_gpax, "GPAX ป.โท" => $value->edu_gpaxM, "หลักสูตร" => $value->majorcode, "ชื่อหลักสูตร" => $value->prog_name, "รหัสประเภทหลักสูตร" => $value->cond_id, "ประเภทหลักสูตร" => ($value->degree_level_name . ' ' . $value->office_time), "สาขาวิชา" => $value->major_name, "ภาควิชา" => $value->department_name, "คณะ" => $value->faculty_name, "สถานะ" => $value->flow_name]);
                $i = $i + 1;
            }
            return $this->exportExcel('ReportGrants', $data);
        } else if ($print == 'TEXT') {
            $string = '';
            $i = 0;

            foreach ($curDiss as $value) {

                $string .= ($i + 1) . ',' . $value->stu_citizen_card . ',' . $value->name_title . ' ' . $value->stu_first_name . ' ' . $value->stu_last_name . ',' . $value->name_title_en . $value->stu_first_name_en . $value->stu_last_name_en . ',' . (($value->eng_test_score_admin != null) ? $value->eng_test_score_admin : $value->eng_test_score) . ',' . $value->edu_gpax . ',' . $value->edu_gpaxM . ',' . $value->majorcode . ',' . $value->prog_name . ',' . $value->cond_id . ',' . $value->degree_level_name . ' ' . $value->office_time . ',' . $value->major_name . ',' . $value->department_name . ',' . $value->faculty_name . ',' . $value->flow_name . PHP_EOL;



                $i = $i + 1;
            }
            $fileText = $string;
            $myName = "ReportGrants.txt";
            $headers = ['Content-type' => 'text/plain', 'Content-Disposition' => sprintf('attachment; filename="%s"', $myName), 'Content-Length' => sizeof($fileText)];
            return response()->make($fileText, 200, $headers);
        }
    }

}

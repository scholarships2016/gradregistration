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

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl $DepRepo, ProgramTypeRepositoryImpl $ProgramType, BankRepositoryImpl $BankRepo, DocumentsApplyRepositoryImpl $DocumentApply, ApplicationPeopleRefRepositoryImpl $ApplicationPeopleRef
    , CurriculumRepositoryImpl $CurriculumRepo, CurriculumSubMajorRepositoryImpl $SubCurriculumRepo, CurriculumProgramRepositoryImpl $CurriculumProgramRepo
    , ApplicationRepositoryImpl $ApplicationRepo, ApplicationDocumentFileRepositoryImpl $ApplicationDocumentFileRepo, FileRepositoryImpl $FileRepo
    , SatisfactionRepositoryImpl $SatisfactionRepo, ApplicantRepositoryImpl $ApplicantRepo, TblExamStatusRepositoryImpl $ExamStatus
    , TblAdmissionStatusRepositoryImpl $AdmissionStatus) {
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
                $gdata = ['application_id' => $request->application_id,
                    'payment_date' => Carbon::now(),
                    'exam_status'=>1,
                    'flow_id' => 3];
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
        $curDiss = $this->ApplicationRepo->getDataForMange(null, $application_id, null, null, null, null, null, null, null, null, null, null, null, null);

        return ['data' => $curDiss, 'recordsTotal' => $curDiss->count(), 'recordsFiltered' => $curDiss->count()];
    }

    public function savePayment(Request $request) {

        $gdata = ['application_id' => $request->application_id,
            'payment_date' => $request->payment_date,
            'receipt_book' => $request->receipt_book,
            'receipt_no' => $request->receipt_no,
            'bank_id' => $request->bank_id,
            'exam_status' => 1,
            'flow_id' => $request->flow_id];
        $res = $this->ApplicationRepo->saveApplication($gdata);
        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
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
        $sub_major_id = $request->sub_major_id;
        $program_type_id = $request->program_type_id;

        $user = (session('user_tyep')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMange(null, null, $status, $semester, $year, $roundNo, $criteria, $user, $curr_act_id, null, $exam_status, $sub_major_id, $program_id, $program_type_id);
 
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
        return view('Apply.confDocApply', ['Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Datas' => $Datas, 'Files' => $files, 'programID' => $pid]);
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
        $curDiss = $this->CurriculumRepo->searchByCriteria(null, null, null, null, null, null, null, null, true, false, $academic_year, $semester, $round_no);
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

        if ($request->exam_remark) {
            $data = ['exam_remark' => $request->exam_remark, 'application_id' => $request->application_id];
        }
        if ($request->exam_status) {
            $flow_id = ($request->exam_status == 2 || $request->exam_status == 3 ) ? 4 : 3;
            $data = ['exam_status' => $request->exam_status, 'flow_id' => $flow_id, 'application_id' => $request->application_id];
        }
        if ($request->exam_remark || $request->exam_status) {
            $res = $this->ApplicationRepo->saveApplication($data);
        }

        if ($request->admission_remark) {
            $data = ['admission_remark' => $request->admission_remark, 'application_id' => $request->application_id];
        }

        if ($request->admission_status_id || $request->admission_status_id == "0") {
            $flow_id = ($request->admission_status_id != 'X' && $request->admission_status_id != '0') ? 5 : 4;
            $data = ['admission_status_id' => $request->admission_status_id, 'flow_id' => $flow_id, 'application_id' => $request->application_id];
        }
        if ($request->admission_remark || $request->admission_status_id || $request->admission_status_id == "0") {
            $res = $this->ApplicationRepo->saveApplication($data);
        }




        if ($request->eng_test_id_admin) {
            $data = ['eng_test_id_admin' => $request->eng_test_id_admin, 'applicant_id' => $request->applicant_id];
        }
        if ($request->eng_test_score_admin) {
            $data = ['eng_test_score_admin' => $request->eng_test_score_admin, 'applicant_id' => $request->applicant_id];
        }
        if ($request->eng_date_taken_admin) {
            $data = ['eng_date_taken_admin' => $request->eng_date_taken_admin, 'applicant_id' => $request->applicant_id];
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
                    'special_apply_comment' => $request->apply_comment,
                    'creator' => session('user_id'),
                    'modifier' => session('user_id'),
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
            if ($request) {
                $data = ['curr_act_id' => $request->curr_act_id,
                    'sub_major_id' => $request->sub_major_id,
                    'program_id' => $request->program_id,
                    'program_type_id' => $request->program_type_id,
                    'stu_citizen_card' => $request->idCard,
                    'curriculum_id' => $request->curriculum_id,
                    'flow_id' => 1,
                    'bank_id' => 10,
                    'special_admission_by' => session('user_id'),
                    'special_admission_date' => Carbon::now(),
                    'spacial_admission_comment' => $request->apply_comment,
                    'creator' => session('user_id'),
                    'modifier' => session('user_id'),
                    'exam_status' => 2,
                    'applicant_id' => $request->applicant_ID];
                $res = $this->ApplicationRepo->saveApplication($data);
                $dataup = ['application_id' => $res->application_id, 'flow_id' => 4];
                $res = $this->ApplicationRepo->saveApplication($dataup);
            }
        } catch (Exception $e) {
            Controller::WLog('addUserExam( ApplicaintID[ ' . $request->application . ']', 'Gs03', $e->getMessage());
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function ShowRecommenReport($id) {
        $application_id = $id;
        $curDis = $this->ApplicationRepo->getDataForMange(null, $application_id, null, null, null, null, null, null, null, null, null, null, null, null);
      
        foreach ($curDis as $curDiss) {
        $year = $curDiss->academic_year;
        $round_no = $curDiss->round_no;
        $name = $curDiss->stu_first_name . '  ' . $curDiss->stu_last_name;
        $title = $curDiss->name_title;
        $detail = 'ได้ผ่านการสอบคัดเลือกให้เข้าศึกษา ในหลักสูตร'.$curDiss->major_name.' สาขาวิชา'. $curDiss->degree_name.'  คณะ'.$curDiss->faculty_name.'  จุฬาลงกรณ์มหาวิทยาลัย   ภาคการศึกษา'.(($curDiss->semester == 1)?'ต้น':'ปลาย').'   ปีการศึกษา  '.$curDiss->academic_year;
        $dateMake = $this->ConvertDateThaiNotWeek(Carbon::now());
        $approve = TblCertificateApprover::all();
        return view($this->part_doc . 'manage_report_Recommentdation', ['year' => $year, 'round' => $round_no, 'name' => $name, 'detail' => $detail, 'dateMake' => $dateMake, 'title'  => $title,'approves'=>$approve]);
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
        $positionDoc2 =  (count($doctorPo) > 2) ? $doctorPo[2] : '';
        $page = View($this->part_doc . 'doc_report_Reccomment', ['year' => $year,
            'round' => $round_no,
            'name' => $name,
            'detail' => $detail,
            'dateMake' => $dateMake,
            'title' => $title,
            'doctor' => $doctor,
            'positionDoc' => $positionDoc,'positionDoc2'=>$positionDoc2])->render();



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
                $applications =  json_decode($request->application);

                $currs = $this->CurriculumRepo->searchByCriteria(null, $curr_act_id, null, null, null, null, null, null, true, false, null, null, null) ;
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
                            'faculty_name' => $curr->stu_email,
                            'semester' => $curr->semester . ' รอบที่' . $curr->round_no,
                'year' => $curr->academic_year,
                'statusExam' => $app->exam_name
                ];
                Mail::send('email.gs03', $data, function($message)use ($app) {
                $message->to($app->stu_email, $app->stu_first_name)->subject('Registration Result ');
                });
                Controller::WLog('Gs03 [' . $app->stu_email . ']', 'Gs03', null);

                session()->flash('successMsg', Lang::get('resource.lbSuccess'));
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
                $apps = $this->ApplicationRepo->getDataForMange(null, null, null,  null, null, null, null, null, null, $applications);

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
                'faculty_name' => $curr->stu_email,
                'semester' => $curr->semester . ' รอบที่' . $curr->round_no,
                'year' => $curr->academic_year,
                'statusExam' => (($app->admission_status_id == '0' || $app->admission_status_id == 'X') ?  'ไม่ผ่านการสอบคัดเลือก' :  'ผ่านการสอบคัดเลือก' )  . '[' . $app->admission_status_name_th . ']'
                ];
                Mail::send('email.gs05', $data, function($message)use($app) {
                $message->to($app->stu_email, $app->stu_first_name)->subject('Admission Result ');
                });
                Controller::WLog('Gs05 [' . $app->stu_email . ']', 'Gs05', null);

                session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                return;
                }
                }
                }
                } catch(Exception $e) {
                Controller::WLog('Gs03 [application_ID ' . $request->application . ']', 'Gs03', $e->getMessage());

                session()->flash('errorMsg', Lang::get('resource.lbError'));
                }
                }

                }
               

        

         
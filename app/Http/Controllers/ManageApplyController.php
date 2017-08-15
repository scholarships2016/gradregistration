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

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl $DepRepo, ProgramTypeRepositoryImpl $ProgramType, BankRepositoryImpl $BankRepo, DocumentsApplyRepositoryImpl $DocumentApply, ApplicationPeopleRefRepositoryImpl $ApplicationPeopleRef
    , CurriculumRepositoryImpl $CurriculumRepo, CurriculumSubMajorRepositoryImpl $SubCurriculumRepo, CurriculumProgramRepositoryImpl $CurriculumProgramRepo
    , ApplicationRepositoryImpl $ApplicationRepo, ApplicationDocumentFileRepositoryImpl $ApplicationDocumentFileRepo, FileRepositoryImpl $FileRepo
    , SatisfactionRepositoryImpl $SatisfactionRepo, ApplicantRepositoryImpl $ApplicantRepo, TblExamStatusRepositoryImpl $ExamStatus) {
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
    }

    public function showManagePay() {
        $Bank = $this->BankRepo->getBank();

        return view($this->part_doc . 'manage_pay', ['banks' => $Bank]);
    }

    public function savePayment(Request $request) {

        $gdata = ['application_id' => $request->application_id,
            'payment_date' => $request->payment_date,
            'receipt_book' => $request->receipt_book,
            'receipt_no' => $request->receipt_no,
            'bank_id' => $request->bank_id,
            'flow_id' => $request->flow_id];
        $res = $this->ApplicationRepo->saveApplication($gdata);
        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
        }
    }

    public function getRegisterCourse(Request $request = null) {
       
        $status = $request->flow;
        $semester = $request->semester;
        $year = $request->year;
        $roundNo = $request->roundNo;
        $criteria = $request->criteria;
        $curr_act_id = $request->curr_act_id;
        
        $user = (session('user_tyep')->user_role != 1) ? session('user_id') : null;

        $curDiss = $this->ApplicationRepo->getDataForMange(null, null, $status, $semester, $year, $roundNo, $criteria, $user,$curr_act_id);

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

        return view($this->part_doc . 'manage_status_applicant');
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

    public function getEngTest() {
        $exam = \App\Models\TblEngTest::get();
        return response()->json($exam);
    }

    public function updateApplication(Request $request = null) {
        $data = '';
       
        if ($request->exam_remark)
            $data = ['exam_remark' => $request->exam_remark, 'application_id' => $request->application_id];
        if ($request->exam_status)
            $data = ['exam_status' => $request->exam_status, 'application_id' => $request->application_id];
        if ($request->exam_remark || $request->exam_status) {
            $res = $this->ApplicationRepo->saveApplication($data);
        }

        if ($request->eng_test_id_admin)
            $data = ['eng_test_id_admin' => $request->eng_test_id_admin, 'applicant_id' => $request->applicant_id];
        if ($request->eng_test_score_admin)
            $data = ['eng_test_score_admin' => $request->eng_test_score_admin, 'applicant_id' => $request->applicant_id];
        if ($request->eng_date_taken_admin)
            $data = ['eng_date_taken_admin' => $request->eng_date_taken_admin, 'applicant_id' => $request->applicant_id];
        if ($request->eng_test_id_admin || $request->eng_test_score_admin || $request->eng_date_taken_admin) {
            $res = $this->ApplicantRepo->saveApplicant($data);
        }


        return $res;
    }
    
   public function sentMail(Request $request){
       if($request){
       $curr_act_id  = $request->curr_act_id;
       $applications = $arrayOfEmails=json_decode($request->users);
       
       
       $curr = $this->CurriculumRepo->searchByCriteria(null, $curr_act_id, null, null, null, null, null, null, true, false, null, null, null);
       foreach ($applications as $applicationID) {
       $app = $this->ApplicationRepo->getDataForMange(null, $applicationID, null, null, null, null, null, null,null);
 
       
         $data = [
             'stu_name' => $app->stu_first_name . ' ' . $app->stu_last_name,
             'thai' =>  $curr->thai,
             'coursecodeno' => $curr->coursecodeno,
             'sub_major_name' => $curr->sub_major_name,
             'sub_major_id' => $curr->sub_major_id,
             'major_name' => $curr->major_name,
             'major_id' => $curr->major_id,
             'department_name' => $curr->department_name,
             'faculty_name' => $curr->stu_email,
             'semester' => $curr->semester.' รอบที่'.$curr->round_no,
             'year' => $curr->academic_year,
             'statusExam' => $app->exam_name
            
            ];
            Mail::send('email.gs03.blade', $data, function($message)use ($result) {
                $message->to($result->stu_email, $result->stu_first_name)->subject('Registration Result ');
            });
            Controller::WLog('Gs03 [' . $result->stu_email . ']', 'Gs03', null);
            
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            
       }
       }
    }

}

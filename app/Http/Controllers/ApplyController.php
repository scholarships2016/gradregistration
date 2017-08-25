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
use Dompdf\Options;
use Dompdf\Dompdf;
use Carbon\Carbon;
//use PhpOffice\PhpWord\Writer\PDF\DomPDF;
use Illuminate\Support\Facades\App;

class ApplyController extends Controller {

    protected $part_doc = "Apply.";
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

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl $DepRepo, ProgramTypeRepositoryImpl $ProgramType, BankRepositoryImpl $BankRepo, DocumentsApplyRepositoryImpl $DocumentApply, ApplicationPeopleRefRepositoryImpl $ApplicationPeopleRef
    , CurriculumRepositoryImpl $CurriculumRepo, CurriculumSubMajorRepositoryImpl $SubCurriculumRepo, CurriculumProgramRepositoryImpl $CurriculumProgramRepo
    , ApplicationRepositoryImpl $ApplicationRepo, ApplicationDocumentFileRepositoryImpl $ApplicationDocumentFileRepo, FileRepositoryImpl $FileRepo
    , SatisfactionRepositoryImpl $SatisfactionRepo, ApplicantRepositoryImpl $ApplicantRepo) {
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
    }

    public function index() {
        $this->show(null);
    }

    public function showAnnouncement() {
        $data = $this->AnnouncementRepo->getAnnouncementAll();
        $dataApplication = $this->ApplicationRepo->getData(session('Applicant')->applicant_id);
        return view($this->part_doc . 'announcement', ['announcements' => $data, 'startstep' => 1, 'appCount' => $dataApplication->count()]);
    }

    public function managementRegister(Request $request) {

        $faculty = $this->FacultyRepo->all();
        $typeofRec = $this->ProgramType->all();

        return view($this->part_doc . 'register', ['facultys' => $faculty, 'typeofRecs' => $typeofRec]);
    }

    public function getRegisterCourse(Request $request = null) {

        $curDiss = $this->CurriculumRepo->searchByCriteria(null, null, $request->search, $request->faculty_id, $request->degree_id, 1, 4, $request->program_id, true, false);

        return ['data' => $curDiss, 'iDisplayLength' =>  $curDiss->count(), 'iDisplayStart' => 0];
    }

    public function registerCourse($id) {

        $Bank = $this->BankRepo->getBank();
        $Qus = $this->ApplicationRepo->getData(null, $id);
        $Data = $this->ApplicationRepo->find($id);
        $Sat = $this->SatisfactionRepo->getById(session('Applicant')->stu_citizen_card);

        return view($this->part_doc . 'registerCourse', ['banks' => $Bank, 'idApp' => $id, 'Datas' => $Data, 'Sats' => $Sat, 'Qus' => $Qus->all()]);
    }

    public function getPeopoleRef($id) {
        $people = $this->ApplicationPeopleRef->getDetail($id);
        return ['data' => $people, 'iDisplayLength' => 100, 'iDisplayStart' => 0];
    }

    public function savePeopoleRef(Request $request) {

        $datas = json_decode($request->values, true);
        $data = ['bank_id' => $request->bank_id, 'application_id' => $request->application_id, 'additional_answer' => $request->additional_answer];
        $this->ApplicationRepo->saveApplication($data);
        if ($request->SATI_LEVEL != "") {
            $SData = ['SATI_LEVEL' => $request->SATI_LEVEL, 'SATI_SUGGESTION' => $request->SATI_SUGGESTION, 'stu_citizen_card' => session('Applicant')->stu_citizen_card];
            $this->SatisfactionRepo->save($SData);
        }
        foreach ($datas as $data) {
            $people = $this->ApplicationPeopleRef->save($data);
            if (!$people)
                break;
        }
        if ($people) {
            $this->actionCourse('conf', $request->application_id);
            Controller::WLog('Confirmation People Reference', 'Enroll', null);
            return redirect('apply/manageMyCourse');
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function registerDetailForapply($id) {
        $curDiss = $this->CurriculumRepo->searchByCriteria($id, null, null, null, null, 1, 4, null, true, false);
        $subMajor = $this->SubCurriculumRepo->getSubMajorByCurriculum_id($curDiss[0]->curriculum_id);
        $program = $this->CurriculumProgramRepo->getCurriculumProgramByCurriculum_id($curDiss[0]->curriculum_id);
        return view($this->part_doc . 'registerDetailForapply', ['curDiss' => $curDiss, 'subMajors' => $subMajor, 'programs' => $program]);
    }

    public function docMyCourse($id) {

        $dataApplication = $this->ApplicationRepo->getData(null, $id);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);
        $people = $this->ApplicationPeopleRef->getDetail($id);
        $DocumentApplys = $this->DocumentApply->getDetail();
        $DocumentApplyGroup = $this->DocumentApply->getGroup();
        $files = $this->ApplicationDocumentFileRepo->GetData($id);
        $pic = $this->FileRepo->getImageFileAsBase64ById($applicantProfile['applicant']->stu_img);
        $age = Carbon::parse($applicantProfile['applicant']->stu_birthdate)->diff(Carbon::now())->format('%y ปี[year], %m เดือน[month]  %d วัน[day]');


        return view($this->part_doc . 'docMyCourse', ['apps' => $dataApplication,
            'applicant' => $applicantProfile['applicant']
            , 'appEdus' => $applicantProfile['applicantEdu']
            , 'appapplicantWorks' => $applicantProfile['applicantWork']
            , 'peoples' => $people
            , 'Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Files' => $files
            , 'age' => $age, 'id' => $id, 'pictrue' => $pic]);
    }

    public function docMyCourserintPDF($id) {

//        
        $dataApplication = $this->ApplicationRepo->getData(null, $id);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);
        $people = $this->ApplicationPeopleRef->getDetail($id);
        $DocumentApplys = $this->DocumentApply->getDetail();
        $DocumentApplyGroup = $this->DocumentApply->getGroup();
        $files = $this->ApplicationDocumentFileRepo->GetData($id);


        $pic = $this->doPDFImg($applicantProfile['applicant']->stu_img);

        $age = Carbon::parse($applicantProfile['applicant']->stu_birthdate)->diff(Carbon::now())->format('%y ปี[year], %m เดือน[month]  %d วัน[day]');

        $page = View($this->part_doc . 'docApplicationForm', ['apps' => $dataApplication,
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

        return $pdf->stream("CU_Application.pdf");
    }

    public function docApplicationFee($id) {
        $dataApplication = $this->ApplicationRepo->getData(null, $id);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);

        $page = view($this->part_doc . 'docApplicationFee', ['apps' => $dataApplication,'applicant' => $applicantProfile['applicant']]);

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

        return $pdf->stream("CU_ApplicationFee.pdf");
    }

    public function docApplicationEnvelop($id) {
        $dataApplication = $this->ApplicationRepo->getData(null, $id);
        $applicantProfile = $this->ApplicantRepo->getApplicantProfileAllByApplicantId(session('Applicant')->applicant_id);


        $page = view($this->part_doc . 'docApplicationEnvelop', ['apps' => $dataApplication,
            'applicant' => $applicantProfile['applicant']]);

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

        return $pdf->stream("CU_ApplicationEnvelop.pdf");
    }

    public function submitregisterDetailForapply(Request $data) {
 
        $gdata = $data->all();
        $gdata['flow_id'] = 1;
        $gdata['creator'] = session('user_id');
        $gdata['modifier'] = session('user_id');
        $gdata['applicant_id'] = session('Applicant')->applicant_id;
        $gdata['stu_citizen_card'] = session('Applicant')->stu_citizen_card;
        $program = explode('|',$data->program_data);
        if(count($program) > 0){
           $gdata['program_id']  =  $program[0];
        }
         if(count($program) > 1){
           $gdata['curr_prog_id']  =  $program[1];
        }

        $res = $this->ApplicationRepo->saveApplication($gdata);

        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return redirect('apply/manageMyCourse');
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function manageMyCourse() {
        $dataApplication = $this->ApplicationRepo->getData(session('Applicant')->applicant_id);
        $countStatus = $this->ApplicationRepo->getDatacountByStatus(session('Applicant')->applicant_id);

        return view($this->part_doc . 'manageMyCourse', ['Apps' => $dataApplication, 'CountStatus' => $countStatus]);
    }

    

    public function actionCourse($action, $id) {

        $gdata = ['modifier' => session('user_id'),
            'application_id' => $id,
            'flow_id' => ($action == 'conf') ? 2 : 0];

        $res = $this->ApplicationRepo->saveApplication($gdata);

        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return redirect('apply/manageMyCourse');
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function confDocApply($id) {
        $DocumentApplys = $this->DocumentApply->getDetail();
        $DocumentApplyGroup = $this->DocumentApply->getGroup();
        $Datas = $this->ApplicationRepo->getData(null, $id);
        $files = $this->ApplicationDocumentFileRepo->GetData($id);
        return view($this->part_doc . 'confDocApply', ['Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup, 'Datas' => $Datas, 'Files' => $files, 'programID' => $id]);
    }

    public function submitDocApply(Request $data) {
        $res = null;
        $checkbox = [];
        $file = [];
        $fileData = [];
        $docID = [];

        foreach ($data->all() as $key => $value) {

            if (strpos($key, 'box') > 0) {
                array_push($checkbox, ['application_id' => '', 'doc_apply_id' => $value]);
                array_push($docID, $value);
            }

            if (strpos($key, 'file') > 0) {
                array_push($file, ['doc_apply_id' => str_replace('pfile_ID', '', $key), 'uploadedFile' => $value]);
            }
        }

        foreach ($file as $key) {
            $dFile = null;

            if (strpos($key['uploadedFile']->getClientMimeType(), 'mage') > 0) {
                $dFile = $this->FileRepo->upload($key['uploadedFile'], \App\Utils\Util::APPLY_IMG);
            } else {
                $dFile = $this->FileRepo->upload($key['uploadedFile'], \App\Utils\Util::APPLY_DOC);
            }

            foreach ($checkbox as $chkKey) {

                if ($chkKey['doc_apply_id'] == $key['doc_apply_id']) {
                    array_push($fileData, ['application_id' => $data->application_id, 'doc_apply_id' => $chkKey['doc_apply_id'], 'file_id' => $dFile->file_id, 'other_val' => ($chkKey['doc_apply_id'] == 16) ? $data->other_val : '']);
                }
            }
        }

        $res = $this->ApplicationDocumentFileRepo->DeleteNOTIN($data->application_id, $docID);

        foreach ($fileData as $val) {
            $res = $this->ApplicationDocumentFileRepo->saveApplicationDocumentFile($val);
            if (!$res) {
                session()->flash('errorMsg', Lang::get('resource.lbError'));
                return back();
            }
        }

        if ($res) {
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            if (session('user_tyep')->user_type == 'applicant') {
                return redirect()->route('manageMyCourse');
            } else {
                return redirect()->route('showManagePay');
            }
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function getForm($id = 0) {
        if ($id != 0) {
            $degree = $this->degreeRepo->getById($id);
            if (!$degree)
                return redirect('degree/degree_form');
        }else {
            $degree = false;
        }
        return view($this->part_doc . 'degree_form', ['degree' => $degree], ['id' => $id]);
    }

    public function postForm(Request $data) {
        $this->degreeRepo->save($data->all());
        return redirect('degree');
    }

    public function delete($id) {
        $this->degreeRepo->delete($id);
        return redirect('degree');
    }

}

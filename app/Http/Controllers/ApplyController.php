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

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl $DepRepo, ProgramTypeRepositoryImpl $ProgramType, BankRepositoryImpl $BankRepo, DocumentsApplyRepositoryImpl $DocumentApply, ApplicationPeopleRefRepositoryImpl $ApplicationPeopleRef
    , CurriculumRepositoryImpl $CurriculumRepo) {
        $this->AnnouncementRepo = $AnnouncementRepo;
        $this->FacultyRepo = $FacultyRepo;
        $this->DepRepo = $DepRepo;
        $this->ProgramType = $ProgramType;
        $this->BankRepo = $BankRepo;
        $this->DocumentApply = $DocumentApply;
        $this->ApplicationPeopleRef = $ApplicationPeopleRef;
        $this->CurriculumRepo = $CurriculumRepo;
    }

    public function index() {
        $this->show(null);
    }

    public function showAnnouncement() {
        $data = $this->AnnouncementRepo->getAnnouncementAll();
        return view($this->part_doc . 'announcement', ['announcements' => $data, 'startstep' => 1]);
    }

    public function managementRegister(Request $request) {
              
        $faculty = $this->FacultyRepo->all();
        $typeofRec = $this->ProgramType->all();
         
        return view($this->part_doc . 'register', ['facultys' => $faculty, 'typeofRecs' => $typeofRec ]);
    }
     public function getRegisterCourse(Request $request=null) {        
       $curDiss = $this->CurriculumRepo->searchByCriteria(null,null,$request->search, $request->faculty_id ,$request->degree_id ,1,$request->program_id,false);
       return ['data' => $curDiss, 'iDisplayLength' => 100, 'iDisplayStart' => 0];
    }
    

    public function registerCourse() {
        $Bank = $this->BankRepo->getBank();

        return view($this->part_doc . 'registerCourse', ['banks' => $Bank]);
    }

    public function getPeopoleRef() {
        $people = $this->ApplicationPeopleRef->getDetail("1");
        return ['data' => $people, 'iDisplayLength' => 100, 'iDisplayStart' => 0];
    }

    public function savePeopoleRef(Requests\ArticleRequest $json) {
        $datas = json_decode($json, true);
        foreach ($datas as $data) {
            $people = $this->ApplicationPeopleRef->save($data);
            if (!$people)
                break;
        }
        if ($people) {
            session()->flash('successMsg', 'บันทึกสำเร็จ');
        } else {
            session()->flash('errorMsg', 'ไม่สามารถบันทึกได้');
            return back();
        }
    }

    public function registerDetailForapply($id) {
         $curDiss = $this->CurriculumRepo->searchByCriteria($id,null,null,null ,null ,1,null,false);
      
        return view($this->part_doc . 'registerDetailForapply',['curDiss' => $curDiss]);
    }

    public function manageMyCourse() {
        return view($this->part_doc . 'manageMyCourse');
    }

    public function confDocApply() {
        $DocumentApplys = $this->DocumentApply->getDetail();
        $DocumentApplyGroup = $this->DocumentApply->getGroup();
        return view($this->part_doc . 'confDocApply', ['Docs' => $DocumentApplys, 'Groups' => $DocumentApplyGroup]);
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

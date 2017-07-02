<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnnouncementRepositoryImpl;
use App\Repositories\FacultyRepositoryImpl;
use App\Repositories\DepartmentRepositoryImpl;
use App\Repositories\TypeOfRecruitRepositoryImpl;

class ApplyController extends Controller {

    protected $part_doc = "Apply.";
    protected $AnnouncementRepo;
    protected $FacultyRepo;
    protected $DepRepo;
    protected $TypeOfRecru;

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo, FacultyRepositoryImpl $FacultyRepo, DepartmentRepositoryImpl  $DepRepo, TypeOfRecruitRepositoryImpl $TypeOfRecru) {
        $this->AnnouncementRepo = $AnnouncementRepo;
        $this->FacultyRepo = $FacultyRepo;
        $this->DepRepo = $DepRepo;
        $this->TypeOfRecru = $TypeOfRecru;
    }

    public function index() {
        $this->show(null);
    }

    public function showAnnouncement() {
        $data = $this->AnnouncementRepo->getAnnouncementAll();
        return view($this->part_doc . 'announcement', ['announcements' => $data, 'startstep' => 1]);
    }

    public function managementRegister() {
        $faculty = $this->FacultyRepo->all();
        $typeofRec = $this->TypeOfRecru->all();

        return view($this->part_doc . 'register', ['facultys' => $faculty, 'typeofRecs' => $typeofRec]);
    }
    public function registerCourse() {
        return view($this->part_doc . 'registerCourse');
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

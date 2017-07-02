<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnnouncementRepositoryImpl;
use App\Repositories\ProvinceRepositoryImpl;

class ApplyController extends Controller {

    protected $part_doc = "Apply.";
    protected $AnnouncementRepo;
     protected $ProvinceRepo;

    public function __construct(AnnouncementRepositoryImpl $AnnouncementRepo,ProvinceRepositoryImpl $ProvinceRepo) {
        $this->AnnouncementRepo = $AnnouncementRepo;
         $this->ProvinceRepo = $ProvinceRepo;
    }

    public function index() {
        $this->show(null);
    }

    public function showAnnouncement() {
        $data = $this->AnnouncementRepo->getAnnouncementAll();
        return view($this->part_doc . 'announcement', ['announcements' => $data, 'startstep' => 1]);
    }

    public function managementRegister() {
//        $faculty = \App\Repositories\FacultyRepositoryImpl::all();
//        $department = \App\Repositories\Contracts\DepartmentRepository::all();
//        $Subject = ;
//        $typerecruit = "";
        $province =  $this->ProvinceRepo->all();

        return view($this->part_doc . 'register', ['provinces' => $province]);
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

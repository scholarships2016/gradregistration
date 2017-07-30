<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\DistrictRepository;
use App\Repositories\Contracts\EngTestRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\McourseStudyRepository;
use App\Repositories\Contracts\NameTitleRepository;
use App\Repositories\Contracts\NationRepository;
use App\Repositories\Contracts\NewsSourceRepository;
use App\Repositories\Contracts\ProvinceRepository;
use App\Repositories\Contracts\DepartmentRepository;
use App\Repositories\Contracts\CurriculaRepository;
use App\Repositories\Contracts\TblMajorRepository;
use App\Repositories\Contracts\TblSubMajorRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    protected $districtRepo;
    protected $provinceRepo;
    protected $engTestRepo;
    protected $nationRepo;
    protected $nameTitleRepo;
    protected $newSrcRepo;
    protected $departmentRepo;
    protected $curriculaRepo;
    protected $facultyRepo;
    protected $majorRepo;
    protected $subMajorRepo;
    protected $mcourseRepo;
    protected $applySetRepo;

    /**
     * MasterDataController constructor.
     */
    public function __construct(DistrictRepository $districtRepo, ProvinceRepository $provinceRepo,
                                EngTestRepository $engTestRepo, NationRepository $nationRepo,
                                NameTitleRepository $nameTitleRepo, NewsSourceRepository $newSrcRepo,
                                DepartmentRepository $departmentRepo, CurriculaRepository $curriculaRepo,
                                FacultyRepository $facultyRepo, TblMajorRepository $majorRepo,
                                TblSubMajorRepository $subMajorRepo, McourseStudyRepository $mcourseRepo,
                                ApplySettingRepository $applySetRepo)
    {
        $this->districtRepo = $districtRepo;
        $this->provinceRepo = $provinceRepo;
        $this->engTestRepo = $engTestRepo;
        $this->nationRepo = $nationRepo;
        $this->nameTitleRepo = $nameTitleRepo;
        $this->newSrcRepo = $newSrcRepo;
        $this->departmentRepo = $departmentRepo;
        $this->curriculaRepo = $curriculaRepo;
        $this->facultyRepo = $facultyRepo;
        $this->majorRepo = $majorRepo;
        $this->subMajorRepo = $subMajorRepo;
        $this->mcourseRepo = $mcourseRepo;
        $this->applySetRepo = $applySetRepo;
    }

    public function getDistrictByProvinceIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                if (array_key_exists('province_id', $param)) {
                    $result = Util::prepareDataForDropdownList($this->districtRepo->getDistrictByProvinceId($param['province_id']), 'district_code', 'district_name');
                    return response()->json($result);
                }
            } catch (\Exception $ex) {
                return null;
            }
        }
        return null;
    }

    public function getDepartmentByFacultyIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                if (array_key_exists('faculty_id', $param)) {
                    $result = Util::prepareDataForDropdownList($this->departmentRepo->getByfaculty_Id($param['faculty_id']), 'department_id', 'department_name');
                    return response()->json($result);
                }
            } catch (\Exception $ex) {
                return null;
            }
        }
        return null;
    }

    public function getCurriculaByDepartmentIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                if (array_key_exists('department_id', $param)) {
                    $result = Util::prepareDataForDropdownList($this->curriculaRepo->getByDepartment_Id($param['department_id']), 'curricula_id', 'curricula_name');
                    return response()->json($result);
                }
            } catch (\Exception $ex) {
                return null;
            }
        }
        return null;
    }

    public function getAllFacultyForDropdown(Request $request)
    {
        if ($request->ajax()) {
            try {

                $result = Util::prepareDataForDropdownList(json_decode($this->facultyRepo->getAllFacultyForDropdown(), true), 'faculty_id', 'faculty_full');
                return response()->json($result);
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    public function getMajorByDepartmentIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                $result = Util::prepareDataForDropdownList($this->majorRepo->getMajorByDepartmentId($param['department_id']), 'major_id', 'major_name');
                return response()->json($result);
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    public function getSubMajorByMajorIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                $result = Util::prepareDataForDropdownList($this->subMajorRepo->getSubMajorByMajorId($param['major_id']), 'sub_major_id', 'sub_major_name');
                return response()->json($result);
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    public function getMcourseStudyByMajorId(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                $result = $this->mcourseRepo->getMcourseStudyByMajorId($param['major_id']);
                return response()->json($result);
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    public function getApplySettingByAcademicYear(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                $result = $this->applySetRepo->getApplySettingByAcademicYear($param['academic_year']);
                return response()->json($result);
            } catch (\Exception $ex) {
                return null;
            }
        }
    }

    public function getApplySettingBySemesterAndAcademicYear(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                $result = $this->applySetRepo->getApplySettingBySemesterAndAcademicYear($param['semester'], $param['academic_year']);
                return response()->json($result);
            } catch (\Exception $ex) {
                throw $ex;
            }
        }
    }


}

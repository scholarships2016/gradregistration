<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepository;
use App\Repositories\Contracts\EngTestRepository;
use App\Repositories\Contracts\NameTitleRepository;
use App\Repositories\Contracts\NationRepository;
use App\Repositories\Contracts\NewsSourceRepository;
use App\Repositories\Contracts\ProvinceRepository;
use App\Repositories\Contracts\DepartmentRepository;
use App\Repositories\Contracts\CurriculaRepository;
use App\Utils\Util;
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

    /**
     * MasterDataController constructor.
     */
    public function __construct(DistrictRepository $districtRepo, ProvinceRepository $provinceRepo,
                                EngTestRepository $engTestRepo, NationRepository $nationRepo,
                                NameTitleRepository $nameTitleRepo, NewsSourceRepository $newSrcRepo,
                                DepartmentRepository $departmentRepo, CurriculaRepository $curriculaRepo)
    {
        $this->districtRepo = $districtRepo;
        $this->provinceRepo = $provinceRepo;
        $this->engTestRepo = $engTestRepo;
        $this->nationRepo = $nationRepo;
        $this->nameTitleRepo = $nameTitleRepo;
        $this->newSrcRepo = $newSrcRepo;
        $this->departmentRepo = $departmentRepo;
        $this->curriculaRepo = $curriculaRepo;
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

}

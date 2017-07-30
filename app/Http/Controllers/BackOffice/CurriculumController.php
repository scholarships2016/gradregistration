<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\CurriculumActivityRepository;
use App\Repositories\Contracts\CurriculumProgramRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Repositories\Contracts\CurriculumSubMajorRepository;
use App\Repositories\Contracts\DegreeRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\ProgramTypeRepository;
use App\Repositories\Contracts\TblProjectRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CurriculumController extends Controller
{
    protected $projectRepo;
    protected $facultyRepo;
    protected $degreeRepo;
    protected $applyRepo;
    protected $progTypeRepo;
    protected $curriculumRepo;
    protected $currActRepo;
    protected $currProgRepo;
    protected $currSubMRepo;


    /**
     * CurriculumController constructor.
     */
    public function __construct(TblProjectRepository $projectRepo,
                                FacultyRepository $facultyRepo,
                                DegreeRepository $degreeRepo,
                                ApplySettingRepository $applyRepo,
                                ProgramTypeRepository $progTypeRepo,
                                CurriculumRepository $curriculumRepo,
                                CurriculumActivityRepository $currActRepo,
                                CurriculumProgramRepository $currProgRepo,
                                CurriculumSubMajorRepository $currSubMRepo)
    {
        $this->projectRepo = $projectRepo;
        $this->facultyRepo = $facultyRepo;
        $this->degreeRepo = $degreeRepo;
        $this->applyRepo = $applyRepo;
        $this->progTypeRepo = $progTypeRepo;
        $this->curriculumRepo = $curriculumRepo;
        $this->currActRepo = $currActRepo;
        $this->currProgRepo = $currProgRepo;
        $this->currSubMRepo = $currSubMRepo;
    }

    public function showAddPage(Request $request)
    {
        try {
            $applySemesterList = $this->applyRepo->getDistinctApplySettingSemesterByAcademicYear();
            $projList = $this->projectRepo->all();
            $facList = $this->facultyRepo->all();
            $degList = $this->degreeRepo->all();
            $progTypeList = Util::prepareDataForDropdownList(json_decode($this->progTypeRepo->getAllProgramTypeForDropdown(), true), 'program_type_id', 'prog_type_name');

            return view('backoffice.curriculum.edit2',
                ['projList' => $projList, 'facList' => $facList,
                    'degList' => $degList,
                    'progTypeList' => json_encode($progTypeList),
                    'applySemesterList' => $applySemesterList, 'curriculum' => null]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showEditPage(Request $request, $id)
    {
        try {

            $currInfo = $this->curriculumRepo->findOrFail($id);
            $semAcaYr = $this->currActRepo->getDistinctSemesterAndAcademicYearByCurriculumId($id);
            $applySemesterList = $this->applyRepo->getDistinctApplySettingSemesterByAcademicYear();
            $projList = $this->projectRepo->all();
            $facList = $this->facultyRepo->all();
            $degList = $this->degreeRepo->all();
            $progTypeList = Util::prepareDataForDropdownList(json_decode($this->progTypeRepo->getAllProgramTypeForDropdown(), true), 'program_type_id', 'prog_type_name');

            return view('backoffice.curriculum.edit2',
                ['projList' => $projList, 'facList' => $facList,
                    'degList' => $degList,
                    'progTypeList' => json_encode($progTypeList),
                    'applySemesterList' => $applySemesterList,
                    'semAcaYr' => $semAcaYr,
                    'curriculum' => $currInfo
//                    ,
//                    'currActList' => $currInfo['curriculum_activity']
//
                ]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doSave(Request $request)
    {
        try {
            $data = $request->all();

            $data['rounds'] = json_decode($data['rounds'], true);
            $data['programs'] = json_decode($data['programs'], true);
            $data['creator'] = 'test';
            $data['modifier'] = 'test';
            $currObj = $this->curriculumRepo->saveCurriculumSetting($data);
            $result = $this->curriculumRepo->getCurriculumInfoById($currObj->curriculum_id);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function getCurrProgListByCurriculumId(Request $request)
    {
        try {
            if (!$request->ajax()) {
                return response()->json(null);
            }
            $param = $request->all();
            $result = $this->currProgRepo->getCurrProgListByCurriculumId($param['curriculum_id']);
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json(null);
        }
    }

    public function getCurrActByCurriculumId(Request $request)
    {
        try {
            if (!$request->ajax()) {
                return response()->json(null);
            }
            $param = $request->all();
            $result = $this->currActRepo->getCurrActListByCurriculumId($param['curriculum_id']);
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json(null);
        }
    }

    public function getCurrSubMajorByCurriculumId(Request $request)
    {
        try {
            if (!$request->ajax()) {
                return response()->json(null);
            }
            $param = $request->all();
            $result = $this->currSubMRepo->getCurrSubMajorByCurriculumId($param['curriculum_id']);
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json(null);
        }
    }

    public function downloadCurriculumDoc(Request $request)
    {
        try {
            $data = $request->all();
            if (!array_key_exists('curriculum_id', $data) || empty($data['curriculum_id'])) {
                return;
            }
            $curr = $this->curriculumRepo->findOrFail($data['curriculum_id']);
            if (!empty($curr->file)) {
                $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($curr->file->file_path);
                return response()->download($path, $curr->file->file_origi_name);
            }
        } catch (\Exception $ex) {
        }
    }
}

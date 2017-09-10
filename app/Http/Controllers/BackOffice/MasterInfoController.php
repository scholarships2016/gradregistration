<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\DegreeRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\McourseStudyRepository;
use App\Repositories\Contracts\TblProgramPlanRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterInfoController extends Controller
{
    //
    protected $mcStudyRepo;
    protected $facultyRepo;
    protected $degreeRepo;
    protected $planRepo;


    /**
     * MasterInfoController constructor.
     */
    public function __construct(McourseStudyRepository $mcStudyRepo,
                                FacultyRepository $facultyRepo,
                                DegreeRepository $degreeRepo,
                                TblProgramPlanRepository $planRepo)
    {
        $this->mcStudyRepo = $mcStudyRepo;
        $this->facultyRepo = $facultyRepo;
        $this->degreeRepo = $degreeRepo;
        $this->planRepo = $planRepo;
    }

    public function showManageCoursePage(Request $request)
    {
        return view('backoffice.masterInfo.courseManage');
    }

    public function showMCourseAddPage(Request $request)
    {
        try {
            $planList = $this->planRepo->all();
            $degList = $this->degreeRepo->all();
            $facList = $this->facultyRepo->all();
            return view('backoffice.masterInfo.edit', ['facList' => $facList,
                'degList' => $degList, 'planList' => $planList]);
        } catch (\Exception $ex) {
            throw $ex;
            return redirect()->route('admin.masterInfo.showManageCoursePage');
        }
    }

    public function showMCourseEditPage(Request $request, $id)
    {
        try {
            $mcourse = $this->mcStudyRepo->findOrFail($id);
            $planList = $this->planRepo->all();
            $degList = $this->degreeRepo->all();
            $facList = $this->facultyRepo->all();
            return view('backoffice.masterInfo.edit', ['facList' => $facList,
                'degList' => $degList, 'planList' => $planList, 'mcourse' => $mcourse, 'isEdit' => 'true']);
        } catch (\Exception $ex) {
            throw $ex;
            return redirect()->route('admin.masterInfo.showManageCoursePage');
        }
    }

    public function getMCourseData(Request $request)
    {
        try {
            $result = $this->mcStudyRepo->getMcourseStudyPaging1($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        }
    }

    public function doSaveMcourse(Request $request)
    {
        try {
            $data = $request->all();
            $who = 'test3';
            if (isset($data['coursecodeno']) && !empty($data['coursecodeno'])) {
                $data['sync_creator'] = $who;
                $data['sync_modifier'] = $who;
            } else {
                $data['sync_modifier'] = $who;
                $data['coursecodeno'] = $data['coursecodeno_hidden'];
            }
            $result = $this->mcStudyRepo->saveMcourse($data);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function updateMcourseTable(Request $request)
    {
        try {
            $this->mcStudyRepo->updateAllCourse();
            return response()->json(Util::jsonResponseFormat(1, null, Util::UPDATE_SUCCESS));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $codeno = $request->input('coursecodeno');
            if (empty($codeno)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $this->mcStudyRepo->deleteMcourseStudyByCoursecodeno($codeno);
            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

}

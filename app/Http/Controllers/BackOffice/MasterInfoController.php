<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\DegreeRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\McourseStudyRepository;
use App\Repositories\Contracts\TblProgramPlanRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterInfoController extends Controller
{
    private static $SECTION_NAME = 'MasterInfo';
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
                                TblProgramPlanRepository $planRepo, AudittrailRepository $auditRepo)
    {
        parent::__construct(null, null, $auditRepo);
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
            $this->WLog('func=showMCourseAddPage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return redirect()->route('admin.masterInfo.showManageCoursePage');
        }
    }

    public function showMCourseEditPage(Request $request, $id)
    {
        try {
            $this->WLog('func=showMCourseEditPage', self::$SECTION_NAME, null);
            $who = session('user_id');

            $mcourse = $this->mcStudyRepo->findOrFail($id);
            $planList = $this->planRepo->all();
            $degList = $this->degreeRepo->all();
            $facList = $this->facultyRepo->all();

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_VIEW;
            $audit['detail'] = 'doSave,coursecodeno=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            return view('backoffice.masterInfo.edit', ['facList' => $facList,
                'degList' => $degList, 'planList' => $planList, 'mcourse' => $mcourse, 'isEdit' => 'true']);
        } catch (\Exception $ex) {
            $this->WLog('func=showMCourseEditPage', self::$SECTION_NAME, $ex->getMessage());
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
            $this->WLog('func=getMCourseData', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        }
    }

    public function doSaveMcourse(Request $request)
    {
        try {
            $this->WLog('func=doSaveMcourse', self::$SECTION_NAME, null);
            $data = $request->all();
            $who = session('user_id');
            if (isset($data['coursecodeno']) && !empty($data['coursecodeno'])) {
                $data['sync_creator'] = $who;
                $data['sync_modifier'] = $who;
            } else {
                $data['sync_modifier'] = $who;
                $data['coursecodeno'] = $data['coursecodeno_hidden'];
            }
            $result = $this->mcStudyRepo->saveMcourse($data);

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSaveMcourse,coursecodeno=' . $data['coursecodeno'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSaveMcourse', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function updateMcourseTable(Request $request)
    {
        try {
            $this->WLog('func=updateMcourseTable', self::$SECTION_NAME, null);
            $who = session('user_id');

            $this->mcStudyRepo->updateAllCourse();

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'updateMcourseTable,mergeDataFromCentralDatabase';
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            return response()->json(Util::jsonResponseFormat(1, null, Util::UPDATE_SUCCESS));
        } catch (\Exception $ex) {
            $this->WLog('func=updateMcourseTable', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $this->WLog('func=doDelete', self::$SECTION_NAME, null);
            $who = session('user_id');

            $codeno = $request->input('coursecodeno');
            if (empty($codeno)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $this->mcStudyRepo->deleteMcourseStudyByCoursecodeno($codeno);

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
            $audit['detail'] = 'doDelete,coursecodeno='.$codeno;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);


            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

}

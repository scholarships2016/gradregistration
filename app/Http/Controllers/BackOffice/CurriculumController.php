<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\CurriculumActivityRepository;
use App\Repositories\Contracts\CurriculumProgramRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Repositories\Contracts\CurriculumSubMajorRepository;
use App\Repositories\Contracts\CurriculumWorkflowTransactionRepository;
use App\Repositories\Contracts\DegreeRepository;
use App\Repositories\Contracts\FacultyRepository;
use App\Repositories\Contracts\ProgramTypeRepository;
use App\Repositories\Contracts\TblProjectRepository;
use App\Repositories\Contracts\UserRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CurriculumController extends Controller
{
    private static $SECTION_NAME = 'Curriculum';
    protected $projectRepo;
    protected $facultyRepo;
    protected $degreeRepo;
    protected $applyRepo;
    protected $progTypeRepo;
    protected $curriculumRepo;
    protected $currActRepo;
    protected $currProgRepo;
    protected $currSubMRepo;
    protected $currWFTrans;
    protected $userRepo;


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
                                CurriculumSubMajorRepository $currSubMRepo,
                                CurriculumWorkflowTransactionRepository $currWFTrans,
                                UserRepository $userRepo,
                                AudittrailRepository $auditRepo)
    {

        parent::__construct(null, null, $auditRepo);
        $this->projectRepo = $projectRepo;
        $this->facultyRepo = $facultyRepo;
        $this->degreeRepo = $degreeRepo;
        $this->applyRepo = $applyRepo;
        $this->progTypeRepo = $progTypeRepo;
        $this->curriculumRepo = $curriculumRepo;
        $this->currActRepo = $currActRepo;
        $this->currProgRepo = $currProgRepo;
        $this->currSubMRepo = $currSubMRepo;
        $this->currWFTrans = $currWFTrans;
        $this->userRepo = $userRepo;
    }

    public function showManagePage(Request $request)
    {
        try {
            $facList = $this->facultyRepo->all();
            $progTypeList = $this->progTypeRepo->getAllProgramTypeForDropdown();
            $acaYearList = $this->applyRepo->getDistinctAcademicYear();
            $this->WLog('func=showManagePage', self::$SECTION_NAME, null);
            return view('backoffice.curriculum.manage',
                ['facList' => $facList, 'progTypeList' => $progTypeList,
                    'acaYearList' => $acaYearList]);
        } catch (\Exception $ex) {
            $this->WLog('func=showManagePage', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function doCurriculumManagePaging(Request $request)
    {
        try {
            $this->WLog('func=doCurriculumManagePaging', self::$SECTION_NAME, null);
            return response()->json($this->curriculumRepo->doPaging1($request->all()));
        } catch (\Exception $ex) {
            $this->WLog('func=doCurriculumManagePaging', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function showAddPage(Request $request)
    {
        try {
            $applySemesterList = $this->applyRepo->getDistinctApplySettingSemesterByAcademicYear();
            $projList = $this->projectRepo->all();
            $facList = $this->facultyRepo->all();
            $degList = $this->degreeRepo->all();
            $userList = $this->userRepo->all(['user_id', 'user_name', 'name']);
            $progTypeList = Util::prepareDataForDropdownList(json_decode($this->progTypeRepo->getAllProgramTypeForDropdown(), true), 'program_type_id', 'prog_type_name');

            $this->WLog('func=showAddPage', self::$SECTION_NAME, null);

            return view('backoffice.curriculum.edit2',
                ['projList' => $projList, 'facList' => $facList,
                    'degList' => $degList,
                    'progTypeList' => json_encode($progTypeList),
                    'applySemesterList' => $applySemesterList,
                    'curriculum' => null,
                    'userList' => $userList]);
        } catch (\Exception $ex) {
            $this->WLog('func=showAddPage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }

    public function showEditPage(Request $request, $id)
    {
        try {
            $who = session('user_id');
            $currInfo = $this->curriculumRepo->findOrFail($id);
            $semAcaYr = $this->currActRepo->getDistinctSemesterAndAcademicYearByCurriculumId($id);
            $applySemesterList = $this->applyRepo->getDistinctApplySettingSemesterByAcademicYear();
            $projList = $this->projectRepo->all();
            $facList = $this->facultyRepo->all();
            $degList = $this->degreeRepo->all();
            $userList = $this->userRepo->all(['user_id', 'user_name', 'name']);
            $progTypeList = Util::prepareDataForDropdownList(json_decode($this->progTypeRepo->getAllProgramTypeForDropdown(), true), 'program_type_id', 'prog_type_name');

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_VIEW;
            $audit['detail'] = 'view,curriculum_id=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=showEditPage', self::$SECTION_NAME, null);
            return view('backoffice.curriculum.edit2',
                ['projList' => $projList, 'facList' => $facList,
                    'degList' => $degList,
                    'progTypeList' => json_encode($progTypeList),
                    'applySemesterList' => $applySemesterList,
                    'semAcaYr' => $semAcaYr,
                    'curriculum' => $currInfo,
                    'userList' => $userList
                ]);
        } catch (\Exception $ex) {
            $this->WLog('func=showEditPage', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function doSave(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $data['rounds'] = json_decode($data['rounds'], true);
            $data['programs'] = json_decode($data['programs'], true);
            $data['creator'] = $who;
            $data['modifier'] = $who;
            $currObj = $this->curriculumRepo->saveCurriculumSetting($data);
            $result = $this->curriculumRepo->getCurriculumInfoById($currObj->curriculum_id);

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = empty($data['curriculum_id']) ? Util::AUDIT_ACT_CREATE : Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = (empty($data['curriculum_id']) ? 'create,' : 'update,') . 'curriculum_id=' . $currObj->curriculum_id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);
            $this->WLog('func=doSave', self::$SECTION_NAME, null);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSave', self::$SECTION_NAME, $ex->getMessage());
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
            $this->WLog('func=getCurrProgListByCurriculumId', self::$SECTION_NAME, $ex->getMessage());
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
            $this->WLog('func=getCurrActByCurriculumId', self::$SECTION_NAME, $ex->getMessage());
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
            $this->WLog('func=getCurrSubMajorByCurriculumId', self::$SECTION_NAME, $ex->getMessage());
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
            $this->WLog('func=downloadCurriculumDoc', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function doSendToApprove(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            //Pending
            $data['workflow_status_id'] = 2;
            $data['creator'] = $who;
            $data['modifier'] = $who;
            $result = $this->curriculumRepo->changeTransactionStatus($data);

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'sendToApprove,curriculum_id=' . $data['curriculum_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSendToApprove', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSendToApprove', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function doApprove(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            //Approve
            $data['workflow_status_id'] = 4;
            $data['creator'] = $who;
            $data['modifier'] = $who;
            $result = $this->curriculumRepo->changeTransactionStatus($data);

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_APPROVE;
            $audit['detail'] = 'doApprove,curriculum_id=' . $data['curriculum_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);
            $this->WLog('func=doApprove', self::$SECTION_NAME, null);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doApprove', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function doReject(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            //Reject
            $data['workflow_status_id'] = 3;
            $data['creator'] = $who;
            $data['modifier'] = $who;
            $result = $this->curriculumRepo->changeTransactionStatus($data);

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_REJECT;
            $audit['detail'] = 'doReject,curriculum_id=' . $data['curriculum_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doReject', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doReject', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::FAIL_SAVE));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            if (!isset($data['curriculum_id'])) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $result = $this->curriculumRepo->deleteCurriculumInfoByCurriculumId($data['curriculum_id']);

            /*
             * Audit Info
             */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
            $audit['detail'] = 'doDelete,curriculum_id=' . $data['curriculum_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);
            $this->WLog('func=doDelete', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

}

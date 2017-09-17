<?php

namespace App\Http\Controllers\BackOffice;

use App\Exceptions\ApplicantDeleteException;
use App\Repositories\Contracts\ApplicantEduRepository;
use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\ApplicantWorkRepository;
use App\Repositories\Contracts\ApplicationRepository;
use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\EducationPassRepository;
use App\Repositories\Contracts\EngTestRepository;
use App\Repositories\Contracts\GaduateLevelRepository;
use App\Repositories\Contracts\NameTitleRepository;
use App\Repositories\Contracts\NationRepository;
use App\Repositories\Contracts\NewsSourceRepository;
use App\Repositories\Contracts\ProvinceRepository;
use App\Repositories\Contracts\ReligionRepository;
use App\Repositories\Contracts\UniversityRepository;
use App\Repositories\Contracts\WorkStatusRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ApplicantManagementController extends Controller
{

    private static $SECTION_NAME = 'ApplicantManagement';

    protected $newSrcRepo;
    protected $applicantRepo;
    protected $nationRepo;
    protected $religionRepo;
    protected $engTestRepo;
    protected $nameTitleRepo;
    protected $workStatusRepo;
    protected $gaduateLevelRepo;
    protected $eduPassRepo;
    protected $uniRepo;
    protected $provinceRepo;
    protected $applicantEduRepo;
    protected $applicantWorkRepo;
    protected $applicationRepo;

    /**
     * ApplicantManagementController constructor.
     */
    public function __construct(NewsSourceRepository $newSrcRepo, ApplicantRepository $applicantRepo,
                                NationRepository $nationRepo, ReligionRepository $religionRepo,
                                EngTestRepository $engTestRepo, NameTitleRepository $nameTitleRepo,
                                WorkStatusRepository $workStatusRepo, GaduateLevelRepository $gaduateLevelRepo,
                                EducationPassRepository $eduPassRepo, UniversityRepository $uniRepo,
                                ProvinceRepository $provinceRepo, ApplicantEduRepository $applicantEduRepo,
                                ApplicantWorkRepository $applicantWorkRepo, ApplicationRepository $applicationRepo, AudittrailRepository $auditRepo)
    {
        parent::__construct(null, null, $auditRepo);
        $this->newSrcRepo = $newSrcRepo;
        $this->applicantRepo = $applicantRepo;
        $this->nationRepo = $nationRepo;
        $this->religionRepo = $religionRepo;
        $this->engTestRepo = $engTestRepo;
        $this->nameTitleRepo = $nameTitleRepo;
        $this->workStatusRepo = $workStatusRepo;
        $this->gaduateLevelRepo = $gaduateLevelRepo;
        $this->eduPassRepo = $eduPassRepo;
        $this->uniRepo = $uniRepo;
        $this->provinceRepo = $provinceRepo;
        $this->applicantEduRepo = $applicantEduRepo;
        $this->applicantWorkRepo = $applicantWorkRepo;
        $this->applicationRepo = $applicationRepo;
    }

    public function showManagePage(Request $request)
    {
        try {
            return view('backoffice.applicant.manage');
        } catch (\Exception $ex) {
            $this->WLog('func=showManagePage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }

    public function showAddPage(Request $request)
    {
        try {

        } catch (\Exception $ex) {
            $this->WLog('func=showAddPage', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function showViewPage(Request $request, $id)
    {
        try {
            $who = session('user_id');
            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($id);

            //Master Data
            $nameTitleList = $this->nameTitleRepo->all();
            $newSrcList = $this->newSrcRepo->getAll();
            $nationList = $this->nationRepo->all();
            $religionList = $this->religionRepo->all();
            $engTestList = $this->engTestRepo->all();
            $workStatusList = $this->workStatusRepo->all();
            $gaduateLevelList = $this->gaduateLevelRepo->all();
            $eduPassList = $this->eduPassRepo->all();
            $uniList = $this->uniRepo->all();
            $provinceList = $this->provinceRepo->all();

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_VIEW;
            $audit['detail'] = 'showViewPage,aplicant_id=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=showViewPage', self::$SECTION_NAME, null);

            return view('backoffice.applicant.edit', ['applicant' => $applicantProfile['applicant'], 'profile_img' => '',
                'applicantNewsSrc' => $applicantProfile['applicantNewsSource'],
                'newSrcList' => $newSrcList, 'nationList' => $nationList,
                'religionList' => $religionList, 'engTestList' => $engTestList,
                'nameTitleList' => $nameTitleList, 'workStatusList' => $workStatusList,
                'gaduateLevelList' => $gaduateLevelList, 'eduPassList' => $eduPassList,
                'uniList' => $uniList, 'provinceList' => $provinceList,
                'applicantEduList' => $applicantProfile['applicantEdu'],
                'applicantWorkExpList' => $applicantProfile['applicantWork'],
                'isView' => true, 'isEdit' => false]);

        } catch (\Exception $ex) {
            session()->flash('errorMsg', Util::ERROR_OCCUR);
            $this->WLog('func=showViewPage', self::$SECTION_NAME, $ex->getMessage());
            return redirect()->route('admin.applicantManage.showManagePage');
        }

    }

    public function showEditPage(Request $request, $id)
    {
        Log::info('showPersonalProfilePage');

        try {
            $who = session('user_id');
            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($id);

            //Master Data
            $nameTitleList = $this->nameTitleRepo->all();
            $newSrcList = $this->newSrcRepo->getAll();
            $nationList = $this->nationRepo->all();
            $religionList = $this->religionRepo->all();
            $engTestList = $this->engTestRepo->all();
            $workStatusList = $this->workStatusRepo->all();
            $gaduateLevelList = $this->gaduateLevelRepo->all();
            $eduPassList = $this->eduPassRepo->all();
            $uniList = $this->uniRepo->all();
            $provinceList = $this->provinceRepo->all();


            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_VIEW;
            $audit['detail'] = 'showEditPage,aplicant_id=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=showEditPage', self::$SECTION_NAME, null);

            return view('backoffice.applicant.edit', ['applicant' => $applicantProfile['applicant'], 'profile_img' => '',
                'applicantNewsSrc' => $applicantProfile['applicantNewsSource'],
                'newSrcList' => $newSrcList, 'nationList' => $nationList,
                'religionList' => $religionList, 'engTestList' => $engTestList,
                'nameTitleList' => $nameTitleList, 'workStatusList' => $workStatusList,
                'gaduateLevelList' => $gaduateLevelList, 'eduPassList' => $eduPassList,
                'uniList' => $uniList, 'provinceList' => $provinceList,
                'applicantEduList' => $applicantProfile['applicantEdu'],
                'applicantWorkExpList' => $applicantProfile['applicantWork'],
                'isView' => false, 'isEdit' => true]);

        } catch (\Exception $ex) {
            session()->flash('errorMsg', Util::ERROR_OCCUR);
            $this->WLog('func=showEditPage', self::$SECTION_NAME, $ex->getMessage());
            return redirect()->route('admin.applicantManage.showManagePage');
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->applicantRepo->doApplicantPaging($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            $this->WLog('func=doPaging', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }


    public function doSavePersonalInfomation(Request $request)
    {
        Log::info('doSavePersonalInfomation');
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if (array_key_exists('stu_birthdate', $data) && !empty($data['stu_birthdate'])) {
                $data['stu_birthdate'] = Carbon::createFromFormat('d/m/Y', $data['stu_birthdate'])->format('Y-m-d');
            }
            $result = $this->applicantRepo->saveApplicantPersonalInfo($data);

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSavePersonalInfomation,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSavePersonalInfomation', self::$SECTION_NAME, null);


            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSavePersonalInfomation', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSavePresentAddress(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            $result = $this->applicantRepo->saveApplicant($data);

            /*
               * Audit Info
               */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSavePresentAddress,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSavePresentAddress', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSavePresentAddress', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }

    }

    public function doSaveKnowledgeSkill(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if (array_key_exists('eng_date_taken', $data) && !empty($data['eng_date_taken'])) {
                $data['eng_date_taken'] = Carbon::createFromFormat('d/m/Y', $data['eng_date_taken'])->format('Y-m-d');
            }
            if (array_key_exists('eng_date_taken_admin', $data) && !empty($data['eng_date_taken_admin'])) {
                $data['eng_date_taken_admin'] = Carbon::createFromFormat('d/m/Y', $data['eng_date_taken_admin'])->format('Y-m-d');
            }
            if (!array_key_exists('eng_test_id_admin', $data)) {
                $data['eng_test_id_admin'] = null;
            }

            $result = $this->applicantRepo->saveApplicant($data);

            /*
               * Audit Info
               */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSaveKnowledgeSkill,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSaveKnowledgeSkill', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSaveKnowledgeSkill', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSaveEduBackground(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantEduRepo->saveApplicantEduList($data, $data['applicant_id'])) {
                $result = $this->applicantEduRepo->getApplicantEduByApplicantId($data['applicant_id']);
            }

            /*
               * Audit Info
               */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSaveEduBackground,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSaveEduBackground', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSaveEduBackground', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSaveWorkExp(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantWorkRepo->saveApplicantWorkList($data, $data['applicant_id'])) {
                $result = $this->applicantWorkRepo->getApplicantWorkByApplicantId($data['applicant_id']);
            }

            /*
               * Audit Info
               */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSaveWorkExp,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doSaveWorkExp', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSaveWorkExp', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doChangePassword(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;
            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantRepo->changePassword($data)) {
                return response()->json(Util::jsonResponseFormat(1, null, Util::CHANGE_PASS_SUCCESS));
            } else {
                return response()->json(Util::jsonResponseFormat(3, null, Util::CHANGE_PASS_ERROR));
            }

            /*
              * Audit Info
              */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doChangePassword,aplicant_id=' . $data['applicant_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);


            $this->WLog('func=doChangePassword', self::$SECTION_NAME, null);

        } catch (\Exception $ex) {
            $this->WLog('func=doChangePassword', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function getProfileImg(Request $request)
    {
        try {
            $id = $request->input('applicant_id');
            $applicant = $this->applicantRepo->findOrFail($id);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($applicant->stuImgFile->file_path);
            return response()->file($path);
        } catch (\Exception $ex) {
            $this->WLog('func=getProfileImg', self::$SECTION_NAME, $ex->getMessage());
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $who = session('user_id');
            $id = $request->input('applicant_id');
            $this->applicantRepo->doDelete($id);

            /*
              * Audit Info
              */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
            $audit['detail'] = 'doDelete,aplicant_id=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doDelete', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (ApplicantDeleteException $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(2, null, Util::CANNOT_DELETE));
        } catch (\Exception $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function getApplicationAndProgramInfo(Request $request)
    {
        try {
            $param = $request->input('application_id');
            if (empty($param)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $result = $this->applicationRepo->getApplicationAndProgramInfoByApplicationId($param);
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        } catch (\Exception $ex) {
            $this->WLog('func=getApplicationAndProgramInfo', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doDeleteApplication(Request $request)
    {
        try {
            $who = session('user_id');
            $param = $request->input('application_id');
            if (empty($param)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $result = $this->applicationRepo->doDeleteApplicationByApplicationId($param);

            /*
              * Audit Info
              */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
            $audit['detail'] = 'doDeleteApplication,application_id=' . $param;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            $this->WLog('func=doDeleteApplication', self::$SECTION_NAME, null);

            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            $this->WLog('func=doDeleteApplication', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }


}

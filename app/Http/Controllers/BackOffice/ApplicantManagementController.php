<?php

namespace App\Http\Controllers\BackOffice;

use App\Exceptions\ApplicantDeleteException;
use App\Repositories\Contracts\ApplicantEduRepository;
use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\ApplicantWorkRepository;
use App\Repositories\Contracts\ApplicationRepository;
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
                                ApplicantWorkRepository $applicantWorkRepo, ApplicationRepository $applicationRepo)
    {
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
            throw $ex;
        }
    }

    public function showAddPage(Request $request)
    {

    }

    public function showViewPage(Request $request, $id)
    {
        Log::info('showViewPage');

        try {
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
            return redirect()->route('admin.applicantManage.showManagePage');
        }

    }

    public function showEditPage(Request $request, $id)
    {
        Log::info('showPersonalProfilePage');

        try {
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
            return redirect()->route('admin.applicantManage.showManagePage');
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->applicantRepo->doApplicantPaging($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public function doSavePersonalInfomation(Request $request)
    {
        Log::info('doSavePersonalInfomation');
        try {
            $data = $request->all();
            $who = 'test';
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if (array_key_exists('stu_birthdate', $data) && !empty($data['stu_birthdate'])) {
                $data['stu_birthdate'] = Carbon::createFromFormat('d/m/Y', $data['stu_birthdate'])->format('Y-m-d');
            }
            $result = $this->applicantRepo->saveApplicantPersonalInfo($data);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSavePresentAddress(Request $request)
    {
        Log::info('doSavePresentAddress');
        try {
            $data = $request->all();
            $who = 'test';
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            $result = $this->applicantRepo->saveApplicant($data);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }

    }

    public function doSaveKnowledgeSkill(Request $request)
    {
        Log::info('doSaveKnowledgeSkill');
        try {
            $data = $request->all();
            $who = 'test';
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
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSaveEduBackground(Request $request)
    {
        Log::info('doSaveEduBackground');
        try {
            $data = $request->all();
            $who = 'test';
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantEduRepo->saveApplicantEduList($data, $data['applicant_id'])) {
                $result = $this->applicantEduRepo->getApplicantEduByApplicantId($data['applicant_id']);
            }
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSaveWorkExp(Request $request)
    {
        Log::info('doSaveEduBackground');
        try {
            $data = $request->all();
            $who = 'test';
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantWorkRepo->saveApplicantWorkList($data, $data['applicant_id'])) {
                $result = $this->applicantWorkRepo->getApplicantWorkByApplicantId($data['applicant_id']);
            }
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doChangePassword(Request $request)
    {
        Log::info('doChangePassword');
        try {
            $data = $request->all();
            $who = 'test';
            $creator = $who;
            $modifier = $who;
            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantRepo->changePassword($data)) {
                return response()->json(Util::jsonResponseFormat(1, null, Util::CHANGE_PASS_SUCCESS));
            } else {
                return response()->json(Util::jsonResponseFormat(3, null, Util::CHANGE_PASS_ERROR));
            }
        } catch (\Exception $ex) {
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
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $id = $request->input('applicant_id');
            $this->applicantRepo->doDelete($id);
            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (ApplicantDeleteException $ex) {
            return response()->json(Util::jsonResponseFormat(2, null, Util::CANNOT_DELETE));
        } catch (\Exception $ex) {
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
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doDeleteApplication(Request $request)
    {
        try {
            $param = $request->input('application_id');
            if (empty($param)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $result = $this->applicationRepo->doDeleteApplicationByApplicationId($param);
            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }


}

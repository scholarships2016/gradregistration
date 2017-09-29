<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ApplicantEduRepository;
use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\ApplicantWorkRepository;
use App\Repositories\Contracts\EducationPassRepository;
use App\Repositories\Contracts\EngTestRepository;
use App\Repositories\Contracts\NameTitleRepository;
use App\Repositories\Contracts\NationRepository;
use App\Repositories\Contracts\NewsSourceRepository;
use App\Repositories\Contracts\ProvinceRepository;
use App\Repositories\Contracts\ReligionRepository;
use App\Repositories\Contracts\UniversityRepository;
use App\Repositories\Contracts\WorkStatusRepository;
use App\Repositories\Contracts\GaduateLevelRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use \Crypt;
class ProfileController extends Controller
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

    /**
     * ProfileController constructor.
     */
    public function __construct(NewsSourceRepository $newSrcRepo, ApplicantRepository $applicantRepo,
                                NationRepository $nationRepo, ReligionRepository $religionRepo,
                                EngTestRepository $engTestRepo, NameTitleRepository $nameTitleRepo,
                                WorkStatusRepository $workStatusRepo, GaduateLevelRepository $gaduateLevelRepo,
                                EducationPassRepository $eduPassRepo, UniversityRepository $uniRepo,
                                ProvinceRepository $provinceRepo, ApplicantEduRepository $applicantEduRepo,
                                ApplicantWorkRepository $applicantWorkRepo)
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
    }

    public function showProfilePage(Request $request)
    {
        Log::info('showProfilePage');

        try {
            $applicantId = session('user_id');

            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($applicantId);

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

            return view('profile.edit', ['applicant' => $applicantProfile['applicant'],
                'applicantNewsSrc' => $applicantProfile['applicantNewsSource'],
                'newSrcList' => $newSrcList, 'nationList' => $nationList,
                'religionList' => $religionList, 'engTestList' => $engTestList,
                'nameTitleList' => $nameTitleList, 'workStatusList' => $workStatusList,
                'gaduateLevelList' => $gaduateLevelList, 'eduPassList' => $eduPassList,
                'uniList' => $uniList, 'provinceList' => $provinceList,
                'applicantEduList' => $applicantProfile['applicantEdu'], 'applicantWorkExpList' => $applicantProfile['applicantWork']]);

        } catch (\Exception $ex) {
            session()->flash('errorMsg', Util::ERROR_OCCUR);
            return back();
        }
    }

    public function showPersonalProfilePage(Request $request)
    {
        Log::info('showPersonalProfilePage');

        try {

            $applicantId = session('user_id');

            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($applicantId);

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


            return view('profile.personalProfile', ['applicant' => $applicantProfile['applicant'], 'profile_img' => '',
                'applicantNewsSrc' => $applicantProfile['applicantNewsSource'],
                'newSrcList' => $newSrcList, 'nationList' => $nationList,
                'religionList' => $religionList, 'engTestList' => $engTestList,
                'nameTitleList' => $nameTitleList, 'workStatusList' => $workStatusList,
                'gaduateLevelList' => $gaduateLevelList, 'eduPassList' => $eduPassList,
                'uniList' => $uniList, 'provinceList' => $provinceList,
                'applicantEduList' => $applicantProfile['applicantEdu'], 'applicantWorkExpList' => $applicantProfile['applicantWork']]);

        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return;
            session()->flash('errorMsg', Util::ERROR_OCCUR);
            return back();
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
            $who = session('user_id');
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
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if (array_key_exists('eng_date_taken', $data) && !empty($data['eng_date_taken'])) {
                $data['eng_date_taken'] = Carbon::createFromFormat('d/m/Y', $data['eng_date_taken'])->format('Y-m-d');
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
            $who = session('user_id');
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
            $who = session('user_id');
            $creator = $who;
            $modifier = $who;

            $data['creator'] = $creator;
            $data['modifier'] = $modifier;
            if ($this->applicantWorkRepo->saveApplicantWorkList($data, $data['applicant_id'])) {
                $result = $this->applicantWorkRepo->getApplicantWorkByApplicantId($data['applicant_id']);
            }
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doChangePassword(Request $request)
    {
        Log::info('doChangePassword');
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
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function getProfileImg(Request $request)
    {
        try {
            $id = $request->input('applicant_id');
            $id = Crypt::decrypt($id);
            $applicant = $this->applicantRepo->findOrFail($id);
            $path = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($applicant->stuImgFile->file_path);
            return response()->file($path);
        } catch (\Exception $ex) {
        }
    }
}

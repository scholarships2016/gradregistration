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
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
            $applicantID = 1;

            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($applicantID);
            if (empty($applicantProfile)) {
                session()->flash('errorMsg', Util::DATA_NOT_FOUND);
                return back();
            }

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
            $applicantID = 1;

            $applicantProfile = $this->applicantRepo->getApplicantProfileByApplicantId($applicantID);

            if (empty($applicantProfile)) {
                session()->flash('errorMsg', Util::DATA_NOT_FOUND);
                return back();
            }

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

            $filename = "6kZ6WllPfxj1K6E1lYrLiaLeCX0sANOqwq3Ohg8P.jpeg"; // Next is : get Path file from Database
            $contents = Storage::get(env('PROFILE_PIC_PATH') . $filename);
            $base64Img = 'data:image/*' . ';base64,' . base64_encode($contents);


            return view('profile.personalProfile', ['applicant' => $applicantProfile['applicant'], 'profile_img' => $base64Img,
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

    public function doSavePersonalInfomation(Request $request)
    {
        Log::info('doSavePersonalInfomation');
        try {
            $data = $request->all();
            if (array_key_exists('stu_profile_pic', $data) && !empty($data['stu_profile_pic'])) {
                $filename = Storage::putFile(env(Util::PROFILE_FOLDER), $request->file('stu_profile_pic'));
                $data['stu_profile_pic_filename'] = $filename;
            }
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
            if ($this->applicantEduRepo->saveApplicantEduList($data, $data['applicant_id'])) {
                $result = $this->applicantEduRepo->getApplicantEduByApplicantId($data['applicant_id']);
            }
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doSaveWorkExp(Request $request)
    {
        Log::info('doSaveEduBackground');
        try {
            $data = $request->all();
            if ($this->applicantWorkRepo->saveApplicantWorkList($data, $data['applicant_id'])) {
                $result = $this->applicantWorkRepo->getApplicantWorkByApplicantId($data['applicant_id']);
            }
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }
}

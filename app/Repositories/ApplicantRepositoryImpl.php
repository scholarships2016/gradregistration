<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicantEduRepository;
use App\Repositories\Contracts\ApplicantNewsSourceRepository;
use App\Repositories\Contracts\ApplicantRepository;
use App\Models\Applicant;
use App\Models\ApplicantWork;
use App\Models\ApplicantEdu;
use App\Models\ApplicatNewsSource;
use App\Repositories\Contracts\ApplicantWorkRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApplicantRepositoryImpl extends AbstractRepositoryImpl implements ApplicantRepository {

    protected $appNewsSrcRepo;
    protected $appEduRepo;
    protected $appWorkRepo;
    private $paging = 10;
    private $controllors;

    public function __construct(ApplicantNewsSourceRepository $appNewsSrcRepo, ApplicantEduRepository $appEduRepo, ApplicantWorkRepository $appWorkRepo, Controller $controllors) {
        parent::setModelClassName(Applicant::class);
        $this->appNewsSrcRepo = $appNewsSrcRepo;
        $this->appEduRepo = $appEduRepo;
        $this->appWorkRepo = $appWorkRepo;
        $this->controllors = $controllors;
    }

    public function checkLogin($criteria = null) {
        $result = null;
        try {
            $result = Applicant::where('stu_email', $criteria->stu_email)
                    ->where('stu_password', $criteria->stu_password)
                    ->select('applicant_id', 'stu_first_name', 'stu_last_name', 'stu_email')
                    ->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function getByCitizenOrEmail($citizencard, $email) {
        $result = null;
        try {
            $result = Applicant::where('stu_citizen_card', $citizencard)
                    ->orwhere('stu_email', $email)
                    ->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteria($criteria = null, $paging = false) {
        $result = null;
        try {
            $banks = Applicant::where('stu_citizen_card', 'like', '%' . $criteria . '%')
                    ->orwhere('stu_first_name', 'like', '%' . $criteria . '%')
                    ->orwhere('stu_last_name ', 'like', '%' . $criteria . '%')
                    ->orwhere('stu_first_name_en  ', 'like', '%' . $criteria . '%')
                    ->orwhere('stu_last_name_en  ', 'like', '%' . $criteria . '%')
                    ->orwhere('stu_sex ', 'like', '%' . $criteria . '%')
                    ->orderBy('applicant_id');
            $result = ($paging) ? $banks->paginate($this->paging) : $banks;
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function getEduApplicant($applicantID) {
        $result = null;
        try {
            $result = ApplicantEdu::where('applicant_id ', $applicantID)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function getWorkApplicant($applicantID) {
        $result = null;
        try {
            $result = ApplicantWork::where('applicant_id ', $applicantID)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function saveApplicant($data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('applicant_id', $data) || !empty($data['applicant_id']))
                $id = $data['applicant_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new Applicant;
            if (array_key_exists('stu_citizen_card', $data))
                $curObj->stu_citizen_card = $data['stu_citizen_card'];
            if (array_key_exists('name_title_id', $data))
                $curObj->name_title_id = $data['name_title_id'];
            if (array_key_exists('stu_first_name', $data))
                $curObj->stu_first_name = $data['stu_first_name'];
            if (array_key_exists('stu_last_name', $data))
                $curObj->stu_last_name = $data['stu_last_name'];
            if (array_key_exists('stu_first_name_en', $data))
                $curObj->stu_first_name_en = $data['stu_first_name_en'];
            if (array_key_exists('stu_last_name_en', $data))
                $curObj->stu_last_name_en = $data['stu_last_name_en'];
            if (array_key_exists('stu_sex', $data))
                $curObj->stu_sex = $data['stu_sex'];
            if (array_key_exists('nation_id', $data))
                $curObj->nation_id = $data['nation_id'];
            if (array_key_exists('stu_addr_no', $data))
                $curObj->stu_addr_no = $data['stu_addr_no'];
            if (array_key_exists('stu_addr_village', $data))
                $curObj->stu_addr_village = $data['stu_addr_village'];
            if (array_key_exists('stu_addr_soi', $data))
                $curObj->stu_addr_soi = $data['stu_addr_soi'];
            if (array_key_exists('stu_addr_road', $data))
                $curObj->stu_addr_road = $data['stu_addr_road'];
            if (array_key_exists('stu_addr_tumbon', $data))
                $curObj->stu_addr_tumbon = $data['stu_addr_tumbon'];
            if (array_key_exists('district_code', $data))
                $curObj->district_code = $data['district_code'];
            if (array_key_exists('province_id', $data))
                $curObj->province_id = $data['province_id'];
            if (array_key_exists('stu_addr_pcode', $data))
                $curObj->stu_addr_pcode = $data['stu_addr_pcode'];
            if (array_key_exists('stu_phone', $data))
                $curObj->stu_phone = $data['stu_phone'];
            if (array_key_exists('stu_phone2', $data))
                $curObj->stu_phone2 = $data['stu_phone2'];
            if (array_key_exists('stu_email', $data))
                $curObj->stu_email = $data['stu_email'];
            if (array_key_exists('eng_test_id', $data))
                $curObj->eng_test_id = $data['eng_test_id'];
            if (array_key_exists('eng_test_score', $data))
                $curObj->eng_test_score = $data['eng_test_score'];
            if (array_key_exists('thai_test_score', $data))
                $curObj->thai_test_score = $data['thai_test_score'];
            if (array_key_exists('cu_best_score', $data))
                $curObj->cu_best_score = $data['cu_best_score'];
            if (array_key_exists('stu_birthdate', $data))
                $curObj->stu_birthdate = $data['stu_birthdate'];
            if (array_key_exists('stu_religion', $data))
                $curObj->stu_religion = $data['stu_religion'];
            if (array_key_exists('stu_married', $data))
                $curObj->stu_married = $data['stu_married'];
            if (array_key_exists('stu_birthplace', $data))
                $curObj->stu_birthplace = $data['stu_birthplace'];
            if (array_key_exists('stu_married', $data))
                $curObj->stu_married = $data['stu_married'];
            if (array_key_exists('additional_addr', $data))
                $curObj->additional_addr = $data['additional_addr'];
            if (array_key_exists('eng_date_taken', $data))
                $curObj->eng_date_taken = $data['eng_date_taken'];
            if (array_key_exists('convert', $data))
                $curObj->convert = $data['convert'];
            if (array_key_exists('fund_interesting', $data))
                $curObj->fund_interesting = $data['fund_interesting'];
            if (array_key_exists('eng_test_score_admin', $data))
                $curObj->eng_test_score_admin = $data['eng_test_score_admin'];
            if (array_key_exists('eng_test_id_admin', $data))
                $curObj->eng_test_id_admin = $data['eng_test_id_admin'];
            if (array_key_exists('eng_date_taken_admin', $data))
                $curObj->eng_date_taken_admin = $data['eng_date_taken_admin'];
            if (array_key_exists('stu_password', $data))
                $curObj->stu_password = bcrypt($data['stu_password']);
            if (array_key_exists('sys_activate_code', $data))
                $curObj->sys_activate_code = $data['sys_activate_code'];


            if (array_key_exists('creator', $data))
                $curObj->creator = $data['creator'];
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];


            if ($curObj->save()) {
                return true;
            }
        } catch (\Exception $ex) {
            $this->controllors->WLog('Save Applicant', 'Enroll', $ex->getMessage());
            throw $ex;
        }
        return $result;
    }

    public function saveWorkApplicant($data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('work_stu_id', $data) || !empty($data['work_stu_id']))
                $id = $data['work_stu_id'];

            $chk = ApplicantWork::where('work_stu_id', $id)->first();
            $curObj = $chk ? $chk : new Applicant;
            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('work_stu_phone', $data))
                $curObj->work_stu_phone = $data['work_stu_phone'];
            if (array_key_exists('work_status_id', $data))
                $curObj->work_status_id = $data['work_status_id'];
            if (array_key_exists('work_stu_position', $data))
                $curObj->work_stu_position = $data['work_stu_position'];
            if (array_key_exists('work_stu_yr', $data))
                $curObj->work_stu_yr = $data['work_stu_yr'];
            if (array_key_exists('work_stu_detail', $data))
                $curObj->work_stu_detail = $data['work_stu_detail'];
            if (array_key_exists('work_stu_mth', $data))
                $curObj->work_stu_mth = $data['work_stu_mth'];
            if (array_key_exists('work_stu_salary', $data))
                $curObj->work_stu_salary = $data['work_stu_salary'];


            if (array_key_exists('creator', $data))
                $curObj->creator = $data['creator'];
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];


            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function saveEduApplicant($data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('edu_id', $data) || !empty($data['edu_id']))
                $id = $data['edu_id'];

            $chk = ApplicantEdu::where('edu_id', $id)->first();
            $curObj = $chk ? $chk : new Applicant;
            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('grad_level_id', $data))
                $curObj->grad_level_id = $data['grad_level_id'];
            if (array_key_exists('edu_pass_id', $data))
                $curObj->edu_pass_id = $data['edu_pass_id'];
            if (array_key_exists('university_id', $data))
                $curObj->university_id = $data['university_id'];
            if (array_key_exists('edu_year', $data))
                $curObj->edu_year = $data['edu_year'];
            if (array_key_exists('edu_faculty', $data))
                $curObj->edu_faculty = $data['edu_faculty'];
            if (array_key_exists('edu_major', $data))
                $curObj->edu_major = $data['edu_major'];
            if (array_key_exists('edu_gpax', $data))
                $curObj->work_stu_salary = $data['edu_gpax'];
            if (array_key_exists('edu_degree', $data))
                $curObj->edu_degree = $data['edu_degree'];

            if (array_key_exists('creator', $data))
                $curObj->creator = $data['creator'];
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];


            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function saveApplicatNewsSource($data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('app_news_id', $data) || !empty($data['app_news_id']))
                $id = $data['app_news_id'];

            $chk = ApplicatNewsSource::where('app_news_id', $id)->first();
            $curObj = $chk ? $chk : new Applicant;
            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('id', $data))
                $curObj->grad_level_id = $data['id'];
            if (array_key_exists('orther', $data))
                $curObj->edu_pass_id = $data['orther'];

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function getApplicantProfileByApplicantId($applicantId) {
        try {
            $applicantProfile = $this->findOrFail($applicantId);

            $newsSource = $this->appNewsSrcRepo->getApplicantNewsSourceByApplicantId($applicantId);
            $appEdu = $this->appEduRepo->getApplicantEduByApplicantId($applicantId);
            $appWork = $this->appWorkRepo->getApplicantWorkByApplicantId($applicantId);

            return array('applicant' => $applicantProfile, 'applicantNewsSource' => $newsSource,
                'applicantEdu' => $appEdu, 'applicantWork' => $appWork);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplicantProfileAllByApplicantId($applicantId) {
        try {
            $applicantProfile = Applicant::select('*', 'tbl_name_title.name_title as name_titles')->leftjoin('tbl_religion', 'tbl_religion.religion_id', 'applicant.stu_religion')
                            ->leftjoin('tbl_nation', 'tbl_nation.nation_id', 'applicant.nation_id')
                            ->leftjoin('tbl_name_title', 'tbl_name_title.name_title_id', 'applicant.name_title_id')
                            ->leftjoin('tbl_province', 'tbl_province.province_id', 'applicant.province_id')
                            ->leftjoin('tbl_district', 'tbl_district.district_code', 'applicant.district_code')
                            ->where('applicant_id', '=', $applicantId)->first();

            $newsSource = $this->appNewsSrcRepo->getApplicantNewsSourceByApplicantId($applicantId);
            $appEdu = $this->appEduRepo->getApplicantEduAllByApplicantId($applicantId);
            $appWork = $this->appWorkRepo->getApplicantWorkByApplicantId($applicantId);

            return array('applicant' => $applicantProfile, 'applicantNewsSource' => $newsSource,
                'applicantEdu' => $appEdu, 'applicantWork' => $appWork);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function saveApplicantPersonalInfo(array $data) {
        DB::beginTransaction();
        try {
            if ($this->saveApplicant($data)) {
                $this->appNewsSrcRepo->updateSetOfApplicantNewsSrc($data);
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

}

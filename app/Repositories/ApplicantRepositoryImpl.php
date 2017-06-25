<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicantRepository;
use App\Models\Applicant;
use App\Models\ApplicantWork;
use App\Models\ApplicantEdu;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicantRepositoryImpl extends AbstractRepositoryImpl implements ApplicantRepository {

    protected $statusPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblApplicant::class);
    }

    public function getByCitizenOrEmail($citizencard, $email) {
        $result = null;
        try {
            $result = Applicant::where('stu_citizen_card ', $citizencard)
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

}

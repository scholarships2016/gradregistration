<?php

namespace App\Repositories;

use App\Models\ApplicantEdu;
use App\Repositories\Contracts\ApplicantEduRepository;
use Illuminate\Support\Facades\DB;


class ApplicantEduRepositoryImpl extends AbstractRepositoryImpl implements ApplicantEduRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(ApplicantEdu::class);

    }

    public function saveApplicantEduList(array $datas, $applicantId)
    {
        DB::beginTransaction();
        try {

            $deletedRow = ApplicantEdu::where('applicant_id', '=', $applicantId)->delete();

            if (array_key_exists('eduback-group', $datas)) {
                foreach ($datas['eduback-group'] as $eduBack) {
                    //Create
                    if (empty($eduBack->app_edu_id)) {
                        $eduBack['applicant_id'] = $applicantId;
                        $this->create($eduBack);
                        continue;
                    }

                    // Update
                    $edu = $this->find($eduBack->app_edu_id);
                    if (array_key_exists("grad_level", $eduBack)) {
                        $edu->grad_level = $eduBack['grad_level'];
                    }
                    if (array_key_exists("edu_pass_id", $eduBack)) {
                        $edu->edu_pass_id = $eduBack['edu_pass_id'];
                    }
                    if (array_key_exists("university_id", $eduBack)) {
                        $edu->university_id = $eduBack['university_id'];
                    }
                    if (array_key_exists("edu_faculty", $eduBack)) {
                        $edu->edu_faculty = $eduBack['edu_faculty'];
                    }
                    if (array_key_exists("edu_year", $eduBack)) {
                        $edu->edu_year = $eduBack['edu_year'];
                    }
                    if (array_key_exists("edu_gpax", $eduBack)) {
                        $edu->edu_gpax = $eduBack['edu_gpax'];
                    }
                    if (array_key_exists("edu_major", $eduBack)) {
                        $edu->edu_major = $eduBack['edu_major'];
                    }
                    if (array_key_exists("edu_degree", $eduBack)) {
                        $edu->edu_degree = $eduBack['edu_degree'];
                    }
                }
            }

            if (array_key_exists('eduback-group-rmvIds', $datas)) {
                $this->destroy($datas['eduback-group-rmvIds']);
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function getApplicantEduByApplicantId($applicantId)
    {
        try {
            return ApplicantEdu::where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

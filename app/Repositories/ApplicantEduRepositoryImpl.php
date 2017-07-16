<?php

namespace App\Repositories;

use App\Models\ApplicantEdu;
use App\Repositories\Contracts\ApplicantEduRepository;
use Illuminate\Support\Facades\DB;


class ApplicantEduRepositoryImpl extends AbstractRepositoryImpl implements ApplicantEduRepository
{

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
                    $this->save($eduBack);
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

    public function save(array $data)
    {
        try {
            $id = null;

            if (array_key_exists('app_edu_id', $data) || !empty($data['app_edu_id']))
                $id = $data['app_edu_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new ApplicantEdu();
            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('grad_level', $data))
                $curObj->grad_level_id = $data['grad_level'];
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

            if (!$curObj->save()) {
                return null;
            }
            return $curObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

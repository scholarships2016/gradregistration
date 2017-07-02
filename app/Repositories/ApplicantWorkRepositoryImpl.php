<?php

namespace App\Repositories;

use App\Models\ApplicantWork;
use App\Repositories\Contracts\ApplicantWorkRepository;
use Illuminate\Support\Facades\DB;


class ApplicantWorkRepositoryImpl extends AbstractRepositoryImpl implements ApplicantWorkRepository
{
    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(ApplicantWork::class);
    }

    public function saveApplicantWorkList(array $datas, $applicantId)
    {

        DB::beginTransaction();
        try {

            $deletedRow = ApplicantWork::where('applicant_id', '=', $applicantId)->delete();

            if (array_key_exists('workexp-group', $datas)) {
                foreach ($datas['workexp-group'] as $workExp) {
                    //Create
                    if (empty($workExp->app_work_id)) {
                        $workExp['applicant_id'] = $applicantId;
                        $this->create($workExp);
                        continue;
                    }

                    // Update
                    $work = $this->find($workExp->app_work_id);
                    if (array_key_exists("work_stu_phone", $workExp)) {
                        $work->work_stu_phone = $workExp['work_stu_phone'];
                    }
                    if (array_key_exists("work_status_id", $workExp)) {
                        $work->work_status_id = $workExp['work_status_id'];
                    }
                    if (array_key_exists("work_stu_detail", $workExp)) {
                        $work->work_stu_detail = $workExp['work_stu_detail'];
                    }
                    if (array_key_exists("work_stu_position", $workExp)) {
                        $work->work_stu_position = $workExp['work_stu_position'];
                    }
                    if (array_key_exists("work_stu_yr", $workExp)) {
                        $work->work_stu_yr = $workExp['work_stu_yr'];
                    }
                    if (array_key_exists("work_stu_mth", $workExp)) {
                        $work->work_stu_mth = $workExp['work_stu_mth'];
                    }
                    if (array_key_exists("work_stu_salary", $workExp)) {
                        $work->work_stu_salary = $workExp['work_stu_salary'];
                    }
                    if (array_key_exists("app_work_status", $workExp)) {
                        $work->app_work_status = $workExp['app_work_status'];
                    }
                    if (array_key_exists("modifier", $workExp)) {
                        $work->modifier = $workExp['modifier'];
                    }


                }
            }

            if (array_key_exists('workexp-group-rmvIds', $datas)) {
                $this->destroy($datas['workexp-group-rmvIds']);
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }

    }

    public function getApplicantWorkByApplicantId($applicantId)
    {
        try {
            return ApplicantWork::where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

    }


}

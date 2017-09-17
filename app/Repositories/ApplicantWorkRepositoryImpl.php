<?php

namespace App\Repositories;

use App\Models\ApplicantWork;
use App\Repositories\Contracts\ApplicantWorkRepository;
use Illuminate\Support\Facades\DB;

class ApplicantWorkRepositoryImpl extends AbstractRepositoryImpl implements ApplicantWorkRepository {

    public function __construct() {
        parent::setModelClassName(ApplicantWork::class);
    }

    public function saveApplicantWorkList(array $datas, $applicantId) {
        DB::beginTransaction();
        try {
            $ids = array();
            if (array_key_exists('workexp-group', $datas)) {
                foreach ($datas['workexp-group'] as $index => $workExp) {
                    //Create
                    if (empty($workExp->app_work_id)) {
                        $datas['workexp-group'][$index]['creator'] = $datas['creator'];
                        $datas['workexp-group'][$index]['modifier'] = $datas['modifier'];
                        $datas['workexp-group'][$index]['applicant_id'] = $applicantId;
                    } else {
                        $datas['workexp-group'][$index]['modifier'] = $datas['modifier'];
                    }
                    $saveObj = $this->save($datas['workexp-group'][$index]);
                    array_push($ids, $saveObj->app_work_id);
                }
            }
            if (!empty($ids) && sizeof($ids) > 0) {
                $del = ApplicantWork::where('applicant_id', '=', $applicantId)
                                ->whereNotIn('app_work_id', $ids)->delete();
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function getApplicantWorkByApplicantId($applicantId) {
        try {
            return ApplicantWork::leftjoin('tbl_work_status', 'tbl_work_status.work_status_id', 'applicant_work.work_status_id')
                            ->where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplicantWorkAllByApplicantId($applicantId) {
        try {
            return ApplicantWork::leftjoin('tbl_work_status', 'tbl_work_status.work_status_id', 'applicant_work.work_status_id')
                            ->where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function save(array $data) {
        try {
            $id = null;
            if (array_key_exists('app_work_id', $data) || !empty($data['app_work_id']))
                $id = $data['app_work_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new ApplicantWork();
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
            if (array_key_exists('app_work_status', $data)) {
                $curObj->app_work_status = intval($data['app_work_status']);
            } else {
                $curObj->app_work_status = 0;
            }

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

<?php

namespace App\Repositories;

use App\Models\ApplicantEdu;
use App\Repositories\Contracts\ApplicantEduRepository;
use Illuminate\Support\Facades\DB;

class ApplicantEduRepositoryImpl extends AbstractRepositoryImpl implements ApplicantEduRepository {

    public function __construct() {
        parent::setModelClassName(ApplicantEdu::class);
    }

    public function saveApplicantEduList(array $datas, $applicantId) {
        DB::beginTransaction();
        try {
            $ids = array();
            if (array_key_exists('eduback-group', $datas)) {
                foreach ($datas['eduback-group'] as $index => $eduBack) {
                    //Create
                    if (empty($eduBack->app_edu_id)) {
                        $datas['eduback-group'][$index]['creator'] = $datas['creator'];
                        $datas['eduback-group'][$index]['modifier'] = $datas['modifier'];
                        $datas['eduback-group'][$index]['applicant_id'] = $applicantId;
                    } else {
                        $datas['eduback-group'][$index]['modifier'] = $datas['modifier'];
                    }

                    $saveObj = $this->save($datas['eduback-group'][$index]);
                    array_push($ids, $saveObj->app_edu_id);
                }
            }

            if (!empty($ids) && sizeof($ids) > 0) {
                $del = ApplicantEdu::where('applicant_id', '=', $applicantId)
                                ->whereNotIn('app_edu_id', $ids)->delete();
            }

            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    public function getApplicantEduByApplicantId($applicantId) {
        try {
            return ApplicantEdu::where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplicantEduAllByApplicantId($applicantId) {
        try {
            return ApplicantEdu::leftjoin('tbl_university', 'tbl_university.university_id', 'applicant_edu.university_id')
                            ->leftjoin('tbl_education_pass', 'tbl_education_pass.edu_pass_id', 'applicant_edu.edu_pass_id')
                            ->leftjoin('tbl_degree_level', 'tbl_degree_level.degree_level_ref', 'applicant_edu.grad_level')
                            ->where('applicant_id', '=', $applicantId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function save(array $data) {
        try {
            $id = null;

            if (array_key_exists('app_edu_id', $data) || !empty($data['app_edu_id']))
                $id = $data['app_edu_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new ApplicantEdu();
            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('grad_level', $data))
                $curObj->grad_level = $data['grad_level'];
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
                $curObj->edu_gpax = $data['edu_gpax'];
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

<?php

namespace App\Repositories;


use App\Models\ApplicantSpecialApply;
use App\Repositories\Contracts\ApplicantSpecialApplyRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicantSpecialApplyRepositoryImpl extends AbstractRepositoryImpl implements ApplicantSpecialApplyRepository
{
    /**
     * ApplicantSpecialApplyRepositoryImpl constructor.
     */
    public function __construct()
    {
        parent::setModelClassName(ApplicantSpecialApply::class);
    }

    public function saveSpecialApply(array $data)
    {
        try {
            $currObj = (array_key_exists('appt_spec_appl_id', $data) && !empty($data['appt_spec_appl_id'])) ? $this->find($data['appt_spec_appl_id']) : new ApplicantSpecialApply();
            if (empty($currObj)) {
                $currObj = new ApplicantSpecialApply();
            }

            if (array_key_exists('curriculum_id', $data)) {
                $currObj->curriculum_id = $data['curriculum_id'];
            }
            if (array_key_exists('applicant_id', $data)) {
                $currObj->applicant_id = $data['applicant_id'];
            }
            if (array_key_exists('start_date', $data)) {
                $currObj->start_date = $data['start_date'];
            }
            if (array_key_exists('end_date', $data)) {
                $currObj->end_date = $data['end_date'];
            }

            //Creator and Editor
            if (array_key_exists('creator', $data)) {
                $currObj->creator = $data['creator'];
            }
            if (array_key_exists('modifier', $data)) {
                $currObj->modifier = $data['modifier'];
            }


            $currObj->save();

            return $currObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplicantSpecialApplyById($applicantId)
    {
        try {
            $query = DB::table("applicant_special_apply as special")
                ->select("special.appt_spec_appl_id", "special.applicant_id",
                    DB::raw("date_format(special.start_date,'%d/%m/%Y') as start_date"),
                    DB::raw("date_format(special.end_date,'%d/%m/%Y') as end_date"),
                    "special.curriculum_id",
                    "special.curriculum_id as curriculum_id_hidden")
                ->where("special.applicant_id", "=", $applicantId);

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function saveApplicantsSpecialApply(array $data)
    {
        DB::beginTransaction();
        try {
            $del = $this->removeApplicantsSpecialApplyByApplicantId($data['ids'], $data['applicant_id']);
            if (array_key_exists('applicant_special_group', $data)) {
                foreach ($data['applicant_special_group'] as $index => $value) {
                    if (isset($value['start_date']) && !empty($value['start_date'])) {
                        $data['applicant_special_group'][$index]['start_date'] = Carbon::createFromFormat('d-m-Y', $value['start_date'])->format('Y-m-d');
                    }
                    if (isset($value['end_date']) && !empty($value['end_date'])) {
                        $data['applicant_special_group'][$index]['end_date'] = Carbon::createFromFormat('d-m-Y', $value['end_date'])->format('Y-m-d');
                    }
                    $this->saveSpecialApply($data['applicant_special_group'][$index]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function removeApplicantsSpecialApplyByApplicantId(array $ids, $applicantId)
    {
        try {
            return ApplicantSpecialApply::whereNotIn('appt_spec_appl_id', $ids)->where('applicant_id', $applicantId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}


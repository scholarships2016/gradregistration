<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationRepository;
use App\Models\Application;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicationRepositoryImpl extends AbstractRepositoryImpl implements ApplicationRepository {

    protected $ApplicationRepo;
    private $paging = 10;

    public function __construct( ) {
        parent::setModelClassName(Applicant::class);
       
    }
//
//    public function searchByCriteria($criteria = null, $paging = false) {
//
//        return $result;
//    }

    public function saveApplication($data) {
        $result = false;
        $app_id = null;
        $curriculum_num = null;
//        try {
//            $id = null;
//
//            if (array_key_exists('application_id', $data) || !empty($data['application_id']))
//                $id = $data['application_id'];
//
//            $chk = $this->find($id);
//            $curObj = $chk ? $chk : new Application;
//            if ($chk) {
//                if ($chk[0]['curriculum_num'] == null && array_key_exists('curriculum_id', $data)) {
//                    $year = \App\Models\CurriculumActivity::leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
//                            ->where('curriculum_id', $data['curriculum_id'])->select('academic_year')->get();
//                    $app_id = Application::leftJoin('curriculum_activity', 'application.curr_act_id', 'curriculum_activity.curr_act_id')
//                                    ->leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
//                                    ->where('academic_year',$year->academic_year)->count() + 1;
//
//
//                    $curriculum_num = Application::where('curriculum_id', $data['curriculum_id'])->whereNotNull('curriculum_num')->count() + 1;
//                }
//            }
//
//
//            if (array_key_exists('applicant_id', $data))
//                $curObj->applicant_id = $data['applicant_id'];
//            if (array_key_exists('curr_act_id', $data))
//                $curObj->curr_act_id = $data['curr_act_id'];
//            if (array_key_exists('stu_citizen_card', $data))
//                $curObj->stu_citizen_card = $data['stu_citizen_card'];
//            if (array_key_exists('curriculum_id', $data))
//                $curObj->curriculum_id = $data['curriculum_id'];
//            if (array_key_exists('program_id', $data))
//                $curObj->program_id = $data['program_id'];
//            if (array_key_exists('sub_major_id', $data))
//                $curObj->sub_major_id = $data['sub_major_id'];
//            if (array_key_exists('flow_id', $data))
//                $curObj->flow_id = $data['flow_id'];
//
//            if ($app_id)
//                $curObj->app_id = $app_id;
//            if ($curriculum_num)
//                $curObj->curriculum_num = $curriculum_num;
//
//
//            if (array_key_exists('creator', $data))
//                $curObj->creator = $data['creator'];
//            if (array_key_exists('modifier', $data))
//                $curObj->modifier = $data['modifier'];
//
//
//            $result = $curObj->save();
//        } catch (\Exception $ex) {
//            throw $ex;
//        }
        return $result;
    }

}

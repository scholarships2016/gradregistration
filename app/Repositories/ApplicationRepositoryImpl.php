<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationRepository;
use App\Models\CurriculumActivity;
use App\Models\Application;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicationRepositoryImpl extends AbstractRepositoryImpl implements ApplicationRepository {

    protected $ApplicationRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(Application::class);
    }

    public function getData($applicantID = null, $applicationID = null) {
        $result = null;
        try {
            $result = Application::select('*', 'application.created as appDates')
                            ->leftJoin('curriculum', 'application.curriculum_id', 'curriculum.curriculum_id')
                            ->leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                            ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
                            ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                            ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                            ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                            ->leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
                            ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                            ->leftJoin('mcoursestudy', 'curriculum_program.coursecodeno', '=', 'mcoursestudy.coursecodeno')
                            ->leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                            ->leftJoin("tbl_major", function($join) {
                                $join->on("tbl_major.major_code", "=", "mcoursestudy.majorcode")
                                ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                            })
                            ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                            ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                            ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                            ->leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
                            
                           
                            ->Where(function ($query)use ($applicationID) {
                                if ($applicationID) {
                                    $query->where('application.application_id', $applicationID);
                                }
                            })
                            ->Where(function ($query)use ($applicantID) {
                                if ($applicantID) {
                                    $query->where('application.applicant_id', $applicantID);
                                }
                            })
                            ->orderBy('application.application_id')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
       
        return $result;
    }

    public function saveApplication($data) {
        $result = false;
        $app_id = null;
        $curriculum_num = null;

        try {
            $id = null;

            if (array_key_exists('application_id', $data) || !empty($data['application_id']))
                $id = $data['application_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new Application;
            if ($chk) {
                if ($chk[0]['curriculum_num'] == null && array_key_exists('curriculum_id', $data)) {
                    $year = CurriculumActivity::leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
                                    ->where('curriculum_id', $data['curriculum_id'])->select('academic_year')->get();

                    $app_id = Application::leftJoin('curriculum_activity', 'application.curr_act_id', 'curriculum_activity.curr_act_id')
                                    ->leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
                                    ->where('academic_year', $year->academic_year)->count() + 1;


                    $curriculum_num = Application::where('curriculum_id', $data['curriculum_id'])->whereNotNull('curriculum_num')->count() + 1;
                }
            }


            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('curr_act_id', $data))
                $curObj->curr_act_id = $data['curr_act_id'];
            if (array_key_exists('stu_citizen_card', $data))
                $curObj->stu_citizen_card = $data['stu_citizen_card'];
            if (array_key_exists('curriculum_id', $data))
                $curObj->curriculum_id = $data['curriculum_id'];

            if (array_key_exists('program_id', $data))
                $curObj->program_id = $data['program_id'];
            if (array_key_exists('sub_major_id', $data))
                $curObj->sub_major_id = $data['sub_major_id'];
            if (array_key_exists('flow_id', $data))
                $curObj->flow_id = $data['flow_id'];

            if ($app_id)
                $curObj->app_id = $app_id;
            if ($curriculum_num)
                $curObj->curriculum_num = $curriculum_num;


            if (array_key_exists('creator', $data))
                $curObj->creator = $data['creator'];
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];


            $result = $curObj->save();
        } catch (\Exception $ex) {

            $result = false;
            throw $ex;
        }


        return $result;
    }

}

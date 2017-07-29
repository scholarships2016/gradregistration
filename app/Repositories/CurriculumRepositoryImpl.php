<?php

namespace App\Repositories;

use App\Repositories\Contracts\CurriculumRepository;
use App\Models\Curriculum;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CurriculumRepositoryImpl extends AbstractRepositoryImpl implements CurriculumRepository {

    protected $projectPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(Curriculum::class);
    }

    public function searchByCriteria($curriculum_id = null,$curr_act_id = null,$criteria = null, $faculty_id = null, $degree_id = null, $status = null, $program_id = null,$inTime =true, $paging = false) {
 
        $result = null;
        try {
             DB::statement(DB::raw('set @rownum=0'));
            $cur = Curriculum::leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                    ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
                    ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                    ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                    ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                    ->leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
                    ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                    ->leftJoin('mcoursestudy', 'curriculum_program.coursecodeno', '=', 'mcoursestudy.coursecodeno')
                    ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                    ->leftJoin("tbl_major", function($join) {
                        $join->on("tbl_major.major_code", "=", "mcoursestudy.majorcode")
                        ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                    })
                    ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                    ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                    ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                    ->where('curriculum.status', 'like', '%' . $status . '%')
                   ->where('apply_setting.is_active', 'like', '%' . $status . '%')
                    ->Where(function ($query)use ($curriculum_id) {
                        if ($curriculum_id) {
                            $query->where('curriculum.curriculum_id', $curriculum_id);
                        }
                    })
                    ->Where(function ($query)use ($curr_act_id) {
                        if ($curr_act_id) {
                            $query->where('curriculum_activity.curr_act_id', $curr_act_id);
                        }
                    })
                    ->Where(function ($query)use ($degree_id) {
                        if ($degree_id) {
                            $query->where('tbl_Degree.degree_id', $degree_id);
                        }
                    })
                    ->Where(function ($query)use ($faculty_id) {
                        if ($faculty_id) {
                            $query->where('tbl_Degree.faculty_id', $faculty_id);
                        }
                    })  
                      ->Where(function ($query)use ($program_id) {
                        if ($program_id) {
                            $query->where('curriculum_program.program_id', $program_id);
                        }
                    }) 
                    ->Where(function ($query)use ($inTime) {
                        if ($inTime) {
                            $query->where('apply_setting.start_date','<=',Carbon::now())
                                    ->where('apply_setting.end_date','>=',Carbon::now())
                                     ;
                        } 
                    }) 
                    ->Where(function ($query)use ($criteria) {
                        $query->where('degree_name', 'like', '%' . $criteria . '%')
                        ->orwhere('degree_name_en', 'like', '%' . $criteria . '%')
                        ->orwhere('department_name', 'like', '%' . $criteria . '%')
                        ->orwhere('department_name_en', 'like', '%' . $criteria . '%')
                        ->orwhere('faculty_name', 'like', '%' . $criteria . '%')
                        ->orwhere('faculty_full', 'like', '%' . $criteria . '%')
                        ->orwhere('major_name', 'like', '%' . $criteria . '%')
                        ->orwhere('major_name_en', 'like', '%' . $criteria . '%')
                        ->orwhere('project_name', 'like', '%' . $criteria . '%')
                        ->orwhere('project_name_en', 'like', '%' . $criteria . '%')
                        ->orwhere('prog_type_name', 'like', '%' . $criteria . '%')
                        ->orwhere('prog_type_name_en', 'like', '%' . $criteria . '%')
                        ->orwhere('degree_lavel_name', 'like', '%' . $criteria . '%')
                        ->orwhere('office_time', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%');
                    })
                    ->select([ DB::raw('* , @rownum  := @rownum  + 1 AS rownum') ])
                  
                   ->orderBy('curriculum.curriculum_id');
                
            $result = ($paging) ? $cur->offset($paging['start'])->limit($paging['length']) : $cur->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    
}

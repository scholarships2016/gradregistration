<?php

namespace App\Repositories;

use App\Repositories\Contracts\CurriculumProgramRepository;
use App\Models\CurriculumProgram;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class CurriculumProgramRepositoryImpl extends AbstractRepositoryImpl implements CurriculumProgramRepository {

    protected $engtestPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(CurriculumProgram::class);
    }

    public function getCurriculumProgramByCurriculum_id($cur = null, $tid = null) {

        $result = null;
        try {
            /*
              $result = CurriculumProgram::leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
              ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
              ->leftJoin('mcoursestudy', 'curriculum_program.program_id', 'mcoursestudy.coursecodeno')
              ->Where(function ($query) use ($cur) {
              if ($cur) {
              $query->where('curriculum_id', $cur);
              }
              })
              ->Where(function ($query) use ($tid) {
              if ($tid) {
              $query->where('tbl_program_type.program_type_id', $tid);
              }
              })
              ->get();
             */
            $result = CurriculumProgram::leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                    ->leftJoin('mcoursestudy', 'curriculum_program.program_id', 'mcoursestudy.coursecodeno')
                    ->leftJoin('tbl_program_plan', 'mcoursestudy.plan', '=', 'tbl_program_plan.prog_plan_name')
                    ->Where(function ($query) use ($cur) {
                        if ($cur) {
                            $query->where('curriculum_id', $cur);
                        }
                    })
                    ->Where(function ($query) use ($tid) {
                        if ($tid) {
                            $query->where('tbl_program_type.program_type_id', $tid);
                        }
                    })
                    ->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data) {
        try {
            $currObj = (array_key_exists('curr_prog_id', $data) && !empty($data['curr_prog_id'])) ? $this->find($data['curr_prog_id']) : new CurriculumProgram();
            if (empty($currObj)) {
                $currObj = new CurriculumProgram();
            }
            if (array_key_exists('curriculum_id', $data)) {
                $currObj->curriculum_id = $data['curriculum_id'];
            }
            if (array_key_exists('program_id', $data)) {
                $currObj->program_id = $data['program_id'];
            }
            if (array_key_exists('program_type_id', $data)) {
                $currObj->program_type_id = $data['program_type_id'];
            }
            if (array_key_exists('program_plan_id', $data)) {
                $currObj->program_plan_id = $data['program_plan_id'];
            }

            //Creator and Editor
//            if (array_key_exists('creator', $data)) {
//                $currObj->creator = $data['creator'];
//            }
//            if (array_key_exists('modifier', $data)) {
//                $currObj->modifier = $data['modifier'];
//            }

            $currObj->save();
            return $currObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function removeCurrProgNotInListByCurriculumId(array $ids, $curriculumId) {
        try {
            return CurriculumProgram::whereNotIn('curr_prog_id', $ids)->where('curriculum_id', $curriculumId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCurrProgListByCurriculumId($id) {
        try {
            $mcQuery = DB::table('mcoursestudy as mc')
                    ->select('mc.coursecodeno', 'mc.degree', 'mc.depcode', 'mc.majorcode', 'mc.thai', 'mc.english', 'mc.plan', 'mc.status')                    
                    ->whereRaw("(mc.stopacadyear='' || mc.stopacadyear is NULL) && (mc.lastacadyear ='' || mc.lastacadyear is NULL) ")
                    ->where('mc.majorcode', function ($query) use ($id) {
                        $query->from('curriculum as sub_curr')
                        ->select('sub_curr.major_id')
                        ->where('sub_curr.curriculum_id', '=', $id);
                    })
                    ->where('mc.degree', function ($query) use ($id) {
                $query->from('curriculum as sub_curr2')
                ->select('sub_curr2.degree_id')
                ->where('sub_curr2.curriculum_id', '=', $id);
            });

            $cpQuery = DB::table('curriculum_program as cp_sub')
                            ->select('cp_sub.curr_prog_id', 'cp_sub.curriculum_id', 'cp_sub.program_id', 'cp_sub.program_type_id', 'cp_sub.program_plan_id')->where('cp_sub.curriculum_id', '=', $id);

            $mainQuery = DB::table(DB::raw("({$cpQuery->toSql()}) as cp"))
                    ->select('cp.curr_prog_id', 'cp.curriculum_id', 'cp.program_type_id', 'cp.program_plan_id', 'cp.program_id', 'sub_mc.coursecodeno', 'sub_mc.degree', 'sub_mc.depcode', 'sub_mc.majorcode', 'sub_mc.thai', 'sub_mc.english', 'sub_mc.plan')
                    ->rightJoin(DB::raw("({$mcQuery->toSql()}) as sub_mc"), function ($join) {
                        $join->on('sub_mc.coursecodeno', '=', 'cp.program_id');
                    })
                    ->mergeBindings($mcQuery)
                    ->mergeBindings($cpQuery);
            return $mainQuery->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCurrProgByProgramID($program_id, $curliculum_id) {
        try {
            $result = CurriculumProgram::Where(function ($query) use ($curliculum_id) {
                        if ($curliculum_id) {
                            $query->where('curriculum_id', $curliculum_id);
                        }
                    })
                    ->Where(function ($query) use ($program_id) {
                        if ($program_id) {
                            $query->where('program_id', $program_id);
                        }
                    })
                    ->first();
            return $result;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

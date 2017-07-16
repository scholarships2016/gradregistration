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
     public function getCurriculumProgramByCurriculum_id($id){
    
        $result = null;
        try {
           
            $result = CurriculumProgram::leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
                    ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                    ->leftJoin('mcoursestudy','curriculum_program.coursecodeno','mcoursestudy.coursecodeno')
                    ->where('curriculum_id',$id)->get();
                     
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }


}

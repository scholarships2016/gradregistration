<?php

namespace App\Repositories;

use App\Repositories\Contracts\CurriculumSubMajorRepository;
use App\Models\CurriculumSubMajor;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class CurriculumSubMajorRepositoryImpl extends AbstractRepositoryImpl implements CurriculumSubMajorRepository {

    protected $engtestPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblCurriculumSubMajor::class);
    }
 
    public function getSubMajorByCurriculum_id($id){
    
        $result = null;
        try {
           
            $result = CurriculumSubMajor::leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                    ->where('curriculum_id',$id)->get();
                     
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

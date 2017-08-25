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

    public function save(array $data)
    {
        $currObj = (array_key_exists('curr_sub_major_id', $data) && !empty($data['curr_sub_major_id'])) ? $this->find($data['curr_sub_major_id']) : new CurriculumSubMajor();
        if (empty($currObj)) {
            $currObj = new CurriculumSubMajor();
        }
        if (array_key_exists('curriculum_id', $data)) {
            $currObj->curriculum_id = $data['curriculum_id'];
        }
        if (array_key_exists('sub_major_id', $data)) {
            $currObj->sub_major_id = $data['sub_major_id'];
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
    }

    public function removeCurrSubmajorByCurriculumId($id)
    {
        try {
            return CurriculumSubMajor::where('curriculum_id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCurrSubMajorByCurriculumId($id)
    {
        try {

            $subCurrSmQuery = DB::table('curriculum_sub_major as currSm')
                ->select('currSm.curr_sub_major_id', 'currSm.curriculum_id', 'currSm.sub_major_id')
                ->where('currSm.curriculum_id', '=', $id);

            $subMjQuery = DB::table('curriculum as curr')
                ->select('tblSubM.sub_major_id', 'tblSubM.sub_major_name', 'tblSubM.sub_major_name_en', 'tblSubM.major_id')
                ->join('tbl_sub_major as tblSubM', function ($join) {
                    $join->on('tblSubM.major_id', '=', 'curr.major_id');
                })
                ->where('curr.curriculum_id', '=', $id);

            $mainQuery = DB::table(DB::raw("({$subCurrSmQuery->toSql()}) as subCurrSm"))
                ->select('subCurrSm.curr_sub_major_id', 'subCurrSm.curriculum_id', 'sub_mj.sub_major_id', 'sub_mj.sub_major_name',
                    'sub_mj.sub_major_name_en', 'sub_mj.major_id')
                ->rightJoin(DB::raw("({$subMjQuery->toSql()}) as sub_mj"), function ($join) {
                    $join->on('sub_mj.sub_major_id', '=', 'subCurrSm.sub_major_id');
                })
                ->mergeBindings($subCurrSmQuery)
                ->mergeBindings($subMjQuery);
            return $mainQuery->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

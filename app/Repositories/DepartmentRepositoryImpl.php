<?php

namespace App\Repositories;

use App\Repositories\Contracts\DepartmentRepository;
use App\Models\TblDepartment;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DepartmentRepositoryImpl extends AbstractRepositoryImpl implements DepartmentRepository {

    protected $DepartmentRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDepartment::class);
    }

    public function getByfaculty_Id($id, $is_active='') {
        $result = null;
        try {
          
          if($is_active==null || $is_active==""){
            $result =  TblDepartment::where('faculty_id', $id)->get();
          }else{
            $result =  TblDepartment::where('faculty_id', $id)->where('IS_ACTIVE', $is_active)->get();
          }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

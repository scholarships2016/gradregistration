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

    public function getByfaculty_Id($id) {
        $result = null;
        try {           
            $result =  TblDepartment::where('faculty_id', $id)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

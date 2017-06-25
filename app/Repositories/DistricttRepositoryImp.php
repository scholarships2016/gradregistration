<?php

namespace App\Repositories;

use App\Repositories\Contracts\DepartmentRepository;
use App\Models\TblDepartment;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DepartmentRepositoryImpl extends AbstractRepositoryImpl implements DepartmentRepository {

    protected $departmentRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDepartment::class);
    }
 

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\CourseRepository;
use App\Models\TblCourse;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class CourseRepositoryImpl extends AbstractRepositoryImpl implements CourseRepository {

    protected $courseRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblCourse::class);
    }
 

}

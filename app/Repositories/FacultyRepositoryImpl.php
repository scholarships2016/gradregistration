<?php

namespace App\Repositories;

use App\Repositories\Contracts\FacultyRepository;
use App\Models\TblFaculty;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class FacultyRepositoryImpl extends AbstractRepositoryImpl implements FacultyRepository {

    protected $facultyPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblFaculty::class);
    }
 

}

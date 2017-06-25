<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProjectRepository;
use App\Models\TblProject;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ProjectRepositoryImpl extends AbstractRepositoryImpl implements ProjectRepository {

    protected $projectPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblProject::class);
    }
 

}

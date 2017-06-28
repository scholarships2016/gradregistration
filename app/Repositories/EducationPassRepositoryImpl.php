<?php

namespace App\Repositories;

use App\Repositories\Contracts\EducationPassRepository;
use App\Models\TblEducationPass;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class EducationPassRepositoryImpl extends AbstractRepositoryImpl implements EducationPassRepository {

    protected $educationPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblEducationPass::class);
    }
 

}

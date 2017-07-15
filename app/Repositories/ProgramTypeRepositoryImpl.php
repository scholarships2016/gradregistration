<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProgramTypeRepository;
use App\Models\TblProgramType;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ProgramTypeRepositoryImpl extends AbstractRepositoryImpl implements ProgramTypeRepository {

    protected $ProgramTypePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblProgramType::class);
    }
 

}

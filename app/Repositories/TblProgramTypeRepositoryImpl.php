<?php

namespace App\Repositories;

use App\Models\TblProgramType;
use App\Repositories\Contracts\TblProgramTypeRepository;

class TblProgramTypeRepositoryImpl extends AbstractRepositoryImpl implements TblProgramTypeRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblProgramType::class);
    }


}

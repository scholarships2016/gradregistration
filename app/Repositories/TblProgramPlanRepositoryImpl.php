<?php

namespace App\Repositories;


use App\Models\TblProgramPlan;
use App\Repositories\Contracts\TblProgramPlanRepository;

class TblProgramPlanRepositoryImpl extends AbstractRepositoryImpl implements TblProgramPlanRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblProgramPlan::class);
    }


}

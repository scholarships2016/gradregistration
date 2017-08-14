<?php

namespace App\Repositories;

use App\Models\TblCurriculumWorkflowStatus;
use App\Repositories\Contracts\TblCurriculumWorkflowStatusRepository;


class TblCurriculumWorkflowStatusRepositoryImpl extends AbstractRepositoryImpl implements TblCurriculumWorkflowStatusRepository
{
    public function __construct()
    {
        parent::setModelClassName(TblCurriculumWorkflowStatus::class);
    }


}

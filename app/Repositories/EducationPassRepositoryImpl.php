<?php

namespace App\Repositories;

use App\Repositories\Contracts\EducationPassRepository;
use App\Models\TblEducationPass;

class EducationPassRepositoryImpl extends AbstractRepositoryImpl implements EducationPassRepository
{

    protected $educationPassRepo;
    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblEducationPass::class);
    }


}

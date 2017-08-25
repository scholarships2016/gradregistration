<?php

namespace App\Repositories;


use App\Models\TblProject;
use App\Repositories\Contracts\TblProjectRepository;

class TblProjectRepositoryImpl extends AbstractRepositoryImpl implements TblProjectRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblProject::class);
    }


}

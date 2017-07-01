<?php

namespace App\Repositories;

use App\Models\ApplicantEdu;
use App\Models\ApplicantWork;
use App\Repositories\Contracts\ApplicantWorkRepository;


class ApplicantWorkRepositoryImpl extends AbstractRepositoryImpl implements ApplicantWorkRepository
{
    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(ApplicantWork::class);
    }

}

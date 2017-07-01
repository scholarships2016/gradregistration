<?php

namespace App\Repositories;

use App\Models\ApplicantEdu;
use App\Repositories\Contracts\ApplicantEduRepository;


class ApplicantEduRepositoryImpl extends AbstractRepositoryImpl implements ApplicantEduRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(ApplicantEdu::class);

    }

}

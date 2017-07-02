<?php

namespace App\Repositories\Contracts;

interface ApplicantEduRepository
{

    public function saveApplicantEduList(array $datas, $applicantId);

    public function getApplicantEduByApplicantId($applicantId);

}

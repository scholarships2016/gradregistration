<?php

namespace App\Repositories\Contracts;

interface ApplicantWorkRepository
{
    public function saveApplicantWorkList(array $datas, $applicantId);

    public function getApplicantWorkByApplicantId($applicantId);
}

<?php

namespace App\Repositories\Contracts;

interface ApplicantNewsSourceRepository
{
    public function getApplicantNewsSourceByApplicantId($applicantId);

    public function updateSetOfApplicantNewsSrc(array $data);
}

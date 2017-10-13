<?php

namespace App\Repositories\Contracts;

interface ApplicantSpecialApplyRepository
{
    public function saveSpecialApply(array $data);

    public function getApplicantSpecialApplyById($applicantId);

    public function saveApplicantsSpecialApply(array $data);

}

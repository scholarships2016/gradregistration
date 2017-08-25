<?php

namespace App\Repositories\Contracts;

interface ApplicantEduRepository
{

    public function saveApplicantEduList(array $datas, $applicantId);

    public function getApplicantEduByApplicantId($applicantId);
    
    public function getApplicantEduAllByApplicantId($applicantId);

    public function save(array $data);

}

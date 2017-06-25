<?php

namespace App\Repositories\Contracts;

interface ApplicantRepository {

    public function getByCitizenOrEmail($citizencard, $email);

    public function searchByCriteria($criteria = null, $paging = false);

    public function getEduApplicant($applicantID);

    public function getWorkApplicant($applicantID);
}
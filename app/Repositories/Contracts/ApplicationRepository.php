<?php

namespace App\Repositories\Contracts;

interface ApplicationRepository {

    public function saveApplication($data);

    public function getData($applicantID = null, $applicationID = null);
}

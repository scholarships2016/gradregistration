<?php

namespace App\Repositories\Contracts;

interface ApplicationRepository
{

    public function saveApplication($data);

    public function getAppData($applicationID = null);

    public function getData($applicantID = null, $applicationID = null);

    public function getDataonly($applicantID = null, $applicationID = null);

    public function getDatacountByStatus($applicantID);

    public function getDatacountByStatusUse($applicantID);

    public function getApplicationAndProgramInfoByApplicationId($applicationId);

    public function doDeleteApplicationByApplicationId($applicationId);
}

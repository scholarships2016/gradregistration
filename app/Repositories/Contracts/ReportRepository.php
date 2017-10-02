<?php

namespace App\Repositories\Contracts;

interface ReportRepository
{
    public function getReport01DataByCriteria($criteria = null);

    public function getReport02DataByCriteria($criteria = null);

    public function getReport03DataByCriteria($criteria = null);

    public function getReport04ApplicationDataByCriteria($criteria = null);

    public function getReport04ApplicantDataByCriteria($criteria = null);

    public function getFlowApplyForDropdown();
}
 

 

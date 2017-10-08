<?php

namespace App\Repositories\Contracts;

interface ReportRepository
{
    public function getReport01DataByCriteria($criteria = null);

    public function getReport01DataByCriteria2($criteria = null);

    public function getReport02DataByCriteria($criteria = null);

    public function getReport02DataByCriteria2($criteria = null);

    public function getReport03DataByCriteria($criteria = null);

    public function getReport04ApplicationDataByCriteria($criteria = null);

    public function getReport04ApplicantDataByCriteria($criteria = null);

    public function getFlowApplyForDropdown();

    public function getEngScoreReport($criteria = null);

    public function getSatisfactionChartsData($criteria = null);

    public function getSatisfactionData($criteria = null);

    public function getDatasRegistrationCenter1($criteria = null);

    public function getDatasRegistrationCenter2($criteria = null);

    public function getDatasPolicyAndPlan($criteria = null);

}




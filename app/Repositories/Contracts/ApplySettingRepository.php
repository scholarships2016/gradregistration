<?php

namespace App\Repositories\Contracts;

interface ApplySettingRepository
{
    public function getApplySettingByAcademicYear($year);

    public function getDistinctApplySettingSemesterByAcademicYear($year = null);

    public function getApplySettingBySemesterAndAcademicYear($semester, $year);

}

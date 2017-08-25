<?php

namespace App\Repositories\Contracts;

interface ApplySettingRepository
{
    public function getApplySettingByAcademicYear($year);

    public function getDistinctApplySettingSemesterByAcademicYear($year = null);

    public function getApplySettingBySemesterAndAcademicYear($semester, $year);

    public function getDistinctAcademicYear();

    public function saveApplySetting(array $data);

    public function save(array $data);

    public function getApplySettingPaging();

    public function checkRemoveableApplySettingByApplySettingId($id);

    public function checkRemoveableApplySettingBySemesterAndAcademicYear($semester, $academicYear);

    public function deleteBySemesterAndAcademicYear($semester, $academicYear);

}

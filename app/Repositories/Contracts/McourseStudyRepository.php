<?php

namespace App\Repositories\Contracts;

interface McourseStudyRepository
{
    public function getMcourseStudyByMajorIdAndDegreeId($majorId, $degreeId);

    public function getMcourseStudyPaging1($criteria = null);

    public function updateAllCourse();
}

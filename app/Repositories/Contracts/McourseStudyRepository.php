<?php

namespace App\Repositories\Contracts;

interface McourseStudyRepository
{
    public function getMcourseStudyByMajorIdAndDegreeId($majorId, $degreeId);

}

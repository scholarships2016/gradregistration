<?php

namespace App\Repositories\Contracts;

interface CurriculumActivityRepository
{
    public function save(array $data);

    public function removeCurrActNotInListByCurriculumId(array $ids, $curriculumId);

    public function getCurrActListByCurriculumId($id);

    public function getDistinctSemesterAndAcademicYearByCurriculumId($id);
}

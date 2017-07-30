<?php

namespace App\Repositories\Contracts;

interface CurriculumProgramRepository
{
public function getCurriculumProgramByCurriculum_id($id);

    public function save(array $data);

    public function removeCurrProgNotInListByCurriculumId(array $ids, $curriculumId);

    public function getCurrProgListByCurriculumId($id);
}

<?php

namespace App\Repositories\Contracts;

interface CurriculumSubMajorRepository
{
public function getSubMajorByCurriculum_id($id);

    public function save(array $data);

    public function removeCurrSubmajorByCurriculumId($id);

    public function getCurrSubMajorByCurriculumId($id);

}

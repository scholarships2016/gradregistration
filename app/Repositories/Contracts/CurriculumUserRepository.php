<?php

namespace App\Repositories\Contracts;

interface CurriculumUserRepository
{
    public function save(array $data);

    public function removeCurrUserNotInListByCurriculumId(array $ids, $curriculumId);

    public function removeCurrUserByCurriculumId($curriculumId);

}

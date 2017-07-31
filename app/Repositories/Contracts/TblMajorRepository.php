<?php

namespace App\Repositories\Contracts;

interface TblMajorRepository
{
    public function getMajorByDepartmentId($depId);
}

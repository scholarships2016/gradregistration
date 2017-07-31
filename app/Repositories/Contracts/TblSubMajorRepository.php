<?php

namespace App\Repositories\Contracts;

interface TblSubMajorRepository
{
    public function getSubMajorByMajorId($majorId);
}

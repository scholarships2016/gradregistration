<?php

namespace App\Repositories\Contracts;

interface DistrictRepository
{

    public function getDistrictByProvinceId($provinceId);

}

<?php

namespace App\Repositories;

use App\Models\TblDistrict;
use App\Repositories\Contracts\DistrictRepository;


class DistrictRepositoryImpl extends AbstractRepositoryImpl implements DistrictRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblDistrict::class);
    }

    public function getDistrictByProvinceId($provinceId)
    {
        $district = null;
        try {
            $district = TblDistrict::where('province_id', $provinceId)->get();
        } catch (\Exception $ex) {
            throw  $ex;
        }
        return $district;
    }

}

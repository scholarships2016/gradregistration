<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProvinceRepository;
use App\Models\TblProvince;


class ProvinceRepositoryImpl extends AbstractRepositoryImpl implements ProvinceRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblProvince::class);
    }


}

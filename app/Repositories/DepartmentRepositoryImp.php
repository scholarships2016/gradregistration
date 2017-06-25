<?php

namespace App\Repositories;

use App\Repositories\Contracts\DistrictRepository;
use App\Models\TblDistrict;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DistrictRepositoryImpl extends AbstractRepositoryImpl implements DistrictRepository {

    protected $districtRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDistrict::class);
    }
 

}

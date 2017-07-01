<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProvinceRepository;
use App\Models\TblProvince;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ProvinceRepositoryImpl extends AbstractRepositoryImpl implements ProvinceRepository {

    protected $facultyPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblProvince::class);
    }
 

}

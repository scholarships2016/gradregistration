<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReligionRepository;
use App\Models\TblReligion;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ReligionRepositoryImpl extends AbstractRepositoryImpl implements ReligionRepository {

    protected $religionPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblReligion::class);
    }
 

}

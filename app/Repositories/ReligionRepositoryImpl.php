<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReligionRepository;
use App\Models\TblReligion;


class ReligionRepositoryImpl extends AbstractRepositoryImpl implements ReligionRepository {


    public function __construct() {
        parent::setModelClassName(TblReligion::class);
    }


}

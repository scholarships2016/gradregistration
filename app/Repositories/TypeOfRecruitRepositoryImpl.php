<?php

namespace App\Repositories;

use App\Repositories\Contracts\TypeOfRecruitRepository;
use App\Models\TblTypeOfRecruit;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class TypeOfRecruitRepositoryImpl extends AbstractRepositoryImpl implements TypeOfRecruitRepository {

    protected $typeofrecruitPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblTypeOfRecruit::class);
    }
 

}

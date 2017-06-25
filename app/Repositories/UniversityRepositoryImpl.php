<?php

namespace App\Repositories;

use App\Repositories\Contracts\UniversityRepository;
use App\Models\TblUniversity;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class UniversityRepositoryImpl extends AbstractRepositoryImpl implements UniversityRepository {

    protected $universityPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblUniversity::class);
    }
 

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationRepository;
use App\Models\TblApplication;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicationRepositoryImpl extends AbstractRepositoryImpl implements ApplicationRepository {

    protected $projectPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblApplication::class);
    }

    public function searchByCriteria($criteria = null, $paging = false) {
         
        return $result;
    }

}

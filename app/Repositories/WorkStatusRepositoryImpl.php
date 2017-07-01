<?php

namespace App\Repositories;

use App\Repositories\Contracts\WorkStatusRepository;
use App\Models\TblWorkStatus;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class WorkStatusRepositoryImpl extends AbstractRepositoryImpl implements WorkStatusRepository {

    protected $workstatusPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblWorkStatus::class);
    }
 

}

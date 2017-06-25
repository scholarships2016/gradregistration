<?php

namespace App\Repositories;

use App\Repositories\Contracts\StatusRepository;
use App\Models\TblStatus;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class StatusRepositoryImpl extends AbstractRepositoryImpl implements StatusRepository {

    protected $statusPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblStatus::class);
    }
 

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\GaduateLevelRepository;
use App\Models\TblGaduateLevel;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class GaduateLevelRepositoryImpl extends AbstractRepositoryImpl implements GaduateLevelRepository {

    protected $gaduatelevelPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblGaduateLevel::class);
    }
 

}

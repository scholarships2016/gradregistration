<?php

namespace App\Repositories;

use App\Repositories\Contracts\NewsSourceRepository;
use App\Models\TblNewsSource;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class NewsSourceRepositoryImpl extends AbstractRepositoryImpl implements NewsSourceRepository {

    protected $newssourcePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblNewsSource::class);
    }
 

}

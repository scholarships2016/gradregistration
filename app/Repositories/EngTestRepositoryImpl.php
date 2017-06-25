<?php

namespace App\Repositories;

use App\Repositories\Contracts\EngTestRepository;
use App\Models\TblEngTest;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class EngTestRepositoryImpl extends AbstractRepositoryImpl implements EngTestRepository {

    protected $engtestPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblEngTest::class);
    }
 

}

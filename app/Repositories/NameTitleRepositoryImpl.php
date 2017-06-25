<?php

namespace App\Repositories;

use App\Repositories\Contracts\NameTitleRepository;
use App\Models\TblNameTitle;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class NameTitleRepositoryImpl extends AbstractRepositoryImpl implements NameTitleRepository {

    protected $nametitlePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblNameTitle::class);
    }
 

}

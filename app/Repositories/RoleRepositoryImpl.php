<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepository;
use App\Models\TblRole;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class RoleRepositoryImpl extends AbstractRepositoryImpl implements RoleRepository {

    protected $rolePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblRole::class);
    }
 

}

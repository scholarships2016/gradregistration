<?php

namespace App\Repositories;

use App\Models\TblPermission;
use App\Repositories\Contracts\TblPermissionRepository;

class TblPermissionRepositoryImpl extends AbstractRepositoryImpl implements TblPermissionRepository
{

    public function __construct()
    {
        parent::setModelClassName(TblPermission::class);
    }

}

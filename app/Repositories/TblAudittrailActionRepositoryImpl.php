<?php

namespace App\Repositories;

use App\Models\TblAudittrailAction;
use App\Repositories\Contracts\TblAudittrailActionRepository;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class TblAudittrailActionRepositoryImpl extends AbstractRepositoryImpl implements TblAudittrailActionRepository
{
    /**
     * TblAudittrailActionRepositoryImpl constructor.
     */
    public function __construct()
    {
        parent::setModelClassName(TblAudittrailAction::class);
    }
}

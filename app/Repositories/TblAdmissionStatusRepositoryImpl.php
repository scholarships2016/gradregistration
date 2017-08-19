<?php

namespace App\Repositories;

use App\Repositories\Contracts\TblAdmissionStatusRepository;
use App\Models\TblAdmissionStatus;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class TblAdmissionStatusRepositoryImpl extends AbstractRepositoryImpl implements TblAdmissionStatusRepository {

    protected $TblAdmissionStatusRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblAdmissionStatus::class);
    }
  public function getAdmissionStatusDropDownlist()
    {
        $res = TblAdmissionStatus::select('admission_status_id as value','admission_status_name_th as text')->get();
        return $res;
    }

}

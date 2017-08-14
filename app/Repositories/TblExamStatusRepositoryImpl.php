<?php

namespace App\Repositories;

use App\Repositories\Contracts\TblExamStatusRepository;
use App\Models\TblExamStatus;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class TblExamStatusRepositoryImpl extends AbstractRepositoryImpl implements TblExamStatusRepository {

    protected $tblExamStatusPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblExamStatus::class);
    }
  public function getExamStatusDropDownlist()
    {
        $res = TblExamStatus::select('exam_id as value','exam_name as text')->get();
        return $res;
    }

}

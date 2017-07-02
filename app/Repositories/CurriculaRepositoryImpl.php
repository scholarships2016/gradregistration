<?php

namespace App\Repositories;

use App\Repositories\Contracts\CurriculaRepository;
use App\Models\TblCurricula;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class CurriculaRepositoryImpl extends AbstractRepositoryImpl implements CurriculaRepository {

    protected $curriculaRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblCurricula::class);
    }
  public function getByDepartment_Id($id) {
        $result = null;
        try {
            $result = TblCurricula::where('department_id',$id)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}


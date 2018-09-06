<?php

namespace App\Repositories;


use App\Models\TblMajor;
use App\Repositories\Contracts\TblMajorRepository;
use Illuminate\Support\Facades\Log;


class TblMajorRepositoryImpl extends AbstractRepositoryImpl implements TblMajorRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblMajor::class);
    }

    public function getMajorByDepartmentId($depId, $is_active='')
    {
        Log::info('getMajorByDeportmentId');
        try {
          if($is_active==null || $is_active==""){
            return TblMajor::where('department_id', '=', $depId)->get();
          }else{
            return TblMajor::where('department_id', '=', $depId)->where('IS_ACTIVE', $is_active)->get();
          }

        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

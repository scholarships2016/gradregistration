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

    public function getMajorByDepartmentId($depId)
    {
        Log::info('getMajorByDeportmentId');
        try {
            return TblMajor::where('department_id', '=', $depId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

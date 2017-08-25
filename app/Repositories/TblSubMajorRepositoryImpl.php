<?php

namespace App\Repositories;


use App\Models\TblSubMajor;
use App\Repositories\Contracts\TblSubMajorRepository;

class TblSubMajorRepositoryImpl extends AbstractRepositoryImpl implements TblSubMajorRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblSubMajor::class);
    }

    public function getSubMajorByMajorId($majorId)
    {
        try {
            return TblSubMajor::where('major_id', '=', $majorId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

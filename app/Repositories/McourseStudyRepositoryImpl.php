<?php

namespace App\Repositories;


use App\Models\Mcoursestudy;
use App\Repositories\Contracts\McourseStudyRepository;

class McourseStudyRepositoryImpl extends AbstractRepositoryImpl implements McourseStudyRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(Mcoursestudy::class);
    }

    public function getMcourseStudyByMajorIdAndDegreeId($majorId, $degreeId)
    {
        try {
            return Mcoursestudy::where('majorcode', '=', $majorId)->where('degree', '=', $degreeId)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

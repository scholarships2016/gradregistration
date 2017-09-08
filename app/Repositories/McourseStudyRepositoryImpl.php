<?php

namespace App\Repositories;


use App\Models\Mcoursestudy;
use App\Repositories\Contracts\McourseStudyRepository;
use Illuminate\Support\Facades\DB;

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

    public function getMcourseStudyPaging1($criteria = null)
    {
        try {
            $columnMap = array(
                1 => "mc.coursecodeno",
                2 => "mc.thai",
                3 => "mc.coursecodeno",
                4 => "full_owner",
                5 => "mc.status");
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;

            $query = DB::table('mcoursestudy as mc')
                ->select('mc.coursecodeno', 'mc.plan', 'mc.status', 'mc.thai', 'mc.english',
                    'tbl_dep.department_id', 'tbl_dep.department_name',
                    'maj.major_id', 'maj.major_name', 'tbl_fac.faculty_id',
                    'tbl_fac.faculty_name'
                    ,
                    DB::raw('CONCAT("สาขาวิชา ",IFNULL(maj.major_name," - ")," ภาควิชา ",IFNULL(tbl_dep.department_name," - ")," คณะ ",IFNULL(tbl_fac.faculty_name," - ")) as full_owner')
                )
                ->leftJoin("tbl_major as maj", function ($join) {
                    $join->on("maj.major_id", "=", "mc.majorcode");
                })
                ->leftJoin("tbl_department as tbl_dep", function ($join) {
                    $join->on("tbl_dep.department_id", "=", "mc.depcode");
                })
                ->leftJoin("tbl_faculty as tbl_fac", function ($join) {
                    $join->on("tbl_fac.faculty_id", "=", "tbl_dep.faculty_id");
                });


            $recordsTotal = $query->get()->count();


            if (isset($criteria['mcoursecode']) && !empty($criteria['mcoursecode'])) {
                $query->orWhere('mc.coursecodeno', 'like', '%' . trim($criteria['mcoursecode']) . '%');
            }
            if (isset($criteria['thai']) && !empty($criteria['thai'])) {
                $query->orWhere('mc.thai', 'like', '%' . trim($criteria['thai']) . '%');
            }
            if (isset($criteria['plan']) && !empty($criteria['plan'])) {
                $query->orWhere("mc.plan", "like", '%' . trim($criteria['plan']) . '%');
            }
            if (isset($criteria['status']) && !empty($criteria['status'])) {
                $query->orWhere("mc.status", "=", trim($criteria['status']));
            }
            if (isset($criteria['owner']) && !empty($criteria['owner'])) {
                $query->orWhere(function ($query) use ($criteria) {
                    $query->orWhere("maj.major_name", "like", "%" . trim($criteria['owner']) . "%")
                        ->orWhere("tbl_dep.department_name", "like", "%" . trim($criteria['owner']) . "%")
                        ->orWhere("tbl_fac.faculty_name", "like", "%" . trim($criteria['owner']) . "%");
                });
            }

            $recordsFiltered = $query->get()->count();
            $query->orderBy($columnMap[$criteria['order'][0]['column']], $criteria['order'][0]['dir']);
            $query->offset($criteria['start'])->limit($criteria['length']);
            $data = $query->get();

            $result = array('draw' => $draw,
                'recordsTotal' => $recordsTotal,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            );

            return $result;

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function updateAllCourse()
    {
        try {
            $queryStr = " INSERT INTO gradregistration.mcoursestudy( ";
            $queryStr .= "programsystem, studyprogramsystem, calendar,";
            $queryStr .= "coursecodeno, degree, depcode, majorcode,";
            $queryStr .= "plan, language, thai ,english, degreethai,";
            $queryStr .= "degreeenglish, status, usercode, updatedate, changestamp )";
            $queryStr .= " SELECT M.PROGRAMSYSTEM, M.STUDYPROGRAMSYSTEM, M.CALENDAR, ";
            $queryStr .= " M.COURSECODENO, M.DEGREE, M.DEPCODE, M.MAJORCODE, ";
            $queryStr .= " M.PLAN, M.LANGUAGE, M.THAI, ";
            $queryStr .= " M.ENGLISH, M.DEGREETHAI, M.DEGREEENGLISH, ";
            $queryStr .= " M.STATUS, M.USERCODE, M.UPDATEDATE, M.CHANGESTAMP ";
            $queryStr .= " FROM cureg.mcoursestudy as M WHERE coursecodeno = M.COURSECODENO ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " PROGRAMSYSTEM = M.PROGRAMSYSTEM, ";
            $queryStr .= " STUDYPROGRAMSYSTEM = M.STUDYPROGRAMSYSTEM, CALENDAR=M.CALENDAR, ";
            $queryStr .= " COURSECODENO = M.COURSECODENO, DEGREE = M.DEGREE, ";
            $queryStr .= " DEPCODE = M.DEPCODE, MAJORCODE = M.MAJORCODE, ";
            $queryStr .= " PLAN = M.PLAN, LANGUAGE = M.LANGUAGE, THAI = M.THAI, ";
            $queryStr .= " ENGLISH = M.ENGLISH, DEGREETHAI = M.DEGREETHAI, DEGREEENGLISH = M.DEGREEENGLISH, ";
            $queryStr .= " STATUS = M.STATUS, USERCODE = M.USERCODE, UPDATEDATE = M.UPDATEDATE, ";
            $queryStr .= " CHANGESTAMP = M.CHANGESTAMP, sync_modified = NOW() ";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

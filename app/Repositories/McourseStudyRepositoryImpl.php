<?php

namespace App\Repositories;


use App\Models\Mcoursestudy;
use App\Repositories\Contracts\McourseStudyRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

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
            return Mcoursestudy::where('majorcode', '=', $majorId)
                ->where('degree', '=', $degreeId)
                ->where('status', '=', 'A')->get();
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
            DB::statement(DB::raw('set @rownum=' . $criteria['start']));
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;

            $query = DB::table('mcoursestudy as mc')
                ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'mc.coursecodeno', 'mc.plan', 'mc.status', 'mc.thai', 'mc.english',
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
                $query->where('mc.coursecodeno', 'like', '%' . trim($criteria['mcoursecode']) . '%');
            }
            if (isset($criteria['thai']) && !empty($criteria['thai'])) {
                $query->where('mc.thai', 'like', '%' . trim($criteria['thai']) . '%');
            }
            if (isset($criteria['plan']) && !empty($criteria['plan'])) {
                $query->where("mc.plan", "like", '%' . trim($criteria['plan']) . '%');
            }
            if (isset($criteria['status']) && !empty($criteria['status'])) {
                $query->where("mc.status", "=", trim($criteria['status']));
            }
            if (isset($criteria['owner']) && !empty($criteria['owner'])) {
                $query->where(function ($query) use ($criteria) {
                    $query->orWhere("maj.major_name", "like", "%" . trim($criteria['owner']) . "%")
                        ->orWhere("tbl_dep.department_name", "like", "%" . trim($criteria['owner']) . "%")
                        ->orWhere("tbl_fac.faculty_name", "like", "%" . trim($criteria['owner']) . "%");
                });
            }

            $recordsFiltered = $query->get()->count();

            if (isset($criteria['order'][0]['column'])) {
                $query->orderBy($columnMap[$criteria['order'][0]['column']], $criteria['order'][0]['dir']);
            } else {
                $query->orderBy('status', 'desc');
            }

            if (!($criteria['length'] == -1)) {
                $query->offset($criteria['start'])->limit($criteria['length']);
            }

            DB::statement(DB::raw('set @rownum=' . $criteria['start']));
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
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $queryStr = " INSERT INTO gradregistration.mcoursestudy( ";
            $queryStr .= "programsystem, studyprogramsystem, calendar,";
            $queryStr .= "coursecodeno, degree, depcode, majorcode,";
            $queryStr .= "plan, language, thai ,english, degreethai,";
            $queryStr .= "degreeenglish, status, usercode, updatedate, changestamp, sync_created, sync_creator)";
            $queryStr .= " SELECT M.PROGRAMSYSTEM, M.STUDYPROGRAMSYSTEM, M.CALENDAR, ";
            $queryStr .= " M.COURSECODENO, M.DEGREE, M.DEPCODE, M.MAJORCODE, ";
            $queryStr .= " M.PLAN, M.LANGUAGE, M.THAI, ";
            $queryStr .= " M.ENGLISH, M.DEGREETHAI, M.DEGREEENGLISH, ";
            $queryStr .= " M.STATUS, M.USERCODE, M.UPDATEDATE, M.CHANGESTAMP, NOW(),'{$performer}'  ";
            $queryStr .= " FROM cureg.mcoursestudy as M WHERE coursecodeno = M.COURSECODENO ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " PROGRAMSYSTEM = M.PROGRAMSYSTEM, ";
            $queryStr .= " STUDYPROGRAMSYSTEM = M.STUDYPROGRAMSYSTEM, CALENDAR=M.CALENDAR, ";
            $queryStr .= " COURSECODENO = M.COURSECODENO, DEGREE = M.DEGREE, ";
            $queryStr .= " DEPCODE = M.DEPCODE, MAJORCODE = M.MAJORCODE, ";
            $queryStr .= " PLAN = M.PLAN, LANGUAGE = M.LANGUAGE, THAI = M.THAI, ";
            $queryStr .= " ENGLISH = M.ENGLISH, DEGREETHAI = M.DEGREETHAI, DEGREEENGLISH = M.DEGREEENGLISH, ";
            $queryStr .= " STATUS = M.STATUS, USERCODE = M.USERCODE, UPDATEDATE = M.UPDATEDATE, ";
            $queryStr .= " CHANGESTAMP = M.CHANGESTAMP, sync_modified = NOW(), sync_modifier='{$performer}' ";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getAllDistinctStudyPlans()
    {
        try {
            $query = DB::table('mcoursestudy as mc')
                ->select(DB::raw('distinct mc.plan'))
                ->whereNotNull('mc.plan')
                ->whereRaw("trim(mc.plan) <> '' ")
                ->orderBy('mc.plan', 'asc');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getMcourseStudyByCoursecodeno($coursecodeno)
    {
        try {
            return $this->where('coursecodeno', '=', $coursecodeno)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function saveMcourse(array $data)
    {
        try {
            if (!isset($data['coursecodeno']) || empty($data['coursecodeno'])) {
                throw new \Exception('required coursecodeno');
            }
            $obj = $this->find($data['coursecodeno']);
            if (empty($obj)) {
                $obj = new Mcoursestudy();
            }

            if (array_key_exists('coursecodeno', $data)) {
                $obj->coursecodeno = trim($data['coursecodeno']);
            }
            if (array_key_exists('thai', $data)) {
                $obj->thai = trim($data['thai']);
            }
            if (array_key_exists('english', $data)) {
                $obj->english = trim($data['english']);
            }
            if (array_key_exists('plan', $data)) {
                $obj->plan = trim($data['plan']);
            }
            if (array_key_exists('degree', $data)) {
                $obj->degree = $data['degree'];
            }
            if (array_key_exists('depcode', $data)) {
                $obj->depcode = $data['depcode'];
            }
            if (array_key_exists('majorcode', $data)) {
                $obj->majorcode = $data['majorcode'];
            }

            if (array_key_exists('status', $data) && !empty($data['status'])) {
                $obj->status = $data['status'];
            } else {
                $obj->status = null;
            }

            if (array_key_exists('sync_creator', $data)) {
                $obj->sync_creator = $data['sync_creator'];
            }
            if (array_key_exists('sync_modifier', $data)) {
                $obj->sync_modifier = $data['sync_modifier'];
            }

            $obj->save();
            return $obj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function deleteMcourseStudyByCoursecodeno($coursecodeno)
    {
        try {
            return $this->findOrFail($coursecodeno)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

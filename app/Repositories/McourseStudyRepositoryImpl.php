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

    public function getMcourseStudyByMajorIdAndDegreeId($majorId, $degreeId, $is_active="")
    {
        try {
          if($is_active==null || $is_active==""){
            return Mcoursestudy::where('majorcode', '=', $majorId)
                ->where('degree', '=', $degreeId)->get();
              }else{
                return Mcoursestudy::where('majorcode', '=', $majorId)
                    ->where('degree', '=', $degreeId)
                    ->where('is_active', '=', $is_active)
                    ->whereRaw("(stopacadyear='' || stopacadyear is NULL) && (lastacadyear ='' || lastacadyear is NULL) ")->get();

              }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getMcourseStudyByMajorIdAndDegreeId_backup($majorId, $degreeId)
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
                5 => "mc.is_active");
            DB::statement(DB::raw('set @rownum=' . $criteria['start']));
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;

            $query = DB::table('mcoursestudy as mc')
                ->select(DB::raw('@rownum  := @rownum  + 1 AS rownum'),'mc.coursecodeno', 'mc.plan', 'mc.is_active', 'mc.thai', 'mc.english',
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
            if (isset($criteria['is_active']) && !empty($criteria['is_active'])) {
                $query->where("mc.is_active", "=", trim($criteria['is_active']));
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
                $query->orderBy('is_active', 'desc');
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
            $queryStr .= "degreeenglish, status, usercode, updatedate, changestamp, sync_created, sync_creator, beginacadyear, beginsemester, lastacadyear, lastsemester,	stopacadyear, stopsemester, is_active)";
            $queryStr .= " SELECT M.PROGRAMSYSTEM, M.STUDYPROGRAMSYSTEM, M.CALENDAR, ";
            $queryStr .= " M.COURSECODENO, M.DEGREE, M.DEPCODE, M.MAJORCODE, ";
            $queryStr .= " M.PLAN, M.LANGUAGE, M.THAI, ";
            $queryStr .= " M.ENGLISH, M.DEGREETHAI, M.DEGREEENGLISH, ";
            $queryStr .= " M.STATUS, M.USERCODE, M.UPDATEDATE, M.CHANGESTAMP, NOW(),'{$performer}',  ";
            $queryStr .= " M.BEGINACADYEAR, M.BEGINSEMESTER, M.LASTACADYEAR, M.LASTSEMESTER, M.STOPACADYEAR, M.STOPSEMESTER,";
            $queryStr .= "  CASE WHEN (M.LASTACADYEAR = '' || M.LASTACADYEAR is NULL) && (M.STOPACADYEAR = '' || M.STOPACADYEAR is NULL || M.STOPACADYEAR ='9999') THEN 1 ELSE 0 END ";
            $queryStr .= " FROM CUREG.MCOURSESTUDY as M WHERE coursecodeno = M.COURSECODENO ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " PROGRAMSYSTEM = M.PROGRAMSYSTEM, ";
            $queryStr .= " STUDYPROGRAMSYSTEM = M.STUDYPROGRAMSYSTEM, CALENDAR=M.CALENDAR, ";
            $queryStr .= " COURSECODENO = M.COURSECODENO, DEGREE = M.DEGREE, ";
            $queryStr .= " DEPCODE = M.DEPCODE, MAJORCODE = M.MAJORCODE, ";
            $queryStr .= " PLAN = M.PLAN, LANGUAGE = M.LANGUAGE, THAI = M.THAI, ";
            $queryStr .= " ENGLISH = M.ENGLISH, DEGREETHAI = M.DEGREETHAI, DEGREEENGLISH = M.DEGREEENGLISH, ";
            $queryStr .= " STATUS = M.STATUS, USERCODE = M.USERCODE, UPDATEDATE = M.UPDATEDATE, ";
            $queryStr .= " CHANGESTAMP = M.CHANGESTAMP, sync_modified = NOW(), sync_modifier='{$performer}', ";
            $queryStr .= " BEGINACADYEAR=M.BEGINACADYEAR, BEGINSEMESTER=M.BEGINSEMESTER, LASTACADYEAR=M.LASTACADYEAR, LASTSEMESTER=M.LASTSEMESTER, STOPACADYEAR=M.STOPACADYEAR, STOPSEMESTER=M.STOPSEMESTER,";
            $queryStr .= " IS_ACTIVE=CASE WHEN (M.LASTACADYEAR = '' || M.LASTACADYEAR is NULL) && (M.STOPACADYEAR = '' || M.STOPACADYEAR is NULL || M.STOPACADYEAR ='9999') THEN 1 ELSE 0 END";


            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function syncMajor()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $this->syncViewMajor();
            $queryStr = " INSERT INTO gradregistration.tbl_major( ";
            $queryStr .= "major_id, major_name, major_name_en,";
            $queryStr .= "department_id,";
            $queryStr .= " sync_created, sync_creator)";
            $queryStr .= " SELECT DISTINCT TRIM(a.MAJORCODE), TRIM(b.THAI), TRIM(b.ENGLISH), TRIM(a.DEPCODE), NOW(), '{$performer}' FROM CUREG.MCOURSESTUDY  a
left join gradregistration.view_major b on a.majorcode=b.CODE ";
          //$queryStr .= " WHERE major_id = M.MAJORCODE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " major_name = b.THAI, ";
            $queryStr .= " major_name_en = b.ENGLISH,  ";
            $queryStr .= " department_id = a.DEPCODE,";
            $queryStr .= " sync_modified = NOW(), sync_modifier='{$performer}'";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
public function syncViewMajor()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $queryStr = " INSERT INTO gradregistration.view_major( ";
            $queryStr .= "code, thai, english)";
            $queryStr .= " SELECT DISTINCT TRIM(CODE), TRIM(Replace(Replace(Replace(THAI,'\t',''),'\n',''),'\r','')), TRIM(Replace(Replace(Replace(ENGLISH,'\t',''),'\n',''),'\r','')) FROM CUREG.MAJORVIEW M ";
          //$queryStr .= " WHERE major_id = M.MAJORCODE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " thai = TRIM(Replace(Replace(Replace(M.THAI,'\t',''),'\n',''),'\r','')), ";
            $queryStr .= " english = TRIM(Replace(Replace(Replace(M.ENGLISH,'\t',''),'\n',''),'\r',''))";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function syncMajor_Backup()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $queryStr = " INSERT INTO gradregistration.tbl_major( ";
            $queryStr .= "major_id, major_name, major_name_en,";
            $queryStr .= "department_id,";
            $queryStr .= " sync_created, sync_creator)";
            $queryStr .= " SELECT DISTINCT M.MAJORCODE, M.MAJORTHAI, M.MAJORENGLISH, M.DEPCODE, NOW(), '{$performer}' FROM CUREG.GRAD_STUDENTFACULTY as M ";
          //$queryStr .= " WHERE major_id = M.MAJORCODE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " major_name = M.MAJORTHAI, ";
            $queryStr .= " major_name_en = M.MAJORENGLISH,  ";
            $queryStr .= " department_id = M.DEPCODE,";
            $queryStr .= " sync_modified = NOW(), sync_modifier='{$performer}'";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


    public function syncDepartment()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $this->syncViewDepartment();
            $queryStr = " INSERT INTO gradregistration.tbl_department( ";
            $queryStr .= " department_id, department_name, department_name_en,";
            $queryStr .= " faculty_id,";
            $queryStr .= " sync_created, sync_creator)";
            $queryStr .= " SELECT DISTINCT A.DEPCODE, CASE WHEN B.THAI IS NOT NULL AND B.THAI <> '' THEN B.THAI ELSE A.DEPCODE END, CASE WHEN B.ENGLISH IS NOT NULL AND B.ENGLISH <> '' THEN B.ENGLISH ELSE A.DEPCODE END, SUBSTRING(A.DEPCODE, 1, 2), NOW(), '{$performer}'  FROM gradregistration.mcoursestudy as A ";
            $queryStr .= " LEFT JOIN gradregistration.view_department B ON A.DEPCODE=B.CODE  ";
            //$queryStr .= " WHERE department_id = M.DEPCODE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " department_name=CASE WHEN B.THAI IS NOT NULL AND B.THAI <> '' THEN B.THAI ELSE A.DEPCODE END,  ";
            $queryStr .= " department_name_en=CASE WHEN B.ENGLISH IS NOT NULL AND B.ENGLISH <> '' THEN B.ENGLISH ELSE A.DEPCODE END ,     ";
            $queryStr .= " faculty_id = SUBSTRING(A.DEPCODE, 1, 2), ";
            $queryStr .= " sync_modified = NOW(), sync_modifier='{$performer}'";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
    public function syncViewDepartment()
        {
          $performer = session('user_name');
          if($performer==""){
            $performer = "BATCH";
          }
            try {
                $queryStr = " INSERT INTO gradregistration.view_department( ";
                $queryStr .= "code, thai, english)";
                $queryStr .= " SELECT DISTINCT M.DEPCODE, M.DEPARTMENTTHAI, M.DEPARTMENTENGLISH FROM CUREG.GRAD_STUDENTFACULTY M ";
              //$queryStr .= " WHERE major_id = M.MAJORCODE ";
                $queryStr .= " ON DUPLICATE KEY UPDATE ";
                $queryStr .= " thai = M.DEPARTMENTTHAI, ";
                $queryStr .= " english = M.DEPARTMENTENGLISH";

                DB::statement($queryStr);
                return true;
            } catch (\Exception $ex) {
                throw $ex;
            }
        }

    public function syncDegree()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $queryStr = " INSERT INTO gradregistration.tbl_degree( ";
            $queryStr .= "degree_id, degree_name, degree_name_en,";
              $queryStr .= " sync_created, sync_creator, is_active)";
            $queryStr .= " SELECT DISTINCT M.DEGREE, M.DEGREETHAI, M.DEGREEENGLISH, NOW(), '{$performer}', ";
            $queryStr .= " CASE WHEN (M.LASTACADYEAR = '' || M.LASTACADYEAR is NULL) && (M.STOPACADYEAR = '' || M.STOPACADYEAR is NULL  || M.STOPACADYEAR ='9999') THEN 1 ELSE 0 END ";
            $queryStr .= " FROM CUREG.MCOURSESTUDY as M ";
            //$queryStr .= " WHERE degree_id = M.DEGREE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " degree_name = M.DEGREETHAI, ";
            $queryStr .= " degree_name_en = M.DEGREEENGLISH,  ";
            $queryStr .= " sync_modified = NOW(), sync_modifier='{$performer}', ";
            $queryStr .= " is_active=CASE WHEN (M.LASTACADYEAR = '' || M.LASTACADYEAR is NULL) && (M.STOPACADYEAR = '' || M.STOPACADYEAR is NULL  || M.STOPACADYEAR ='9999') THEN 1 ELSE 0 END";
            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function syncFaculty()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
            $queryStr = " INSERT INTO gradregistration.tbl_faculty( ";
            $queryStr .= "faculty_id, faculty_name,  faculty_full, ";
            $queryStr .= " sync_created, sync_creator)";
            $queryStr .= " SELECT DISTINCT M.FACCODE, M.FACNAMETHAI, M.FACNAMEENGLISH, NOW(), '{$performer}' FROM CUREG.GRAD_STUDENTFACULTY as M ";
            //$queryStr .= " WHERE faculty_id = M.FACCODE ";
            $queryStr .= " ON DUPLICATE KEY UPDATE ";
            $queryStr .= " faculty_name = M.FACNAMETHAI, ";
            $queryStr .= " faculty_full = M.FACNAMEENGLISH,  ";
            $queryStr .= " sync_modified = NOW(), sync_modifier='{$performer}'";

            DB::statement($queryStr);
            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function syncDataStatus()
    {
      $performer = session('user_name');
      if($performer==""){
        $performer = "BATCH";
      }
        try {
          $query_department0 = " UPDATE gradregistration.tbl_department set is_active=0 WHERE department_id NOT IN(select distinct depcode from gradregistration.mcoursestudy where (LASTACADYEAR = '' || LASTACADYEAR is NULL) && (STOPACADYEAR = '' || STOPACADYEAR is NULL  ||  STOPACADYEAR ='9999') ) ";
          $query_department1 = " UPDATE gradregistration.tbl_department set is_active=1 WHERE department_id IN(select distinct depcode from gradregistration.mcoursestudy where (LASTACADYEAR = '' || LASTACADYEAR is NULL) && (STOPACADYEAR = '' || STOPACADYEAR is NULL  ||  STOPACADYEAR ='9999') ) ";

          $query_major0 = " UPDATE gradregistration.tbl_major set is_active=0 WHERE major_id NOT IN(select distinct majorcode from gradregistration.mcoursestudy where (LASTACADYEAR = '' || LASTACADYEAR is NULL) && (STOPACADYEAR = '' || STOPACADYEAR is NULL  ||  STOPACADYEAR ='9999') ) ";
          $query_major1 = " UPDATE gradregistration.tbl_major set is_active=1 WHERE major_id IN(select distinct majorcode from gradregistration.mcoursestudy where (LASTACADYEAR = '' || LASTACADYEAR is NULL) && (STOPACADYEAR = '' || STOPACADYEAR is NULL  ||  STOPACADYEAR ='9999') ) ";

            DB::statement($query_department0);
            DB::statement($query_department1);
            DB::statement($query_major0);
            DB::statement($query_major1);
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

            if (array_key_exists('is_active', $data) && !empty($data['is_active'])) {
                $obj->is_active = $data['is_active'];
            } else {
                $obj->is_active = null;
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

<?php

namespace App\Repositories;


use App\Models\ApplySetting;
use App\Repositories\Contracts\ApplySettingRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ApplySettingRepositoryImpl extends AbstractRepositoryImpl implements ApplySettingRepository
{

    /**
     * ApplySettingRepositoryImpl constructor.
     */
    public function __construct()
    {
        parent::setModelClassName(ApplySetting::class);
    }

    public function getApplySettingByAcademicYear($year)
    {
        try {
            return ApplySetting::where('academic_year', '=', $year)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getDistinctApplySettingSemesterByAcademicYear($year = null)
    {
        try {
            $query = DB::table('apply_setting')
                ->select(DB::raw("distinct semester, case semester when 1 then 'ภาคต้น' when 2 then 'ภาคปลาย' else '-' end  as semester_th ,
                case semester when 1 then 'First' when 2 then 'Second' else '-' end  as semester_en  "),
                    'academic_year')
                ->orderBy('academic_year', 'asc')
                ->orderBy('semester', 'asc');
            if (!empty($year)) {
                $query->where('academic_year', '=', $year);
            }

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplySettingBySemesterAndAcademicYear($semester, $year)
    {
        try {
            $query = DB::table('apply_setting')
                ->select('apply_setting_id', 'semester',
                    'academic_year', 'round_no', DB::raw("date_format(start_date,'%d/%m/%Y') as start_date , date_format(end_date,'%d/%m/%Y') as end_date"),
                    'is_active', 'status')
                ->where('academic_year', '=', $year)
                ->where('semester', '=', $semester)
                ->orderBy('round_no', 'asc');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getDistinctAcademicYear()
    {
        try {
            $query = DB::table('apply_setting')
                ->select(DB::raw("distinct academic_year"));
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function saveApplySetting(array $data)
    {
        DB::beginTransaction();

        try {
            if (!isset($data['semester']) || !isset($data['academic_year'])) {
                throw new \Exception('No Semester and academic year param');
            }
            $existObj = ApplySetting::where('semester', '=', $data['semester'])->where('academic_year', '=', $data['academic_year'])->count();
            if (!empty($existObj) && !$data['isEdit']) {
                throw new \Exception('Cannot Save');
            }

            if (isset($data['ids']) && sizeof($data['ids']) > 0) {
                $del = ApplySetting::where('semester', '=', $data['semester'])
                    ->where('academic_year', '=', $data['academic_year'])
                    ->whereNotIn('apply_setting_id', $data['ids'])->delete();
            }

            if (isset($data['apply_setting_group'])) {
                foreach ($data['apply_setting_group'] as $index => $value) {
                    $this->save($value);
                }
            }

            DB::commit();
            return $this->getApplySettingBySemesterAndAcademicYear($data['semester'], $data['academic_year']);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function save(array $data)
    {
        try {

            $obj = isset($data['apply_setting_id']) ? $this->find($data['apply_setting_id']) : new ApplySetting();
            if (!$obj) {
                $obj = new ApplySetting();
            }

            if (array_key_exists('semester', $data)) {
                $obj->semester = intval($data['semester']);
            }
            if (array_key_exists('academic_year', $data)) {
                $obj->academic_year = $data['academic_year'];
            }
            if (array_key_exists('round_no', $data)) {
                $obj->round_no = intval($data['round_no']);
            }
            if (array_key_exists('start_date', $data)) {
                $obj->start_date = $data['start_date'];
            }
            if (array_key_exists('end_date', $data)) {
                $obj->end_date = $data['end_date'];
            }
            if (array_key_exists('is_active', $data)) {
                $obj->is_active = intval($data['is_active']);
            }
            if (array_key_exists('status', $data)) {
                $obj->status = intval($data['status']);
            } else {
                $obj->status = 0;
            }
            //Who
            if (array_key_exists('creator', $data)) {
                $obj->creator = $data['creator'];
            }
            if (array_key_exists('modifier', $data)) {
                $obj->modifier = $data['modifier'];
            }

            $obj->save();
            return $obj;

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getApplySettingPaging()
    {
        try {
            $subQuery = DB::table('apply_setting as aps')
                ->select('aps.academic_year', 'aps.semester','aps.round_no',
                    DB::raw("concat(date_format(aps.start_date,'%d/%m/%Y'),' - ',date_format(aps.end_date,'%d/%m/%Y'),'|',aps.is_active,'|',aps.status)  as daterange"))
                ->groupBy('aps.academic_year', 'aps.semester', 'aps.round_no', 'aps.start_date', 'aps.end_date', 'aps.is_active', 'aps.status')
                ->orderBy('aps.academic_year', 'asc')
                ->orderBy('aps.semester', 'asc')
                ->orderBy('aps.round_no', 'asc');

            $mainQuery = DB::table(DB::raw("({$subQuery->toSql()}) as sub"))
                ->select('sub.academic_year', 'sub.semester',
                    DB::raw("GROUP_CONCAT(sub.daterange order by sub.round_no asc SEPARATOR ',' ) as dateranges"))
                ->groupBy('sub.academic_year', 'sub.semester');


            return $mainQuery->get();

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function checkRemoveableApplySettingByApplySettingId($id)
    {
        try {

            $query = DB::table('application as app')
                ->select('app.applicantion_id')
                ->join('curriculum_activity as curr_act', function ($join) {
                    $join->on('curr_act.curr_act_id', '=', 'app.curr_act_id');
                })
                ->join('apply_setting as app_set', function ($join) {
                    $join->on('app_set.apply_setting_id', '=', 'curr_act.apply_setting_id');
                })
                ->where('app_set.apply_setting_id', '=', $id);

            if ($query->count() > 0) {
                return false;
            }

            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function checkRemoveableApplySettingBySemesterAndAcademicYear($semester, $academicYear)
    {
        try {

            $query = DB::table('application as app')
                ->select('app.applicantion_id')
                ->join('curriculum_activity as curr_act', function ($join) {
                    $join->on('curr_act.curr_act_id', '=', 'app.curr_act_id');
                })
                ->join('apply_setting as app_set', function ($join) {
                    $join->on('app_set.apply_setting_id', '=', 'curr_act.apply_setting_id');
                })
                ->where('app_set.semester', '=', $semester)
                ->where('app_set.academic_year', '=', $academicYear);

            if ($query->count() > 0) {
                return false;
            }

            return true;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function deleteBySemesterAndAcademicYear($semester, $academicYear)
    {
        try {
            $row = ApplySetting::where('semester', '=', $semester)
                ->where('academic_year', '=', $academicYear)->delete();
            return $row;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
      public function getApplySettingNow()
    {
      $current_date = date('Y-m-d');
        try {
            return ApplySetting::where('is_active', '=', '1')->where('status','=','1')->where('start_date','<=',$current_date)->where('end_date','>=',$current_date)->orderBy('end_date','desc')->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

<?php

namespace App\Repositories;


use App\Models\ApplySetting;
use App\Repositories\Contracts\ApplySettingRepository;
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
                    'is_active','status')
                ->where('academic_year', '=', $year)
                ->where('semester', '=', $semester)
                ->orderBy('round_no', 'asc');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

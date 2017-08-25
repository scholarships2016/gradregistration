<?php

namespace App\Repositories;


use App\Models\CurriculumActivity;
use App\Repositories\Contracts\CurriculumActivityRepository;
use Illuminate\Support\Facades\DB;

class CurriculumActivityRepositoryImpl extends AbstractRepositoryImpl implements CurriculumActivityRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(CurriculumActivity::class);
    }

    public function save(array $data)
    {
        try {
            $currObj = (array_key_exists('curr_act_id', $data) && !empty($data['curr_act_id'])) ? $this->find($data['curr_act_id']) : new CurriculumActivity();
            if (empty($currObj)) {
                $currObj = new CurriculumActivity();
            }
            if (array_key_exists('curriculum_id', $data)) {
                $currObj->curriculum_id = $data['curriculum_id'];
            }
            if (array_key_exists('apply_setting_id', $data)) {
                $currObj->apply_setting_id = $data['apply_setting_id'];
            }
            if (array_key_exists('exam_schedule', $data)) {
                $currObj->exam_schedule = $data['exam_schedule'];
            }
            if (array_key_exists('announce_exam_date', $data)) {
                $currObj->announce_exam_date = $data['announce_exam_date'];
            }
            if (array_key_exists('announce_admission_date', $data)) {
                $currObj->announce_admission_date = $data['announce_admission_date'];
            }
            if (array_key_exists('orientation_date', $data)) {
                $currObj->orientation_date = $data['orientation_date'];
            }
            if (array_key_exists('orientation_location', $data)) {
                $currObj->orientation_location = $data['orientation_location'];
            }

            //Creator and Editor
//            if (array_key_exists('creator', $data)) {
//                $currObj->creator = $data['creator'];
//            }
//            if (array_key_exists('modifier', $data)) {
//                $currObj->modifier = $data['modifier'];
//            }

            $currObj->save();
            return $currObj;

        } catch (\Exception $ex) {
            throw  $ex;
        }
    }

    public function removeCurrActNotInListByCurriculumId(array $ids, $curriculumId)
    {
        try {
            return CurriculumActivity::whereNotIn('curr_act_id', $ids)->where('curriculum_id', $curriculumId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getCurrActListByCurriculumId($id)
    {
        try {


            $appSetQuery = DB::table('apply_setting as app_set')
                ->select(DB::raw('distinct app_set.semester,app_set.academic_year'))
                ->whereIn('app_set.apply_setting_id', function ($query) use ($id) {
                    $query->from('curriculum_activity as ca_filter')
                        ->select('ca_filter.apply_setting_id')
                        ->where('ca_filter.curriculum_id', '=', $id);
                });

            $appSubMQuery = DB::table('apply_setting as app_subm')
                ->select('app_subm.apply_setting_id', 'app_subm.semester', 'app_subm.academic_year',
                    'app_subm.round_no', 'app_subm.start_date', 'app_subm.end_date','app_subm.is_active','app_subm.status')
                ->join(DB::raw("({$appSetQuery->toSql()}) as sub_1"), function ($join) {
                    $join->on('sub_1.semester', '=', 'app_subm.semester')
                        ->on('sub_1.academic_year', '=', 'app_subm.academic_year');
                })
                ->mergeBindings($appSetQuery);

            $subCurrActQuery = DB::table('curriculum_activity as subCurrAct')
                ->select('curr_act_id', 'curriculum_id', 'apply_setting_id', 'exam_schedule',
                    'announce_exam_date', 'announce_admission_date', 'orientation_date',
                    'orientation_location')
                ->where('subCurrAct.curriculum_id', '=', $id);

            $mainQuery = DB::table(DB::raw("({$subCurrActQuery->toSql()}) as curr_act"))
                ->select(
                    'curr_act.curr_act_id',
                    'curr_act.curriculum_id',
                    'curr_act.exam_schedule',
                    DB::raw("date_format(curr_act.announce_exam_date,'%d/%m/%Y') as announce_exam_date"),
                    DB::raw("date_format(curr_act.announce_admission_date,'%d/%m/%Y') as announce_admission_date"),
                    DB::raw("date_format(curr_act.orientation_date,'%d/%m/%Y') as orientation_date"),
                    'curr_act.orientation_location',
                    'sub.apply_setting_id',
                    'sub.semester',
                    DB::raw("case sub.semester when 1 then 'ภาคต้น' when 2 then 'ภาคปลาย' else '-' end  as semester_th"),
                    DB::raw("case sub.semester when 1 then 'First' when 2 then 'Second' else '-' end  as semester_en"),
                    'sub.academic_year',
                    'sub.round_no',
                    'sub.is_active',
                    'sub.status',
                    DB::raw("date_format(sub.start_date,'%d/%m/%Y') as start_date"),
                    DB::raw("date_format(sub.end_date,'%d/%m/%Y') as end_date")
                )
                ->rightJoin(DB::raw("({$appSubMQuery->toSql()}) as sub"), function ($join) {
                    $join->on('sub.apply_setting_id', '=', 'curr_act.apply_setting_id');
                })
                ->orderBy('sub.round_no', 'asc')
                ->mergeBindings($subCurrActQuery)
                ->mergeBindings($appSubMQuery);

            return $mainQuery->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getDistinctSemesterAndAcademicYearByCurriculumId($id)
    {
        try {
            $query = DB::table('curriculum_activity as ca')
                ->select(DB::raw('distinct aps.semester , aps.academic_year'))
                ->join('apply_setting as aps', function ($join) {
                    $join->on('aps.apply_setting_id', '=', 'ca.apply_setting_id');
                })->where('ca.curriculum_id', '=', $id);
            return $query->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReportRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportRepositoryImpl extends AbstractRepositoryImpl implements ReportRepository
{
    public function __construct()
    {
    }

    public function getReport01DataByCriteria($criteria = null)
    {
        try {
            $query = DB::table("application as app")
                ->select('curr.curriculum_id', 'curr_prog.curr_prog_id',
                    'curr_prog.program_id', 'mc.thai',
                    'prog_t.cond_id', 'prog_t.prog_type_name',
                    DB::raw("count(app.application_id) as app_amt"),
                    DB::raw("sum(case bank.bank_account when 123 then curr.apply_fee else 0 end) as ktb_bank"),
                    DB::raw("sum(case bank.bank_account when 453 then curr.apply_fee else 0 end) as scb_bank"),
                    DB::raw("sum(case bank.bank_account when 755 then curr.apply_fee else 0 end) as tmb_bank"),
                    DB::raw("sum(case bank.bank_account when 110 then curr.apply_fee else 0 end) as tha_bank")
                )
                ->join("curriculum_activity as curr_act", function ($join) {
                    $join->on("curr_act.curr_act_id", "=", "app.curr_act_id");
                })
                ->join("apply_setting as app_set", function ($join) {
                    $join->on("app_set.apply_setting_id", "=", "curr_act.apply_setting_id");
                })
                ->join("curriculum_program as curr_prog", function ($join) {
                    $join->on("curr_prog.curriculum_id", "=", "app.curriculum_id")
                        ->on("curr_prog.curr_prog_id", "=", "app.curr_prog_id");
                })
                ->join("curriculum as curr", function ($join) {
                    $join->on("curr.curriculum_id", "=", "curr_prog.curriculum_id");
                })
                ->join("tbl_bank as bank", function ($join) {
                    $join->on("bank.bank_id", "=", "app.bank_id");
                })
                ->leftJoin("tbl_major as mj", function ($join) {
                    $join->on("mj.major_id", "=", "curr.major_id");
                })
                ->leftJoin("tbl_program_type as prog_t", function ($join) {
                    $join->on("prog_t.program_type_id", "=", "curr_prog.program_type_id");
                })
                ->leftJoin("mcoursestudy as mc", function ($join) {
                    $join->on("mc.coursecodeno", "=", "curr_prog.program_id");
                })
                ->leftJoin("curriculum_sub_major as curr_sub_mj", function ($join) {
                    $join->on("curr_sub_mj.curriculum_id", "=", "app.curriculum_id");
                })
                ->groupBy('curr.curriculum_id', 'curr_prog.curr_prog_id',
                    'curr_prog.program_id', 'mc.thai',
                    'prog_t.cond_id', 'prog_t.prog_type_name', 'bank.bank_account')
                ->orderBy('mc.thai', 'asc')
                ->orderBy('prog_t.cond_id', 'asc');

            //Where Condition Below
            if (isset($criteria['semester'])) {
                $query->where('app_set.semester', '=', $criteria['semester']);
            }
            if (isset($criteria['academic_year'])) {
                $query->where('app_set.academic_year', '=', $criteria['academic_year']);
            }
            if (isset($criteria['round'])) {
                $query->where('app_set.round_no', '=', $criteria['round']);
            }
            if (isset($criteria['faculty_id'])) {
                $query->where('curr.faculty_id', '=', $criteria['faculty_id']);
            }
            if (isset($criteria['program_id'])) {
                $query->where('app.program_id', '=', $criteria['program_id']);
            }
            if (isset($criteria['sub_major_id'])) {
                $query->where("curr_sub_mj.sub_major_id", "=", $criteria['sub_major_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where("prog_t.program_type_id", "=", $criteria['program_type_id']);
            }

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getReport02DataByCriteria($criteria = null)
    {
        try {
            $query = DB::table("application as app")
                ->select(
                    DB::raw("concat(app.program_id,'-',LPAD(app.curriculum_num,4,0)) as applicant_no"),
                    DB::raw("LPAD(app.app_id,5,0) as application_no"),
                    DB::raw("concat(tle.name_title,appt.stu_first_name,' ',appt.stu_last_name) as fullname_th"),
                    DB::raw("concat(tle.name_title_en,appt.stu_first_name_en,' ',appt.stu_last_name_en) as fullname_en"),
                    DB::raw("null as receipt"), DB::raw("DATE_FORMAT(app.payment_date,'%d-%m-%Y') as payment_date"),
                    "curr.apply_fee", "bank.bank_name"
                )
                ->join("curriculum_activity as curr_act", function ($join) {
                    $join->on("curr_act.curr_act_id", "=", "app.curr_act_id");
                })
                ->join("apply_setting as app_set", function ($join) {
                    $join->on("app_set.apply_setting_id", "=", "curr_act.apply_setting_id");
                })
                ->join("curriculum as curr", function ($join) {
                    $join->on("curr.curriculum_id", "=", "app.curriculum_id");
                })
                ->join("curriculum_program as curr_prog", function ($join) {
                    $join->on("curr_prog.curriculum_id", "=", "app.curriculum_id")
                        ->on("curr_prog.curr_prog_id", "=", "app.curr_prog_id");
                })
                ->join("tbl_bank as bank", function ($join) {
                    $join->on("bank.bank_id", "=", "app.bank_id");
                })
                ->join("applicant as appt", function ($join) {
                    $join->on("appt.applicant_id", "=", "app.applicant_id");
                })
                ->leftJoin("tbl_name_title as tle", function ($join) {
                    $join->on("tle.name_title_id", "=", "appt.name_title_id");
                })
                ->leftJoin("curriculum_sub_major as curr_sub_mj", function ($join) {
                    $join->on("curr_sub_mj.curriculum_id", "=", "app.curriculum_id");
                })
                ->orderBy('applicant_no');

            //Where Condition Below
            if (isset($criteria['semester'])) {
                $query->where('app_set.semester', '=', $criteria['semester']);
            }
            if (isset($criteria['academic_year'])) {
                $query->where('app_set.academic_year', '=', $criteria['academic_year']);
            }
            if (isset($criteria['round'])) {
                $query->where('app_set.round_no', '=', $criteria['round']);
            }
            if (isset($criteria['faculty_id'])) {
                $query->where('curr.faculty_id', '=', $criteria['faculty_id']);
            }
            if (isset($criteria['program_id'])) {
                $query->where('app.program_id', '=', $criteria['program_id']);
            }
            if (isset($criteria['sub_major_id'])) {
                $query->where("curr_sub_mj.sub_major_id", "=", $criteria['sub_major_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where("curr_prog.program_type_id", "=", $criteria['program_type_id']);
            }
            if (isset($criteria['from_date'])) {
                $query->whereDate('app.payment_date', '>=', Carbon::createFromFormat('d-m-Y', $criteria['from_date'])->format('Y-m-d'));
            }

            if (isset($criteria['to_date'])) {
                $query->whereDate('app.payment_date', '<=', Carbon::createFromFormat('d-m-Y', $criteria['to_date'])->format('Y-m-d'));
            }

            return $query->get();

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getReport03DataByCriteria($criteria = null)
    {
        try {

            $query = DB::table("curriculum_program as curr_prog")
                ->select('curr.curriculum_id', 'curr_prog.curr_prog_id',
                    'curr_prog.program_id', 'fac.faculty_id', 'fac.faculty_name',
                    'curr_prog.program_type_id', 'prog_type.cond_id', 'prog_type.degree_level_name', 'prog_type.prog_type_name',
                    'mj.major_id', 'mj.major_name', 'mc.thai', 'curr.expected_amount',
                    DB::raw("concat(mj.major_id,' ',mj.major_name) as major_info"),
                    DB::raw("concat(curr_prog.program_id,' ',mc.thai) as prog_info"),
                    DB::raw("count(app.application_id) as apply_via_web_amt"),
                    DB::raw("count( case when app.flow_id >= 3 then app.application_id end ) as payed_app_amt"),
                    DB::raw("count( case when app.flow_id = 4 and app.exam_status = 2 and
                     app.admission_status_id is not null and app.admission_status_id <> 'A' and 
                     app.admission_status_id <> 'X' then app.application_id end ) as passed_exam_amt")
                )
                ->join("curriculum as curr", function ($join) {
                    $join->on("curr.curriculum_id", "=", "curr_prog.curriculum_id");
                })
                ->leftJoin("curriculum_sub_major as curr_sub_mj", function ($join) {
                    $join->on("curr_sub_mj.curriculum_id", "=", "curr.curriculum_id");
                })
                ->join("curriculum_activity as curr_act", function ($join) {
                    $join->on("curr_act.curriculum_id", "=", "curr.curriculum_id");
                })
                ->join("apply_setting as app_set", function ($join) {
                    $join->on("app_set.apply_setting_id", "=", "curr_act.apply_setting_id");
                })
                ->join("mcoursestudy as mc", function ($join) {
                    $join->on("mc.coursecodeno", "=", "curr_prog.program_id");
                })
                ->join("tbl_faculty as fac", function ($join) {
                    $join->on("fac.faculty_id", "=", "curr.faculty_id");
                })
                ->join("tbl_program_type as prog_type", function ($join) {
                    $join->on("prog_type.program_type_id", "=", "curr_prog.program_type_id");
                })
                ->join("tbl_major as mj", function ($join) {
                    $join->on("mj.major_id", "=", "curr.major_id");
                })
                ->leftJoin("application as app", function ($join) {
                    $join->on("app.curriculum_id", "=", "curr.curriculum_id")
                        ->on("app.curr_prog_id", "=", "curr_prog.curr_prog_id");
                })
                ->groupBy('curr.curriculum_id', 'curr_prog.curr_prog_id',
                    'curr_prog.program_id', 'fac.faculty_id', 'fac.faculty_name',
                    'curr_prog.program_type_id', 'prog_type.cond_id', 'prog_type.degree_level_name',
                    'prog_type.prog_type_name', 'mj.major_id', 'mj.major_name', 'mc.thai',
                    'curr.expected_amount', 'app.flow_id')
                ->orderBy('fac.faculty_id', 'asc')
                ->orderBy('prog_type.cond_id', 'asc');

            $query->where('curr.is_approve', '=', 4);

            //Where Condition Below
            if (isset($criteria['semester'])) {
                $query->where('app_set.semester', '=', $criteria['semester']);
            }
            if (isset($criteria['academic_year'])) {
                $query->where('app_set.academic_year', '=', $criteria['academic_year']);
            }
            if (isset($criteria['round'])) {
                $query->where('app_set.round_no', '=', $criteria['round']);
            }
            if (isset($criteria['faculty_id'])) {
                $query->where('curr.faculty_id', '=', $criteria['faculty_id']);
            }
            if (isset($criteria['program_id'])) {
                $query->where('app.program_id', '=', $criteria['program_id']);
            }
            if (isset($criteria['sub_major_id'])) {
                $query->where("curr_sub_mj.sub_major_id", "=", $criteria['sub_major_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where("curr_prog.program_type_id", "=", $criteria['program_type_id']);
            }

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

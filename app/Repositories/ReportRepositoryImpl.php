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

    public function getReport04ApplicationDataByCriteria($criteria = null)
    {
        try {
            $query = DB::table('application as app')
                ->select('app.app_id',
                    'app.curriculum_num', 'app.program_id',
                    'mj.major_id', 'curr_subm.curr_sub_major_id',
                    'prog_t.prog_type_name', 'appt.stu_citizen_card',
                    DB::raw("date_format(app.created,'%d-%m-%Y') as apply_date"),
                    DB::raw('null as receipt_book_no'),
                    DB::raw('null as receipt_no'), 'bank.bank_name',
                    DB::raw("date_format(app.payment_date,'%d-%m-%Y') as payment_date"),
                    'ex_s.exam_name', 'app.exam_remark', 'ad_s.admission_status_name_th',
                    'app.admission_remark', 'f_app.flow_name', 'appt.ipaddress',
                    DB::raw("GROUP_CONCAT(doc_app.doc_apply_detail SEPARATOR '|') as doc_details"),
                    DB::raw("GROUP_CONCAT(CONCAT('ชื่อ ',ref_p.app_people_name,' ที่อยู่ ',ref_p.app_people_address,
                ' โทรศัพท์ ',ref_p.app_people_phone,' ตำแหน่ง ',ref_p.app_people_position) SEPARATOR '|') as people_ref"),
                    'app.additional_answer'
                )
                ->join('applicant as appt', function ($join) {
                    $join->on('appt.applicant_id', '=', 'app.applicant_id');
                })
                ->join("curriculum_activity as curr_act", function ($join) {
                    $join->on("curr_act.curr_act_id", "=", "app.curr_act_id");
                })
                ->join("apply_setting as app_set", function ($join) {
                    $join->on("app_set.apply_setting_id", "=", "curr_act.apply_setting_id");
                })
                ->leftJoin("tbl_flow_apply as f_app", function ($join) {
                    $join->on("f_app.flow_id", "=", "app.flow_id");
                })
                ->leftJoin("curriculum as curr", function ($join) {
                    $join->on("curr.curriculum_id", "=", "app.curriculum_id");
                })->leftJoin("curriculum_program as curr_prog", function ($join) {
                    $join->on("curr_prog.curr_prog_id", "=", "app.curr_prog_id");
                })->leftJoin("tbl_major as mj", function ($join) {
                    $join->on("mj.major_id", "=", "curr.major_id");
                })->leftJoin("curriculum_sub_major as curr_subm", function ($join) {
                    $join->on("curr_subm.curriculum_id", "=", "curr.curriculum_id");
                })->leftJoin("tbl_program_type as prog_t", function ($join) {
                    $join->on("prog_t.program_type_id", "=", "curr_prog.program_type_id");
                })->leftJoin("tbl_bank as bank", function ($join) {
                    $join->on("bank.bank_id", "=", "app.bank_id");
                })->leftJoin("tbl_exam_status as ex_s", function ($join) {
                    $join->on("ex_s.exam_id", "=", "app.exam_status");
                })->leftJoin("tbl_admission_status as ad_s", function ($join) {
                    $join->on("ad_s.admission_status_id", "=", "app.admission_status_id");
                })->leftJoin("application_document_file as app_doc", function ($join) {
                    $join->on("app_doc.application_id", "=", "app.application_id");
                })->leftJoin("tbl_documents_apply as doc_app", function ($join) {
                    $join->on("doc_app.doc_apply_id", "=", "app_doc.doc_apply_id");
                })->leftJoin("application_people_ref as ref_p", function ($join) {
                    $join->on("ref_p.application_id", "=", "app.application_id");
                })->groupBy('app.app_id', 'app.curriculum_num',
                    'app.program_id', 'mj.major_id',
                    'curr_subm.curr_sub_major_id', 'prog_t.prog_type_name',
                    'appt.stu_citizen_card', 'apply_date',
                    'receipt_book_no', 'receipt_no',
                    'bank.bank_name', 'bank.bank_name',
                    'payment_date', 'ex_s.exam_name',
                    'app.exam_remark', 'ad_s.admission_status_name_th',
                    'app.admission_remark', 'f_app.flow_name',
                    'appt.ipaddress', 'app.additional_answer');

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
                $query->where("curr_subm.sub_major_id", "=", $criteria['sub_major_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where("curr_prog.program_type_id", "=", $criteria['program_type_id']);
            }
            if (isset($criteria['flow_id'])) {
                $query->where("app.flow_id", "=", $criteria['flow_id']);
            }
            if (isset($criteria['from_date'])) {
                $query->whereDate('app.created', '>=', Carbon::createFromFormat('d-m-Y', $criteria['from_date'])->format('Y-m-d'));
            }
            if (isset($criteria['to_date'])) {
                $query->whereDate('app.created', '<=', Carbon::createFromFormat('d-m-Y', $criteria['to_date'])->format('Y-m-d'));
            }

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getReport04ApplicantDataByCriteria($criteria = null)
    {
        try {
            $query = DB::table('applicant as appt')
                ->select(
                    DB::raw("CONCAT(tle.name_title,appt.stu_first_name,' ',appt.stu_last_name) as fullname_th"),
                    DB::raw("CONCAT(tle.name_title_en,appt.stu_first_name_en,' ',appt.stu_last_name_en) as fullname_en"),
                    DB::raw("case appt.stu_sex when 1 then 'ชาย' when 2 then 'หญิง' else null end as stu_sex"),
                    'na.nation_name', 'li.religion_name', 'appt.stu_married',
                    DB::raw("date_format(appt.stu_birthdate,'%d-%m-%Y') as stu_birthdate"),
                    'appt.stu_birthplace', 'appt.stu_email', 'app_file.file_origi_name',
                    DB::raw("concat('เลขที่/หมู่ ',ifnull(appt.stu_addr_no,'-'),' หมู่บ้าน ',ifnull(appt.stu_addr_village,'-'),
                    ' ตรอก/ซอย ',ifnull(appt.stu_addr_soi,'-'),' ถนน ',ifnull(appt.stu_addr_road,'-'),' จังหวัด ',
                    ifnull(pro.province_name,'-'),' เขต/อำเภอ ',ifnull(dis.district_name,'-'),' แขวง/ตำบล ',
                    ifnull(appt.stu_addr_tumbon,'-'),' รหัสไปรษณีย์ ',ifnull(appt.stu_addr_pcode,'-'),' โทรศัพท์อื่น ',
                    ifnull(appt.stu_phone,'-')) as address"),
                    DB::raw("case when end_admin.eng_test_id <> 6 or end_admin.eng_test_id is not null then
                    concat(end_admin.eng_test_name,' คะแนนที่ได้ ', appt.eng_test_score_admin,' คะแนน เมื่อวันที่ ',
                    ifnull(date_format(appt.eng_date_taken_admin,'%d-%m-%Y'),'-'))
                    when eng.eng_test_id <> 6 or eng.eng_test_id is not null then
                    concat(eng.eng_test_name,' คะแนนที่ได้ ', appt.eng_test_score,' คะแนน เมื่อวันที่ ',
                    ifnull(date_format(appt.eng_date_taken,'%d-%m-%Y'),'-')) else null end as eng_score"),
                    'appt.thai_test_score',
                    'appt.cu_best_score',
                    DB::raw("case when edu.grad_level = 'BACHELOR' then GROUP_CONCAT(concat(edu_pass.edu_pass_name,' จาก ',
                    uni.university_name,' คณะ ',edu.edu_faculty,' ปีที่สำเร็จ ',ifnull(edu.edu_year,'-'),' แต้มเฉลี่ย ',
                    ifnull(edu.edu_gpax,'-'),' สาขาวิชาเอก ',ifnull(edu.edu_major,'-'),' ประกาศนียบัตร/ปริญญาบัตร ',
                    ifnull(edu.edu_degree,'-')) SEPARATOR '|') end as bachelor_info"),
                    DB::raw("case when edu.grad_level = 'MASTER' then GROUP_CONCAT(concat(edu_pass.edu_pass_name,' จาก ',
                    uni.university_name,' คณะ ',edu.edu_faculty,' ปีที่สำเร็จ ',ifnull(edu.edu_year,'-'),' แต้มเฉลี่ย ',
                    ifnull(edu.edu_gpax,'-'),' สาขาวิชาเอก ',ifnull(edu.edu_major,'-'),' ประกาศนียบัตร/ปริญญาบัตร ',
                    ifnull(edu.edu_degree,'-')) SEPARATOR '|') end as master_info"),
                    DB::raw("GROUP_CONCAT( concat('ประเภท ',wk_s.work_status_name,' สถานที่ทำงาน ',
                    ifnull(app_w.work_stu_detail,'-'),' ตำแหน่ง/หน้าที่ ',ifnull(app_w.work_stu_position,'-'),
                    ' ระยะเวลาในการทำงาน ',ifnull(app_w.work_stu_yr,'-'),' ปี ',ifnull(app_w.work_stu_mth,'-'),
                    ' เดือน เงินเดือนที่ได้รับ ',ifnull(app_w.work_stu_salary,'-'),' โทรศัพท์ ',ifnull(app_w.work_stu_phone,'-'))
                    ORDER BY app_w.app_work_status desc SEPARATOR '|') as work_info"),
                    DB::raw("case appt.fund_interesting when 1 then 'สนใจ' when 2 then 'ไม่สนใจ' end as fund_interesting"),
                    DB::raw("GROUP_CONCAT(news.news_source_name SEPARATOR '|') as news_src ")

                )->join('application as app', function ($join) {
                    $join->on('app.applicant_id', '=', 'appt.applicant_id');
                })->join('curriculum_activity as curr_act', function ($join) {
                    $join->on('curr_act.curr_act_id', '=', 'app.curr_act_id');
                })->join('apply_setting as app_set', function ($join) {
                    $join->on('app_set.apply_setting_id', '=', 'curr_act.apply_setting_id');
                })->leftJoin("curriculum as curr", function ($join) {
                    $join->on("curr.curriculum_id", "=", "app.curriculum_id");
                })->leftJoin("curriculum_program as curr_prog", function ($join) {
                    $join->on("curr_prog.curr_prog_id", "=", "app.curr_prog_id");
                })->leftJoin("tbl_major as mj", function ($join) {
                    $join->on("mj.major_id", "=", "curr.major_id");
                })->leftJoin("curriculum_sub_major as curr_subm", function ($join) {
                    $join->on("curr_subm.curriculum_id", "=", "curr.curriculum_id");
                })->leftJoin("tbl_name_title as tle", function ($join) {
                    $join->on("tle.name_title_id", "=", "appt.name_title_id");
                })->leftJoin("tbl_nation as na", function ($join) {
                    $join->on("na.nation_id", "=", "appt.nation_id");
                })->leftJoin("tbl_religion as li", function ($join) {
                    $join->on("li.religion_id", "=", "appt.stu_religion");
                })->leftJoin("file as app_file", function ($join) {
                    $join->on("app_file.file_id", "=", "appt.stu_img");
                })->leftJoin("tbl_province as pro", function ($join) {
                    $join->on("pro.province_id", "=", "appt.province_id");
                })->leftJoin("tbl_district as dis", function ($join) {
                    $join->on("dis.district_code", "=", "appt.district_code");
                })->leftJoin("tbl_eng_test as eng", function ($join) {
                    $join->on("eng.eng_test_id", "=", "appt.eng_test_id");
                })->leftJoin("tbl_eng_test as end_admin", function ($join) {
                    $join->on("end_admin.eng_test_id", "=", "appt.eng_test_id_admin");
                })->leftJoin("applicant_edu as edu", function ($join) {
                    $join->on("edu.applicant_id", "=", "appt.applicant_id");
                })->leftJoin("tbl_education_pass as edu_pass", function ($join) {
                    $join->on("edu_pass.edu_pass_id", "=", "edu.edu_pass_id");
                })->leftJoin("tbl_university as uni", function ($join) {
                    $join->on("uni.university_id", "=", "edu.university_id");
                })->leftJoin("applicant_work as app_w", function ($join) {
                    $join->on("app_w.applicant_id", "=", "app.applicant_id");
                })->leftJoin("tbl_work_status as wk_s", function ($join) {
                    $join->on("wk_s.work_status_id", "=", "app_w.work_status_id");
                })->leftJoin("applicant_news_source as app_new", function ($join) {
                    $join->on("app_new.applicant_id", "=", "appt.applicant_id");
                })->leftJoin("tbl_news_source as news", function ($join) {
                    $join->on("news.news_source_id", "=", "app_new.news_source_id");
                })->groupBy('fullname_th', 'fullname_en', 'stu_sex',
                    'na.nation_name', 'li.religion_name', 'appt.stu_married',
                    'stu_birthdate', 'appt.stu_birthplace', 'appt.stu_email',
                    'app_file.file_origi_name', 'address', 'eng_score',
                    'appt.thai_test_score', 'appt.cu_best_score',
                    'edu.grad_level', 'fund_interesting');

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
                $query->where("curr_subm.sub_major_id", "=", $criteria['sub_major_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where("curr_prog.program_type_id", "=", $criteria['program_type_id']);
            }
            if (isset($criteria['flow_id'])) {
                $query->where("app.flow_id", "=", $criteria['flow_id']);
            }
            if (isset($criteria['from_date'])) {
                $query->whereDate('app.created', '>=', Carbon::createFromFormat('d-m-Y', $criteria['from_date'])->format('Y-m-d'));
            }
            if (isset($criteria['to_date'])) {
                $query->whereDate('app.created', '<=', Carbon::createFromFormat('d-m-Y', $criteria['to_date'])->format('Y-m-d'));
            }

            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getFlowApplyForDropdown()
    {
        try {
            $query = DB::table('tbl_flow_apply as f')
                ->select('f.flow_id', 'f.flow_name');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

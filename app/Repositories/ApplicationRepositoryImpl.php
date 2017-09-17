<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationDocumentFileRepository;
use App\Repositories\Contracts\ApplicationPeopleRefRepository;
use App\Repositories\Contracts\ApplicationRepository;
use App\Models\CurriculumActivity;
use App\Models\Application;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApplicationRepositoryImpl extends AbstractRepositoryImpl implements ApplicationRepository {

    protected $ApplicationRepo;
    private $paging = 10;
    private $controllors;
    protected $appDocFileRepo;
    protected $appPeopleRefRepo;

    public function __construct(Controller $controllors, ApplicationDocumentFileRepository $appDocFileRepo, ApplicationPeopleRefRepository $appPeopleRefRepo) {
        parent::setModelClassName(Application::class);
        $this->controllors = $controllors;
        $this->appDocFileRepo = $appDocFileRepo;
        $this->appPeopleRefRepo = $appPeopleRefRepo;
    }

    public function getAppData($applicationID = null) {
        $result = null;
        try {
            $result = Application::where('application.application_id', $applicationID)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function getDataonly($applicantID = null, $applicationID = null) {
        $result = null;
        try {
            $result = Application:: Where(function ($query)use ($applicationID) {
                                if ($applicationID) {
                                    $query->where('application.application_id', $applicationID);
                                }
                            })
                            ->Where(function ($query)use ($applicantID) {
                                if ($applicantID) {
                                    $query->where('application.applicant_id', $applicantID);
                                }
                            })
                            ->orderBy('application.application_id', 'desc')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function getData($applicantID = null, $applicationID = null) {
        $result = null;
        try {
            /*
              $result = Application::select('*', 'application.created as appDates ,CAST(app_id AS CHAR) as appid')
              ->leftJoin('curriculum', 'application.curriculum_id', 'curriculum.curriculum_id')
              ->leftJoin('curriculum_program', 'application.curr_prog_id', '=', 'curriculum_program.curr_prog_id')
              ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
              ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
              ->leftJoin('tbl_sub_major', 'application.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
              ->leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
              ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
              ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
              ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
              ->leftJoin('tbl_bank', 'application.bank_id', '=', 'tbl_bank.bank_id')
              ->leftJoin("tbl_major", function($join) {
              $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
              ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
              })
              ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
              ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
              ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
              ->leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
              ->leftJoin('tbl_exam_status', 'tbl_exam_status.exam_id', 'application.exam_status')
              ->leftJoin('tbl_admission_status', 'tbl_admission_status.admission_status_id', 'application.admission_status_id')
              ->Where(function ($query)use ($applicationID) {
              if ($applicationID) {
              $query->where('application.application_id', $applicationID);
              }
              })
              ->Where(function ($query)use ($applicantID) {
              if ($applicantID) {
              $query->where('application.applicant_id', $applicantID);
              }
              })
              //                ->select(DB::raw('program_id,thai,english'))
              ->orderBy('application.application_id', 'desc')->get();
             */
            $result = Application::select('*', 'application.created as appDates ,CAST(app_id AS CHAR) as appid')
                            ->leftJoin('curriculum', 'application.curriculum_id', 'curriculum.curriculum_id')
                            ->leftJoin('curriculum_program', 'application.curr_prog_id', '=', 'curriculum_program.curr_prog_id')
                            ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
                            ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                            ->leftJoin('tbl_sub_major', 'application.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                            ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                            ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
                            ->leftJoin('tbl_program_plan', 'mcoursestudy.plan', '=', 'tbl_program_plan.prog_plan_name')
                            ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                            ->leftJoin('tbl_bank', 'application.bank_id', '=', 'tbl_bank.bank_id')
                            ->leftJoin("tbl_major", function($join) {
                                $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                                ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                            })
                            ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                            ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                            ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                            ->leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
                            ->leftJoin('tbl_exam_status', 'tbl_exam_status.exam_id', 'application.exam_status')
                            ->leftJoin('tbl_admission_status', 'tbl_admission_status.admission_status_id', 'application.admission_status_id')
                            ->Where(function ($query)use ($applicationID) {
                                if ($applicationID) {
                                    $query->where('application.application_id', $applicationID);
                                }
                            })
                            ->Where(function ($query)use ($applicantID) {
                                if ($applicantID) {
                                    $query->where('application.applicant_id', $applicantID);
                                }
                            })
//                ->select(DB::raw('program_id,thai,english'))
                            ->orderBy('application.application_id', 'desc')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function getDataForMange($applicantID = null, $applicationID = null, $status = null, $semester = null, $year = null, $roundNo = null, $criteria = null, $user = null, $curr_act_id = null, $applicationsArray = null, $exam_status = null, $sub_major_id = null, $program_id = null, $program_type_id = null, $role = null) {
        $results = null;
        try {
 
            $results = Application:: leftJoin('curriculum', 'application.curriculum_id', 'curriculum.curriculum_id')
                            ->leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                            ->leftJoin('curriculum_activity', 'application.curr_act_id', '=', 'curriculum_activity.curr_act_id')
                            ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                            ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                            ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                            ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                            ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
                            ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                            ->leftJoin('tbl_bank', 'application.bank_id', '=', 'tbl_bank.bank_id')
                            ->leftJoin("tbl_major", function($join) {
                                $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                                ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                            })
                            ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                            ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                            ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                            ->leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
                            ->leftJoin('applicant', 'applicant.applicant_id', 'application.applicant_id')
                            ->leftJoin('tbl_exam_status', 'tbl_exam_status.exam_id', 'application.exam_status')
                            ->leftJoin('tbl_eng_test as engTest', 'engTest.eng_test_id', '=', 'applicant.eng_test_id')
                            ->leftJoin('tbl_eng_test as engTestAdmin', 'engTestAdmin.eng_test_id', '=', 'applicant.eng_test_id_admin')
                            ->leftJoin('tbl_admission_status', 'tbl_admission_status.admission_status_id', 'application.admission_status_id')
                            ->leftJoin('tbl_name_title', 'applicant.name_title_id', '=', 'tbl_name_title.name_title_id')
                            ->Where(function ($query)use ($user,$role) {
                                if ($user) {
                                    $query->whereIn('curriculum.curriculum_id', function($query)use ($user) {
                                        $query->select('curriculum_id')
                                        ->from('curriculum_user')
                                        ->where('curriculum_user.user_id', $user);
                                    })                                    
                                    ->orwhere('curriculum.responsible_person', $user);
                                    if ($role == '2') {
                                        $query->orwhere('curriculum.apply_method', '1');
                                    }
                                }
                            }) 
                            ->Where(function ($query)use ($applicationID) {
                                if ($applicationID) {
                                    $query->where('application.application_id', $applicationID);
                                }
                            })
                            ->Where(function ($query)use ($applicationsArray) {
                                if ($applicationsArray) {
                                    $query->whereIn('application.application_id', $applicationsArray);
                                }
                            })
                            ->Where(function ($query)use ($applicantID) {
                                if ($applicantID) {
                                    $query->where('application.applicant_id', $applicantID);
                                }
                            })
                            ->Where(function ($query)use ($program_type_id) {
                                if ($program_type_id) {
                                    $query->where('tbl_program_type.program_type_id', $program_type_id);
                                }
                            })
                            ->Where(function ($query)use ($status) {
                                if ($status) {
                                    $query->whereIn('application.flow_id', $status);
                                }
                            })
                            ->Where(function ($query)use ($exam_status) {
                                if ($exam_status) {
                                    $query->where('tbl_exam_status.exam_id', $exam_status);
                                }
                            })
                            ->Where(function ($query)use ($semester) {
                                if ($semester) {
                                    $query->where('apply_setting.semester', $semester);
                                }
                            })
                            ->Where(function ($query)use ($year) {
                                if ($year) {
                                    $query->where('apply_setting.academic_year', $year);
                                }
                            })
                            ->Where(function ($query)use ($curr_act_id) {
                                if ($curr_act_id) {
                                    $query->where('curriculum_activity.curr_act_id', $curr_act_id);
                                }
                            })
                            ->Where(function ($query)use ($roundNo) {
                                if ($roundNo) {
                                    $query->where('apply_setting.round_no', $roundNo);
                                }
                            })
                            ->Where(function ($query)use ($program_id) {
                                if ($program_id) {
                                    $query->where('application.program_id', $program_id);
                                }
                            })
                            ->Where(function ($query)use ($sub_major_id) {
                                if ($sub_major_id) {
                                    if ($sub_major_id > 0) {
                                        $query->where('application.sub_major_id', $sub_major_id);
                                    } else {
                                        $query->whereNull('application.sub_major_id');
                                    }
                                }
                            })
                            ->Where(function ($query)use ($criteria) {
                                if ($criteria) {
                                    $query->where('degree_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('degree_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('department_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('department_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('faculty_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('faculty_full', 'like', '%' . $criteria . '%')
                                    ->orwhere('major_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('major_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('project_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('project_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('prog_type_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('prog_type_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('degree_level_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('app_id', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_first_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_last_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_first_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_last_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('application.program_id', 'like', '%' . $criteria . '%')
                                    ;
                                }
                            })
                            ->select([DB::raw('application.application_id application_id,application.applicant_id applicant_id,academic_year,round_no,name_title,name_title_en,app_id, lpad(app_id ,5,"0") app_ida,lpad(curriculum_num ,4,"0")  curriculum_numa ,curriculum_num,application.stu_citizen_card ,stu_first_name ,stu_last_name,stu_first_name_en ,stu_last_name_en,stu_email,application.program_id,application.payment_date,application.receipt_book,application.receipt_no ,prog_type_name ,bank_name,tbl_bank.bank_id,tbl_bank.bank_fee ,apply_fee,application.created,flow_name,flow_name_en,application.flow_id ,exam_remark,exam_name,application.exam_status,applicant.eng_test_score ,applicant.eng_date_taken,applicant.eng_test_score_admin,applicant.eng_test_id,applicant.eng_test_id_admin,applicant.eng_date_taken_admin ,engTest.eng_test_name  engT,engTestAdmin.eng_test_name engTAdmin,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), ifnull(applicant.eng_date_taken_admin,applicant.eng_date_taken))), "%Y")+0 examDiffYear,tbl_admission_status.admission_status_id,admission_status_name_th,admission_status_name_en,admission_remark,major_name,degree_name,faculty_name,semester,application.creator user_create,nation_id,apply_method')])
                            ->distinct()
                            ->orderBy('application.application_id', 'desc')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $results;
    }

    public function getDataForMangeReport($applicantID = null, $applicationID = null, $status = null, $semester = null, $year = null, $roundNo = null, $criteria = null, $user = null, $curr_act_id = null, $applicationsArray = null, $exam_status = null, $sub_major_id = null, $program_id = null, $program_type_id = null, $user_role = null) {
        $results = null;
        try {

            $results = Application:: leftJoin('curriculum', 'application.curriculum_id', 'curriculum.curriculum_id')
                            ->leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                            ->leftJoin('curriculum_activity', 'application.curr_act_id', '=', 'curriculum_activity.curr_act_id')
                            ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                            ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                            ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                            ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                            ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
                            ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                            ->leftJoin('tbl_bank', 'application.bank_id', '=', 'tbl_bank.bank_id')
                            ->leftJoin("tbl_major", function($join) {
                                $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                                ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                            })
                            ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                            ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                            ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                            ->leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
                            ->leftJoin('applicant', 'applicant.applicant_id', 'application.applicant_id')
                            ->leftJoin('tbl_exam_status', 'tbl_exam_status.exam_id', 'application.exam_status')
                            ->leftJoin('tbl_eng_test as engTest', 'engTest.eng_test_id', '=', 'applicant.eng_test_id')
                            ->leftJoin('tbl_eng_test as engTestAdmin', 'engTestAdmin.eng_test_id', '=', 'applicant.eng_test_id_admin')
                            ->leftJoin('tbl_admission_status', 'tbl_admission_status.admission_status_id', 'application.admission_status_id')
                            ->leftJoin('tbl_name_title', 'applicant.name_title_id', '=', 'tbl_name_title.name_title_id')
                            ->Where(function ($query)use ($user,$role) {
                                if ($user) {
                                    $query->whereIn('curriculum.curriculum_id', function($query)use ($user) {
                                        $query->select('curriculum_id')
                                        ->from('curriculum_user')
                                        ->where('curriculum_user.user_id', $user);
                                    })
                                    ->orwhere('curriculum.responsible_person', $user);
                                    if ($role == '2') {
                                        $query->orwhere('curriculum.apply_method', '1');
                                    }
                                }
                            })
                            
                            ->Where(function ($query)use ($applicationID) {
                                if ($applicationID) {
                                    $query->where('application.application_id', $applicationID);
                                }
                            })
                            ->Where(function ($query)use ($applicationsArray) {
                                if ($applicationsArray) {
                                    $query->whereIn('application.application_id', $applicationsArray);
                                }
                            })
                            ->Where(function ($query)use ($applicantID) {
                                if ($applicantID) {
                                    $query->where('application.applicant_id', $applicantID);
                                }
                            })
                            ->Where(function ($query)use ($program_type_id) {
                                if ($program_type_id) {
                                    $query->where('tbl_program_type.program_type_id', $program_type_id);
                                }
                            })
                            ->Where(function ($query)use ($status) {
                                if ($status) {
                                    $query->whereIn('application.flow_id', $status);
                                }
                            })
                            ->Where(function ($query)use ($exam_status) {
                                if ($exam_status) {
                                    $query->where('tbl_exam_status.exam_id', $exam_status);
                                }
                            })
                            ->Where(function ($query)use ($semester) {
                                if ($semester) {
                                    $query->where('apply_setting.semester', $semester);
                                }
                            })
                            ->Where(function ($query)use ($year) {
                                if ($year) {
                                    $query->where('apply_setting.academic_year', $year);
                                }
                            })
                            ->Where(function ($query)use ($curr_act_id) {
                                if ($curr_act_id) {
                                    $query->where('curriculum_activity.curr_act_id', $curr_act_id);
                                }
                            })
                            ->Where(function ($query)use ($roundNo) {
                                if ($roundNo) {
                                    $query->where('apply_setting.round_no', $roundNo);
                                }
                            })
                            ->Where(function ($query)use ($program_id) {
                                if ($program_id) {
                                    $query->where('application.program_id', $program_id);
                                }
                            })
                            ->Where(function ($query)use ($sub_major_id) {
                                if ($sub_major_id) {
                                    if ($sub_major_id > 0) {
                                        $query->where('application.sub_major_id', $sub_major_id);
                                    } else {
                                        $query->whereNull('application.sub_major_id');
                                    }
                                }
                            })
                            ->Where(function ($query)use ($criteria) {
                                if ($criteria) {
                                    $query->where('degree_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('degree_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('department_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('department_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('faculty_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('faculty_full', 'like', '%' . $criteria . '%')
                                    ->orwhere('major_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('major_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('project_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('project_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('prog_type_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('prog_type_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('degree_level_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('app_id', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_first_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_last_name', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_first_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('stu_last_name_en', 'like', '%' . $criteria . '%')
                                    ->orwhere('application.program_id', 'like', '%' . $criteria . '%')
                                    ;
                                }
                            })
                            ->select([DB::raw('application.application_id application_id,application.applicant_id applicant_id,academic_year,round_no,name_title,name_title_en,app_id, lpad(app_id ,5,"0") app_ida,lpad(curriculum_num ,4,"0")  curriculum_numa ,curriculum_num,application.stu_citizen_card ,stu_first_name ,stu_last_name,stu_first_name_en ,stu_last_name_en,stu_email,application.program_id,application.payment_date,application.receipt_book,application.receipt_no ,prog_type_name ,bank_name,tbl_bank.bank_id,tbl_bank.bank_fee ,apply_fee,application.created,flow_name,flow_name_en,application.flow_id ,exam_remark,exam_name,application.exam_status,applicant.eng_test_score ,applicant.eng_date_taken,applicant.eng_test_score_admin,applicant.eng_test_id,applicant.eng_test_id_admin,applicant.eng_date_taken_admin ,engTest.eng_test_name  engT,engTestAdmin.eng_test_name engTAdmin,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), ifnull(applicant.eng_date_taken_admin,applicant.eng_date_taken))), "%Y")+0 examDiffYear,tbl_admission_status.admission_status_id,admission_status_name_th,admission_status_name_en,admission_remark,major_name,degree_name,faculty_name,semester,application.creator user_create,nation_id,apply_method')])
                            ->distinct()
                            ->orderBy('application.application_id', 'desc')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $results;
    }

    public function getDatacountByStatusUse($applicantID) {
        $result = null;
        try {
            $result = Application::leftJoin('tbl_flow_apply', 'application.flow_id', '=', 'tbl_flow_apply.flow_id')
                            ->groupBy('application.flow_id')
                            ->groupBy('tbl_flow_apply.flow_name_en')
                            ->groupBy('tbl_flow_apply.flow_name')
                            ->select('application.flow_id', 'tbl_flow_apply.flow_name_en', 'tbl_flow_apply.flow_name', DB::raw('count(*) as numc'))
                            ->Where('application.applicant_id', $applicantID)
                            ->Where('application.flow_id', '<>', 0)
                            ->orderBy('application.application_id')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function getDatacountByStatus($applicantID) {

        $result = null;
        try {
            $result = \App\Models\TblFlowApply::select('flow_id', 'flow_name_en', 'flow_name', DB::raw('(select count(flow_id) as numc from application where application.flow_id= tbl_flow_apply.flow_id and application.applicant_id = ' . $applicantID . ') as cnum'))
                            ->orderBy('tbl_flow_apply.flow_id')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }

        return $result;
    }

    public function saveApplication($data) {
        $result = false;
        $app_id = null;
        $year = null;
        $curriculum_num = null;
        $id = null;
        if (array_key_exists('application_id', $data) || !empty($data['application_id']))
            $id = $data['application_id'];
        try {

            if (array_key_exists('flow_id', $data) || !empty($data['flow_id'])) {
                if ($data['flow_id'] == 0) {

                    $chks = $this->find($data['application_id']);
                    $rs = $chks->delete();
                    return $rs;
                }
            }

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new Application;

            if ($chk) {
                if ($chk->curriculum_num == null) {

                    $year = CurriculumActivity::leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
                                    ->leftJoin('application', 'curriculum_activity.curr_act_id', 'application.curr_act_id')
                                    ->where('application_id', $data['application_id'])->get();

                    $maxapp_id = Application::leftJoin('curriculum_activity', 'application.curr_act_id', 'curriculum_activity.curr_act_id')
                            ->leftJoin('apply_setting', 'curriculum_activity.apply_setting_id', 'apply_setting.apply_setting_id')
                            ->whereNotNull('app_id')
                            ->where('semester', $year[0]->semester)
                            ->where('academic_year', $year[0]->academic_year)
                            ->max('app_id');



                    $app_id = $maxapp_id + 1;

                    $maxcurprogram = Application::where('curriculum_id', $year[0]->curriculum_id)
                            ->where('program_id', $year[0]->program_id)
                            ->whereNotNull('curriculum_num')
                            ->max('curriculum_num');

                    $curriculum_num = $maxcurprogram + 1;
                }
            }


            if (array_key_exists('applicant_id', $data))
                $curObj->applicant_id = $data['applicant_id'];
            if (array_key_exists('curr_act_id', $data))
                $curObj->curr_act_id = $data['curr_act_id'];
            if (array_key_exists('stu_citizen_card', $data))
                $curObj->stu_citizen_card = $data['stu_citizen_card'];
            if (array_key_exists('curriculum_id', $data))
                $curObj->curriculum_id = $data['curriculum_id'];

            if (array_key_exists('program_id', $data))
                $curObj->program_id = $data['program_id'];
            if (array_key_exists('sub_major_id', $data))
                $curObj->sub_major_id = $data['sub_major_id'];
            if (array_key_exists('flow_id', $data))
                $curObj->flow_id = $data['flow_id'];

            if (array_key_exists('bank_id', $data))
                $curObj->bank_id = $data['bank_id'];

            if (array_key_exists('curr_prog_id', $data))
                $curObj->curr_prog_id = $data['curr_prog_id'];

            if (array_key_exists('exam_remark', $data))
                $curObj->exam_remark = $data['exam_remark'];
            if (array_key_exists('exam_status', $data))
                $curObj->exam_status = $data['exam_status'];

            if (array_key_exists('admission_remark', $data))
                $curObj->admission_remark = $data['admission_remark'];
            if (array_key_exists('admission_status_id', $data))
                $curObj->admission_status_id = $data['admission_status_id'];

            if (array_key_exists('additional_answer', $data))
                $curObj->additional_answer = $data['additional_answer'];
            if (array_key_exists('payment_date', $data))
                $curObj->payment_date = $data['payment_date'];
            if (array_key_exists('receipt_book', $data))
                $curObj->receipt_book = $data['receipt_book'];

            if (array_key_exists('receipt_no', $data))
                $curObj->receipt_no = $data['receipt_no'];

            if (array_key_exists('special_apply_by', $data))
                $curObj->special_apply_by = $data['special_apply_by'];
            if (array_key_exists('special_apply_datetime', $data))
                $curObj->special_apply_datetime = $data['special_apply_datetime'];
            if (array_key_exists('special_apply_comment', $data))
                $curObj->special_apply_comment = $data['special_apply_comment'];

            if (array_key_exists('special_admission_by', $data))
                $curObj->special_admission_by = $data['special_admission_by'];
            if (array_key_exists('special_admission_by', $data))
                $curObj->special_admission_by = $data['special_admission_by'];
            if (array_key_exists('spacial_admission_comment', $data))
                $curObj->spacial_admission_comment = $data['spacial_admission_comment'];


            if ($app_id)
                $curObj->app_id = $app_id;
            if ($curriculum_num)
                $curObj->curriculum_num = $curriculum_num;


            if (array_key_exists('creator', $data))
                $curObj->creator = $data['creator'];
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];

            $curObj->save();
            $result = $curObj;
            $this->controllors->WLog('Save Application[application id:' . $id . ']', 'Enroll', null);
        } catch (\Exception $ex) {
            $this->controllors->WLog('Save Application Error[application id:' . $id . ']', 'Enroll', $ex->getMessage());
            $result = false;
            throw $ex;
        }


        return $result;
    }

    public function getApplicationAndProgramInfoByApplicationId($applicationId) {
        try {
            $query = DB::table('application as app')
                    ->select('app.application_id', 'app.flow_id', 'flow_app.flow_name', 'flow_app.flow_name_en', 'curr_prog.curr_prog_id', 'curr_prog.program_id', 'curr_prog.program_type_id', 'mc.thai as prog_name', 'mc.english as prog_name_en', 'mc.plan', 'progt.prog_type_name', 'progt.office_time', 'adst.admission_status_name_th', 'app.exam_status'
                    )
                    ->leftJoin('tbl_flow_apply as flow_app', function ($join) {
                        $join->on('flow_app.flow_id', '=', 'app.flow_id');
                    })
                    ->join('curriculum_program as curr_prog', function ($join) {
                        $join->on('curr_prog.curr_prog_id', '=', 'app.curr_prog_id');
                    })
                    ->leftJoin('mcoursestudy as mc', function ($join) {
                        $join->on('mc.coursecodeno', '=', 'curr_prog.program_id');
                    })
                    ->leftJoin('tbl_program_type as progt', function ($join) {
                        $join->on('progt.program_type_id', '=', 'curr_prog.program_type_id');
                    })
                    ->leftJoin('tbl_admission_status as adst', function ($join) {
                        $join->on('app.admission_status_id', '=', 'adst.admission_status_id');
                    })
                    ->where('app.application_id', '=', $applicationId);

            return $query->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doDeleteApplicationByApplicationId($applicationId) {
        DB::beginTransaction();
        try {
            $application = $this->findOrFail($applicationId);

            $this->appDocFileRepo->deleteByApplicationId($applicationId);
            $this->appPeopleRefRepo->deleteByApplicationId($applicationId);
            $result = $application->delete();
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

}

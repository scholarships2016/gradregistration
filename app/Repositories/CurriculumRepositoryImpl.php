<?php

namespace App\Repositories;

use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\CurriculumActivityRepository;
use App\Repositories\Contracts\CurriculumProgramRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Models\Curriculum;
use App\Repositories\Contracts\CurriculumSubMajorRepository;
use App\Repositories\Contracts\CurriculumWorkflowTransactionRepository;
use App\Repositories\Contracts\FileRepository;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CurriculumRepositoryImpl extends AbstractRepositoryImpl implements CurriculumRepository {

    protected $projectPassRepo;
    protected $currActRepo;
    protected $currProgRepo;
    protected $fileRepo;
    protected $currSubMajorRepo;
    protected $currWFTransRepo;
    protected $auditRepo;
    private $pagings = 10;

    public function __construct(CurriculumActivityRepository $currActRepo, CurriculumProgramRepository $currProgRepo, FileRepository $fileRepo, CurriculumSubMajorRepository $currSubMajorRepo, CurriculumWorkflowTransactionRepository $currWFTransRepo, AudittrailRepository $auditRepo) {
        parent::setModelClassName(Curriculum::class);
        $this->currActRepo = $currActRepo;
        $this->currProgRepo = $currProgRepo;
        $this->fileRepo = $fileRepo;
        $this->currSubMajorRepo = $currSubMajorRepo;
        $this->currWFTransRepo = $currWFTransRepo;
        $this->auditRepo = $auditRepo;
    }

    public function searchByCriteria($curriculum_id = null, $curr_act_id = null, $criteria = null, $faculty_id = null, $degree_id = null, $status = null, $is_approve = null, $program_id = null, $inTime = true, $paging = false, $academic_year = null, $semester = null, $round_no = null) {
        $result = null;
        try {
            DB::statement(DB::raw('set @rownum=0'));
            $cur = Curriculum::leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                    ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
                    ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                    ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                    ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                    ->leftJoin('tbl_program_plan', 'curriculum_program.program_plan_id', '=', 'tbl_program_plan.program_plan_id')
                    ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                    ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
                    ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                    ->leftJoin("tbl_major", function ($join) {
                        $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                        ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                    })
                    ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                    ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                    ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                    ->where('curriculum.status', 'like', '%' . $status . '%')
                    ->where('curriculum.is_approve', 'like', '%' . $is_approve . '%')
                    ->where('apply_setting.is_active', 'like', '%' . $status . '%')
                    ->where('apply_setting.status', 'like', '%' . $status . '%')
                    ->Where(function ($query) use ($curriculum_id) {
                        if ($curriculum_id) {
                            $query->where('curriculum.curriculum_id', $curriculum_id);
                        }
                    })
                    ->Where(function ($query) use ($curr_act_id) {
                        if ($curr_act_id != null || $curr_act_id != '') {
                            $query->where('curriculum_activity.curr_act_id', $curr_act_id);
                        }
                    })
                    ->Where(function ($query) use ($degree_id) {
                        if ($degree_id != null || $degree_id != '') {
                            $query->where('tbl_Degree.degree_id', $degree_id);
                        }
                    })
                    ->Where(function ($query) use ($faculty_id) {
                        if ($faculty_id != null || $faculty_id != '') {
                            $query->where('tbl_faculty.faculty_id', $faculty_id);
                        }
                    })
                    ->Where(function ($query) use ($program_id) {
                        if ($program_id != null || $program_id != '') {
                            $query->where('curriculum_program.program_id', $program_id);
                        }
                    })
                    ->Where(function ($query) use ($inTime) {
                        if ($inTime) {
                            $query->where('apply_setting.start_date', '<=', Carbon::now())
                            ->where('apply_setting.end_date', '>=', Carbon::now());
                        }
                    })
                    ->Where(function ($query) use ($semester) {
                        if ($semester != null || $semester != '') {
                            $query->where('apply_setting.semester', $semester);
                        }
                    })
                    ->Where(function ($query) use ($academic_year) {
                        if ($academic_year != null || $academic_year != '') {
                            $query->where('apply_setting.academic_year', $academic_year);
                        }
                    })
                    ->Where(function ($query) use ($round_no) {
                        if ($round_no != null || $round_no != '') {
                            $query->where('apply_setting.round_no', $round_no);
                        }
                    })
                    ->Where(function ($query) use ($criteria) {
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
                        ->orwhere('office_time', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                        ->orwhere('academic_year', 'like', '%' . $criteria . '%');
                    })
                    ->select([DB::raw('curriculum.curriculum_id,curriculum_activity.curr_act_id ,apply_method ,responsible_person  ,additional_detail  ,apply_fee ,additional_question  ,mailing_address ,document_file  ,comm_appr_name  ,comm_appr_no ,comm_appr_date  ,contact_tel ,is_approve ,expected_amount ,curriculum.status  ,curr_prog_id ,program_id ,tbl_program_type.program_type_id ,tbl_program_plan.program_plan_id ,curr_act_id ,apply_setting.apply_setting_id ,exam_schedule ,announce_exam_date ,announce_admission_date ,orientation_date ,orientation_location ,tbl_project.project_id ,project_name ,project_name_en ,curr_sub_major_id ,tbl_sub_major.sub_major_id ,sub_major_name ,sub_major_name_en  ,prog_plan_name ,prog_plan_name_en ,prog_plan_desc1 ,prog_plan_desc2   ,prog_type_name ,prog_type_name_en ,cond_id ,degree_level_name ,office_time,office_time_en ,programsystem ,studyprogramsystem ,calendar ,coursecodeno ,degree ,depcode ,majorcode ,noyear ,minperiod ,maxperiod ,credittot ,plan ,language ,beginacadyear ,beginsemester ,lastacadyear ,lastsemester ,stopacadyear ,stopsemester ,thai ,english ,degreethai ,degreeenglish ,apply_setting.status apply_status,usercode ,updatedate ,changestame , semester ,academic_year ,round_no ,start_date ,end_date ,is_active  ,tbl_major.major_id ,major_name ,major_name_en ,tbl_department.department_id ,tbl_degree.degree_id ,degree_name ,degree_name_en ,tbl_faculty.faculty_id ,faculty_name, faculty_eng ,fac_sort ,faculty_full ,thai,coursecodeno,sub_major_name,tbl_sub_major.sub_major_id, department_name ,department_name_en ,  @rownum  := @rownum  + 1 AS rownum')])
                    ->orderBy('curriculum.curriculum_id');

            $result = ($paging) ? $cur->offset($paging['start'])->limit($paging['length']) : $cur->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteriaGroup($curriculum_id = null, $curr_act_id = null, $criteria = null, $faculty_id = null, $degree_id = null, $status = null, $is_approve = null, $program_id = null, $inTime = true, $paging = false, $academic_year = null, $semester = null, $round_no = null, $program_type = null, $ajaxpage = null) {

        $result = null;
        try {

            $cur = DB::table('curriculum')
                    ->distinct()
                    ->select(DB::raw('curriculum.curriculum_id,curriculum_activity.curr_act_id ,apply_method ,responsible_person  ,additional_detail  ,apply_fee ,additional_question  ,mailing_address ,document_file  ,comm_appr_name  ,comm_appr_no ,comm_appr_date  ,contact_tel ,is_approve ,expected_amount ,curriculum.status  ,  tbl_program_type.program_type_id  ,curr_act_id ,apply_setting.apply_setting_id ,exam_schedule ,announce_exam_date ,announce_admission_date ,orientation_date ,orientation_location ,tbl_project.project_id ,project_name ,project_name_en ,prog_type_name ,prog_type_name_en ,cond_id ,degree_level_name ,office_time ,office_time_en,  degreethai ,degreeenglish ,  semester ,academic_year ,round_no ,start_date ,end_date ,is_active  ,tbl_major.major_id ,major_name ,major_name_en ,tbl_department.department_id ,tbl_degree.degree_id ,degree_name ,degree_name_en ,tbl_faculty.faculty_id ,faculty_name, faculty_eng ,fac_sort ,faculty_full ,   department_name ,department_name_en  '))
                    ->leftJoin('curriculum_program', 'curriculum.curriculum_id', '=', 'curriculum_program.curriculum_id')
                    ->leftJoin('curriculum_activity', 'curriculum.curriculum_id', '=', 'curriculum_activity.curriculum_id')
                    ->leftJoin('tbl_project', 'curriculum.project_id', '=', 'tbl_project.project_id')
                    ->leftJoin('curriculum_sub_major', 'curriculum.curriculum_id', '=', 'curriculum_sub_major.curriculum_id')
                    ->leftJoin('tbl_sub_major', 'curriculum_sub_major.sub_major_id', '=', 'tbl_sub_major.sub_major_id')
                    ->leftJoin('tbl_program_type', 'curriculum_program.program_type_id', '=', 'tbl_program_type.program_type_id')
                    ->leftJoin('mcoursestudy', 'curriculum_program.program_id', '=', 'mcoursestudy.coursecodeno')
                    ->leftJoin('apply_setting', 'apply_setting.apply_setting_id', '=', 'curriculum_activity.apply_setting_id')
                    ->leftJoin("tbl_major", function ($join) {
                        $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                        ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                    })
                    ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                    ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                    ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                    ->where('curriculum.status', 'like', '%' . $status . '%')
                    ->where('curriculum.is_approve', 'like', '%' . $is_approve . '%')
                    ->where('apply_setting.is_active', 'like', '%' . $status . '%')
                    ->where('apply_setting.status', 'like', '%' . $status . '%')
                    ->Where(function ($query) use ($inTime) {
                        if ($inTime) {
                            $query->where('apply_setting.start_date', '<=', Carbon::now())
                            ->where('apply_setting.end_date', '>=', Carbon::now());
                        }
                    })
                    ->Where(function ($query) use ($criteria) {
                if ($criteria != null) {
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
                    ->orwhere('office_time', 'like', '%' . $criteria . '%')
                    ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                    ->orwhere('academic_year', 'like', '%' . $criteria . '%')
                    ->orwhere('academic_year', 'like', '%' . $criteria . '%');
                }
            });
            if ($curriculum_id != null) {
                $cur->where('curriculum.curriculum_id', $curriculum_id);
            }
            if ($curr_act_id != null || $curr_act_id != '') {

                $cur->where('curriculum_activity.curr_act_id', $curr_act_id);
            }
            if ($degree_id != null || $degree_id != '') {

                $cur->where('tbl_Degree.degree_id', $degree_id);
            }
            if ($faculty_id != null || $faculty_id != '') {

                $cur->where('tbl_faculty.faculty_id', $faculty_id);
            }
            if ($program_id != null || $program_id != '') {
                $cur->where('curriculum_program.program_id', $program_id);
            }

            if ($semester != null || $semester != '') {
                $cur->where('apply_setting.semester', $semester);
            }
            if ($academic_year != null || $academic_year != '') {

                $cur->where('apply_setting.academic_year', $academic_year);
            }
            if ($round_no != null || $round_no != '') {

                $cur->where('apply_setting.round_no', $round_no);
            }
            if ($program_type != null) {

                $cur->where('curriculum_program.program_type_id', $program_type);
            }
            $cur->orderBy('curriculum.curriculum_id');



            if ($paging) {
 
                $draw = empty($ajaxpage['draw']) ? 1 : $ajaxpage['draw'];
                $recordsTotal = $cur->get()->count();
                $cur->offset($ajaxpage['start'])
                        ->limit($ajaxpage['length']);

                $data = $cur->get();
                $result = array('draw' => $draw,
                    'recordsTotal' => $recordsTotal,
                    'recordsFiltered' => $recordsTotal,
                    'data' => $data
                );
            } else {
                $result = $cur->get();
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data) {
        Log::info('save Curriculum');

        try {
            $isNew = true;

            $currObj = (array_key_exists('curriculum_id', $data) && !empty($data['curriculum_id'])) ? $this->find($data['curriculum_id']) : new Curriculum();
            if (empty($currObj)) {
                $currObj = new Curriculum();
            } elsE {
                $isNew = false;
            }
            if (array_key_exists('faculty_id', $data)) {
                $currObj->faculty_id = $data['faculty_id'];
            }
            if (array_key_exists('department_id', $data)) {
                $currObj->department_id = $data['department_id'];
            }
            if (array_key_exists('degree_id', $data)) {
                $currObj->degree_id = $data['degree_id'];
            }
            if (array_key_exists('project_id', $data)) {
                $currObj->project_id = $data['project_id'];
            }
            if (array_key_exists('apply_method', $data)) {
                $currObj->apply_method = $data['apply_method'];
            }
            if (array_key_exists('responsible_person', $data)) {
                $currObj->responsible_person = $data['responsible_person'];
            }
            if (array_key_exists('additional_detail', $data)) {
                $currObj->additional_detail = $data['additional_detail'];
            }
            if (array_key_exists('apply_fee', $data)) {
                $currObj->apply_fee = $data['apply_fee'];
            }
            if (array_key_exists('additional_question', $data)) {
                $currObj->additional_question = $data['additional_question'];
            }
            if (array_key_exists('mailing_address', $data)) {
                $currObj->mailing_address = $data['mailing_address'];
            }
            if (array_key_exists('document_file', $data)) {
                $currObj->document_file = $data['document_file'];
            }
            if (array_key_exists('comm_appr_name', $data)) {
                $currObj->comm_appr_name = $data['comm_appr_name'];
            }
            if (array_key_exists('comm_appr_no', $data)) {
                $currObj->comm_appr_no = $data['comm_appr_no'];
            }
            if (array_key_exists('comm_appr_date', $data)) {
                $currObj->comm_appr_date = $data['comm_appr_date'];
            }
            if (array_key_exists('contact_tel', $data)) {
                $currObj->contact_tel = $data['contact_tel'];
            }
            if (array_key_exists('is_approve', $data)) {
                $currObj->is_approve = $data['is_approve'];
            }
            if (array_key_exists('status', $data)) {
                $currObj->status = $data['status'];
            }
            if (array_key_exists('major_id', $data)) {
                $currObj->major_id = $data['major_id'];
            }
            if (array_key_exists('expected_amount', $data)) {
                $currObj->expected_amount = $data['expected_amount'];
            }

//Creator and Editor
            if (array_key_exists('creator', $data)) {
                $currObj->creator = $data['creator'];
            }
            if (array_key_exists('modifier', $data)) {
                $currObj->modifier = $data['modifier'];
            }

            $currObj->save();
            return $currObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function duplicateCurriculumSetting($id) {
// TODO: Implement duplicateCurriculumSetting() method.
    }

    public function saveCurriculumSetting(array $datas) {
        DB::beginTransaction();
        try {

            $creator = $datas['creator'];
            $modifier = $datas['modifier'];


            if (isset($datas['comm_appr_date'])) {
                $datas['comm_appr_date'] = Carbon::createFromFormat('d/m/Y', $datas['comm_appr_date'])->format('Y-m-d');
            }

            if (isset($datas['document_file'])) {
                $curYear = Carbon::now()->year;
                $file = $this->fileRepo->upload($datas['document_file'], env(Util::CURRICULUM_DOC_FOLDER) . $curYear);
                $datas['document_file'] = $file->file_id;
            }

//Draft Step
            if (!isset($datas['curriculum_id'])) {
                $datas['is_approve'] = 1;
            }

            $currObj = $this->save($datas);

            if (!isset($datas['curriculum_id'])) {
                $wftStatus['workflow_status_id'] = 1;
                $wftStatus['curriculum_id'] = $currObj->curriculum_id;
                $wftStatus['creator'] = $creator;
                $this->currWFTransRepo->save($wftStatus);
            }

            if (array_key_exists('sub_major_id', $datas) && !empty($datas['sub_major_id'])) {
                $deletedSubMajorRows = $this->currSubMajorRepo->removeCurrSubmajorByCurriculumId($currObj->curriculum_id);
                foreach ($datas['sub_major_id'] as $value) {
                    $subMajor = array();
                    $subMajor['sub_major_id'] = $value;
                    $subMajor['curriculum_id'] = $currObj->curriculum_id;
                    $subMajor['creator'] = $creator;
                    $subMajor['modifier'] = $modifier;
                    $this->currSubMajorRepo->save($subMajor);
                }
            } else {
                $deletedSubMajorRows = $this->currSubMajorRepo->removeCurrSubmajorByCurriculumId($currObj->curriculum_id);
            }

            $currActIds = array();
            foreach ($datas['rounds'] as $index => $value) {
                if (!empty($value['curr_act_id'])) {
                    array_push($currActIds, $value['curr_act_id']);
                }
            }

            if (!empty($currActIds) && sizeof($currActIds) > 0) {
                $deletedActRows = $this->currActRepo->removeCurrActNotInListByCurriculumId($currActIds, $currObj->curriculum_id);
            }

            foreach ($datas['rounds'] as $index => $value) {
                if (!empty($value['curr_act_id'])) {
                    array_push($currActIds, $value['curr_act_id']);
                    $datas['rounds'][$index]['modifier'] = $modifier;
                } else {
                    $datas['rounds'][$index]['creator'] = $creator;
                    $datas['rounds'][$index]['modifier'] = $modifier;
                }
                $datas['rounds'][$index]['curriculum_id'] = $currObj->curriculum_id;
                if (isset($value['announce_exam_date']) && !empty($value['announce_exam_date'])) {
                    $datas['rounds'][$index]['announce_exam_date'] = Carbon::createFromFormat('d/m/Y', $value['announce_exam_date'])->format('Y-m-d');
                } else {
                    $datas['rounds'][$index]['announce_exam_date'] = null;
                }
                if (isset($value['announce_admission_date']) && !empty($value['announce_admission_date'])) {
                    $datas['rounds'][$index]['announce_admission_date'] = Carbon::createFromFormat('d/m/Y', $value['announce_admission_date'])->format('Y-m-d');
                } else {
                    $datas['rounds'][$index]['announce_admission_date'] = null;
                }
                if (isset($value['orientation_date']) && !empty($value['orientation_date'])) {
                    $datas['rounds'][$index]['orientation_date'] = Carbon::createFromFormat('d/m/Y', $value['orientation_date'])->format('Y-m-d');
                } else {
                    $datas['rounds'][$index]['orientation_date'] = null;
                }
                if (!isset($value['orientation_location']) || empty($value['orientation_location'])) {
                    $datas['rounds'][$index]['orientation_location'] = null;
                }
                $this->currActRepo->save($datas['rounds'][$index]);
            }


            $currProgIds = array();
            foreach ($datas['programs'] as $index => $value) {
                if (!empty($value['curr_prog_id'])) {
                    array_push($currProgIds, $value['curr_prog_id']);
                }
            }
            if (!empty($currProgIds) && sizeof($currProgIds)) {
                $deletedActRows = $this->currProgRepo->removeCurrProgNotInListByCurriculumId($currProgIds, $currObj->curriculum_id);
            }

            foreach ($datas['programs'] as $index => $value) {
                if (!empty($value['curr_prog_id'])) {
                    array_push($currProgIds, $value['curr_prog_id']);
                    $datas['programs'][$index]['modifier'] = $modifier;
                } else {
                    $datas['programs'][$index]['creator'] = $creator;
                    $datas['programs'][$index]['modifier'] = $modifier;
                }
                $datas['programs'][$index]['curriculum_id'] = $currObj->curriculum_id;
                $this->currProgRepo->save($datas['programs'][$index]);
            }

            DB::commit();
            return $currObj;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getCurriculumInfoById($id) {
        try {
            $query = DB::table('curriculum as curr')
                    ->select(DB::raw('curr.*,f.*'))
                    ->leftJoin('file as f', function ($join) {
                        $join->on('f.file_id', '=', 'curr.document_file');
                    })
                    ->where('curr.curriculum_id', '=', $id);
            $curriObj = $query->first();
            if (empty($curriObj)) {
                throw new \Exception('Data Not found');
            }
            $currActs = $this->currActRepo->getCurrActListByCurriculumId($id);
            $currProg = $this->currProgRepo->getCurrProgListByCurriculumId($id);
            $currSubMajor = $this->currSubMajorRepo->getCurrSubMajorByCurriculumId($id);
            return array("curriculum" => $curriObj, "curriculum_activity" => $currActs,
                "curriculum_program" => $currProg, "curriculum_sub_major" => $currSubMajor);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function changeTransactionStatus(array $datas) {
        DB::beginTransaction();
        try {
            if (!isset($datas['curriculum_id'])) {
                throw new \Exception('No ID');
            }
            $currWFT = $this->currWFTransRepo->save($datas);
            $curr = $this->find($datas['curriculum_id']);
            $curr->is_approve = $currWFT->workflow_status_id;
            $curr->save();
            DB::commit();
            return $currWFT;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function deleteCurriculumInfoByCurriculumId($id) {
        DB::beginTransaction();
        try {
            $currAct = DB::table('curriculum_activity')->where('curriculum_id', '=', $id)->delete();
            $currProg = DB::table('curriculum_program')->where('curriculum_id', '=', $id)->delete();
            $currSubMajor = DB::table('curriculum_sub_major')->where('curriculum_id', '=', $id)->delete();
            $currWFT = DB::table('curriculum_workflow_transaction')->where('curriculum_id', '=', $id)->delete();
            $curr = DB::table('curriculum')->where('curriculum_id', '=', $id)->delete();
            DB::commit();
            return true;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function doPaging1($criteria = null) {
        try {
            $columnMap = array(
                1 => "curr.curriculum_id",
                2 => "fac.faculty_name",
                3 => "dep.department_name",
                4 => "maj.major_name",
                5 => "curriculum_progs",
                6 => "program_name_thai",
                7 => "curr.apply_method",
                8 => "curr.is_approve");
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;

            $query = DB::table('curriculum as curr')
                    ->select('curr.curriculum_id', 'fac.faculty_id', 'fac.faculty_name', 'fac.faculty_full', 'dep.department_id', 'dep.department_name', 'dep.department_name_en', 'maj.major_id', 'maj.major_name', 'maj.major_name_en', DB::raw("GROUP_CONCAT(curr_prog.program_id SEPARATOR ',') as curriculum_progs"),
//                    DB::raw("GROUP_CONCAT(course.thai SEPARATOR ',') as program_name_thai"),
//                    DB::raw("GROUP_CONCAT(course.english SEPARATOR ',') as program_name_eng"),
                            'de.degree_name', 'curr.apply_method', 'curr.is_approve')
                    ->leftJoin('tbl_faculty as fac', function ($join) {
                        $join->on('fac.faculty_id', '=', 'curr.faculty_id');
                    })
                    ->leftJoin('tbl_department as dep', function ($join) {
                        $join->on('dep.department_id', '=', 'curr.department_id');
                    })
                    ->leftJoin('tbl_major as maj', function ($join) {
                        $join->on('maj.major_id', '=', 'curr.major_id');
                    })
                    ->leftJoin('curriculum_program as curr_prog', function ($join) {
                        $join->on('curr_prog.curriculum_id', '=', 'curr.curriculum_id');
                    })
                    ->leftJoin('tbl_degree as de', function ($join) {
                        $join->on('de.degree_id', '=', 'curr.degree_id');
                    })
                    ->groupBy('curr.curriculum_id', 'fac.faculty_id', 'fac.faculty_name', 'fac.faculty_full', 'dep.department_id', 'dep.department_name', 'dep.department_name_en', 'maj.major_id', 'maj.major_name', 'maj.major_name_en', 'de.degree_name', 'curr.apply_method', 'curr.is_approve');

            $recordsTotal = $query->get()->count();

            if (isset($criteria['academic_year']) || isset($criteria['semester'])) {
                $query->whereIn('curr.curriculum_id', function ($query) use ($criteria) {
                    $query->select(DB::raw('distinct curr_act.curriculum_id'))
                            ->from('curriculum_activity as curr_act')
                            ->join('apply_setting as app_set', function ($join) {
                                $join->on('app_set.apply_setting_id', '=', 'curr_act.apply_setting_id');
                            });
                    if (isset($criteria['academic_year'])) {
                        $query->where('app_set.academic_year', '=', $criteria['academic_year']);
                    }
                    if (isset($criteria['semester'])) {
                        $query->where('app_set.semester', '=', $criteria['semester']);
                    }
                });
            }

            if (isset($criteria['faculty_id'])) {
                $query->where('fac.faculty_id', '=', $criteria['faculty_id']);
            }
            if (isset($criteria['program_type_id'])) {
                $query->where('curr_prog.program_type_id', '=', $criteria['program_type_id']);
            }

            if (isset($criteria['apply_method'])) {
                $query->where('curr.apply_method', '=', $criteria['apply_method']);
            }
            if (isset($criteria['is_approve'])) {
                $query->where('curr.is_approve', '=', $criteria['is_approve']);
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

        }

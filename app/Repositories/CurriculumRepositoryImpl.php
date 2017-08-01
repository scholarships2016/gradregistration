<?php

namespace App\Repositories;

use App\Repositories\Contracts\CurriculumActivityRepository;
use App\Repositories\Contracts\CurriculumProgramRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Models\Curriculum;
use App\Repositories\Contracts\CurriculumSubMajorRepository;
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

    private $paging = 10;

    public function __construct(CurriculumActivityRepository $currActRepo, CurriculumProgramRepository $currProgRepo,
                                FileRepository $fileRepo, CurriculumSubMajorRepository $currSubMajorRepo)
    {
        parent::setModelClassName(Curriculum::class);
        $this->currActRepo = $currActRepo;
        $this->currProgRepo = $currProgRepo;
        $this->fileRepo = $fileRepo;
        $this->currSubMajorRepo = $currSubMajorRepo;
    }

    public function searchByCriteria($curriculum_id = null, $curr_act_id = null, $criteria = null, $faculty_id = null, $degree_id = null, $status = null, $program_id = null, $inTime = true, $paging = false) {

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
                    ->leftJoin("tbl_major", function($join) {
                        $join->on("tbl_major.major_id", "=", "mcoursestudy.majorcode")
                        ->on("tbl_major.department_id", "=", "mcoursestudy.depcode");
                    })
                    ->leftJoin('tbl_Degree', 'curriculum.degree_id', '=', 'tbl_Degree.degree_id')
                    ->leftJoin('tbl_faculty', 'curriculum.faculty_id', '=', 'tbl_faculty.faculty_id')
                    ->leftJoin('tbl_department', 'curriculum.department_id', '=', 'tbl_department.department_id')
                    ->where('curriculum.status', 'like', '%' . $status . '%')
                    ->where('apply_setting.is_active', 'like', '%' . $status . '%')
                    ->Where(function ($query)use ($curriculum_id) {
                        if ($curriculum_id) {
                            $query->where('curriculum.curriculum_id', $curriculum_id);
                        }
                    })
                    ->Where(function ($query)use ($curr_act_id) {
                        if ($curr_act_id != null || $curr_act_id != '') {
                            $query->where('curriculum_activity.curr_act_id', $curr_act_id);
                        }
                    })
                    ->Where(function ($query)use ($degree_id) {
                        if ($degree_id != null || $degree_id != '') {
                            $query->where('tbl_Degree.degree_id', $degree_id);
                        }
                    })
                    ->Where(function ($query)use ($faculty_id) {
                        if ($faculty_id != null || $faculty_id != '') {
                            $query->where('tbl_faculty.faculty_id', $faculty_id);
                        }
                    })
                    ->Where(function ($query)use ($program_id) {
                        if ($program_id != null || $program_id != '') {
                            $query->where('curriculum_program.program_id', $program_id);
                        }
                    })
                    ->Where(function ($query)use ($inTime) {
                        if ($inTime) {
                            $query->where('apply_setting.start_date', '<=', Carbon::now())
                            ->where('apply_setting.end_date', '>=', Carbon::now())
                            ;
                        }
                    })
                    ->Where(function ($query)use ($criteria) {
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
                    ->select([DB::raw('* , @rownum  := @rownum  + 1 AS rownum')])
                    ->orderBy('curriculum.curriculum_id');

            $result = ($paging) ? $cur->offset($paging['start'])->limit($paging['length']) : $cur->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data)
    {
        Log::info('save Curriculum');

        try {
            $currObj = (array_key_exists('curriculum_id', $data) && !empty($data['curriculum_id'])) ? $this->find($data['curriculum_id']) : new Curriculum();
            if (empty($currObj)) {
                $currObj = new Curriculum();
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

    public function duplicateCurriculumSetting($id)
    {
        // TODO: Implement duplicateCurriculumSetting() method.
    }

    public function saveCurriculumSetting(array $datas)
    {
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

            $currObj = $this->save($datas);

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
                    $currActIds = array_push($currActIds, $value['curr_act_id']);
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

            if (!empty($currActIds)) {
                if (!is_array($currActIds)) {
                    $currActIds = array($currActIds);
                }
                $deletedActRows = $this->currActRepo->removeCurrActNotInListByCurriculumId($currActIds, $currObj->curriculum_id);
            }

            $currProgIds = array();
            foreach ($datas['programs'] as $index => $value) {
                if (!empty($value['curr_prog_id'])) {
                    $currProg = array_push($currProgIds, $value['curr_prog_id']);
                    $datas['programs'][$index]['modifier'] = $modifier;
                } else {
                    $datas['programs'][$index]['creator'] = $creator;
                    $datas['programs'][$index]['modifier'] = $modifier;
                }
                $datas['programs'][$index]['curriculum_id'] = $currObj->curriculum_id;
                $this->currProgRepo->save($datas['programs'][$index]);
            }
            if (!empty($currProgIds)) {
                if (!is_array($currProgIds)) {
                    $currProgIds = array($currProgIds);
                }
                $deletedActRows = $this->currProgRepo->removeCurrProgNotInListByCurriculumId($currProgIds, $currObj->curriculum_id);
            }

            DB::commit();
            return $currObj;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getCurriculumInfoById($id)
    {
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


}

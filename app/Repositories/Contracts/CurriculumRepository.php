<?php

namespace App\Repositories\Contracts;

interface CurriculumRepository
{

    public function searchByCriteria($curriculum_id = null, $curr_act_id = null, $criteria = null, $faculty_id = null, $degree_id = null, $status = null, $is_approve = null, $program_id = null, $inTime = true, $paging = false, $academic_year = null, $semester = null, $round_no = null);

    public function searchByCriteriaGroup($curriculum_id = null, $curr_act_id = null, $criteria = null, $faculty_id = null, $degree_id = null, $status = null, $is_approve = null, $program_id = null, $inTime = true, $paging = false, $academic_year = null, $semester = null, $round_no = null, $program_type = null);

    public function save(array $data);

    public function duplicateCurriculumSetting($id);

    public function saveCurriculumSetting(array $datas);

    public function getCurriculumInfoById($id);

    public function changeTransactionStatus(array $datas);

    public function deleteCurriculumInfoByCurriculumId($id);

    public function doPaging1($criteria = null);

    public function doToDoListPaging($criteria = null);

    public function checkCreatableCurriculumByCriteria($applyMethod, array $programs, $semester, $academicYear, $curriculumId = null);
}

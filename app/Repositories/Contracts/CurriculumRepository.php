<?php

namespace App\Repositories\Contracts;

interface CurriculumRepository
{
    public function searchByCriteria($criteria = null, $faculty_id = null, $degree_id = null, $status = null, $program_id = null, $paging = false);

    public function save(array $data);

    public function duplicateCurriculumSetting($id);

    public function saveCurriculumSetting(array $datas);

    public function getCurriculumInfoById($id);

    public function changeTransactionStatus(array $datas);

    public function deleteCurriculumInfoByCurriculumId($id);

    public function doPaging1($criteria = null);

    public function doToDoListPaging($criteria = null);
}

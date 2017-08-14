<?php

namespace App\Repositories;

use App\Models\CurriculumWorkflowTransaction;
use App\Repositories\Contracts\CurriculumWorkflowTransactionRepository;


class CurriculumWorkflowTransactionRepositoryImpl extends AbstractRepositoryImpl implements CurriculumWorkflowTransactionRepository
{
    public function __construct()
    {
        parent::setModelClassName(CurriculumWorkflowTransaction::class);
    }

    public function save(array $data)
    {
        try {
            $currObj = (array_key_exists('curr_wf_tran_id', $data) && !empty($data['curr_wf_tran_id'])) ? $this->find($data['curr_wf_tran_id']) : new CurriculumWorkflowTransaction();
            if (empty($currObj)) {
                $currObj = new CurriculumWorkflowTransaction();
            }
            if (array_key_exists('comment', $data)) {
                $currObj->comment = trim($data['comment']) == '' ? null : trim($data['comment']);
            }
            if (array_key_exists('workflow_status_id', $data)) {
                $currObj->workflow_status_id = $data['workflow_status_id'];
            }
            if (array_key_exists('curriculum_id', $data)) {
                $currObj->curriculum_id = $data['curriculum_id'];
            }
            //Creator and Editor
            if (array_key_exists('creator', $data)) {
                $currObj->creator = $data['creator'];
            }
            $currObj->save();
            return $currObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\Audittrail;
use App\Repositories\Contracts\AudittrailRepository;
use Illuminate\Support\Facades\DB;


class AudittrailRepositoryImpl extends AbstractRepositoryImpl implements AudittrailRepository
{

    public function __construct()
    {
        parent::setModelClassName(Audittrail::class);
    }

    public function save(array $data)
    {
        try {
            $currObj = (array_key_exists('audit_id', $data) && !empty($data['audit_id'])) ? $this->find($data['audit_id']) : new Audittrail();
            if (empty($currObj)) {
                $currObj = new Audittrail();
            }
            if (array_key_exists('section', $data)) {
                $currObj->section = $data['section'];
            }
            if (array_key_exists('audit_action_id', $data)) {
                $currObj->audit_action_id = $data['audit_action_id'];
            }
            if (array_key_exists('detail', $data)) {
                $currObj->detail = $data['detail'];
            }
            if (array_key_exists('performer', $data)) {
                $currObj->performer = $data['performer'];
            }
            $currObj->save();
            return $currObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

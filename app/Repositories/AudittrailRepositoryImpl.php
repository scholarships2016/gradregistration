<?php

namespace App\Repositories;

use App\Models\Audittrail;
use App\Repositories\Contracts\AudittrailRepository;
use Carbon\Carbon;
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

    public function doPaging($criteria = null)
    {
        try {
            $columnMap = array(
                1 => "au.section",
                2 => "au.performer",
                3 => "au.audit_action_id",
                4 => "au.detail",
                5 => "au.action_date");
            $draw = empty($criteria['draw']) ? 1 : $criteria['draw'];
            $data = null;


            $query = DB::table("audittrail as au")
                ->select('au.audit_id', 'au.section',
                    'au.performer', 'u.name','u.nickname', 'au.audit_action_id',
                    'au_act.audit_action_name', 'au.detail',
                    DB::raw("date_format(au.action_date,'%d/%m/%Y %H:%i') as action_date"))
                ->leftJoin('tbl_audittrail_action as au_act', function ($join) {
                    $join->on('au_act.audit_action_id', '=', 'au.audit_action_id');
                })->leftJoin('user as u', function ($join) {
                    $join->on('u.user_id', '=', 'au.performer');
                });

            $recordsTotal = $query->get()->count();

            if (isset($criteria['from_date'])) {
                $query->whereDate('au.action_date', '>=', Carbon::createFromFormat('d-m-Y', $criteria['from_date'])->format('Y-m-d'));
            }
            if (isset($criteria['to_date'])) {
                $query->whereDate('au.action_date', '<=', Carbon::createFromFormat('d-m-Y', $criteria['to_date'])->format('Y-m-d'));
            }
            if (isset($criteria['section'])) {
                $query->where('au.section', '=', $criteria['section']);
            }
            if (isset($criteria['detail'])) {
                $query->where('au.detail', 'like', '%' . $criteria['detail'] . '%');
            }
            if (isset($criteria['performer'])) {
                $query->where('u.name', 'like', '%' . $criteria['performer'] . '%');
            }
            if (isset($criteria['audit_action_id'])) {
                $query->where('au.audit_action_id', '=', $criteria['audit_action_id']);
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
            throw  $ex;
        }
    }

    public function getDistinctSection()
    {
        try {
            $query = DB::table("audittrail as au")
                ->select('au.section')
                ->distinct();
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\BackOfficeNotificationRepository;
use Illuminate\Support\Facades\DB;

class BackOfficeNotificationRepositoryImpl extends AbstractRepositoryImpl implements BackOfficeNotificationRepository
{
    protected $bakOffNoticeRepo;

    public function __construct()
    {
    }

    public function getWorkflowTaskForBackOffice($isAdmin = false, $userId = null)
    {
        try {
            $query = DB::table('curriculum as curr')
                ->select(
                    'wf_status.curr_wf_status_id',
                    'wf_status.status_name',
                    'curr.is_approve as status_id',
                    DB::raw('count(curr.curriculum_id) as amt'),
                    'curr.creator')
                ->join('tbl_curriculum_workflow_status as wf_status', function ($join) {
                    $join->on('wf_status.curr_wf_status_id', '=', 'curr.is_approve');
                })
                ->groupBy('wf_status.curr_wf_status_id',
                    'wf_status.status_name',
                    'curr.is_approve',
                    'curr.curriculum_id',
                    'curr.creator');

            if ($isAdmin) {
                $query->where('curr.is_approve', '=', 2);
            } else {
                $query->where('curr.is_approve', '!=', 2)
                    ->where('curr.is_approve', '!=', 4);
                if (!empty($userId)) {
                    $query->where('curr.creator', '=', $userId);
                }
            }
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getWorkflowTaskDetailForBackOffice($isAdmin = false, $userId = null)
    {
        try {
            $query = DB::table('curriculum as curr')
                ->select('curr.curriculum_id',
                    'deg.degree_name',
                    'curr.is_approve as status_id',
                    'wf_status.status_name',
                    'curr.creator',
                    'appset.semester',
                    'appset.academic_year')
                ->join('tbl_degree as deg', function ($join) {
                    $join->on('deg.degree_id', '=', 'curr.degree_id');
                })
                ->join('tbl_curriculum_workflow_status as wf_status', function ($join) {
                    $join->on('wf_status.curr_wf_status_id', '=', 'curr.is_approve');
                })
                ->join('curriculum_activity as act', function ($join) {
                    $join->on('act.curriculum_id', '=', 'curr.curriculum_id');
                })
                ->join('apply_setting as appset', function ($join) {
                    $join->on('appset.apply_setting_id', '=', 'act.apply_setting_id');
                })
                ->groupBy('curr.curriculum_id',
                    'deg.degree_name',
                    'curr.is_approve',
                    'wf_status.status_name',
                    'curr.creator',
                    'appset.semester',
                    'appset.academic_year');

            if ($isAdmin) {
                $query->where('curr.is_approve', '=', 2);
            } else {
                $query->where('curr.is_approve', '!=', 2)
                    ->where('curr.is_approve', '!=', 4);
                if (!empty($userId)) {
                    $query->where('curr.creator', '=', $userId);
                }
            }
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}


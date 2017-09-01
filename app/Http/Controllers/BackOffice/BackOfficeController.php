<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\BackOfficeNotificationRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackOfficeController extends Controller
{
    //

    protected $bakOffNoticeRepo;
    protected $curriculumRepo;

    /**
     * BackOfficeController constructor.
     */
    public function __construct(CurriculumRepository $curriculumRepo,
                                BackOfficeNotificationRepository $bakOffNoticeRepo)
    {
        $this->curriculumRepo = $curriculumRepo;
        $this->bakOffNoticeRepo = $bakOffNoticeRepo;
    }

    public function showToDoListPage(Request $request)
    {
        try {
            return view('backoffice.toDoList');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $who = 'test';
            $param = $request->all();
            $isAdmin = true;
            if (!$isAdmin) {
                $param['creator'] = $who;
            }
            return response()->json($this->curriculumRepo->doToDoListPaging($param));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getWorkflowNotification(Request $request)
    {
        try {
            $isAdmin = false;
            $userId = null;
            $result = $this->bakOffNoticeRepo->getWorkflowTaskDetailForBackOffice($isAdmin, $userId);
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, null));
        }
    }
}

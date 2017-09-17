<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\BackOfficeNotificationRepository;
use App\Repositories\Contracts\CurriculumRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
            $who = session('user_id');
            $param = $request->all();
            $isAdmin = (session('user_type')->user_type == 'Admin') ? true : false;
            $param['creator'] = $who;
            return response()->json($this->curriculumRepo->doToDoListPaging($param, $isAdmin));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getWorkflowNotification(Request $request)
    {
        try {
            $isAdmin = (session('user_type')->user_type == 'Admin') ? true : false;
            $userId = session('user_id');
            $result = $this->bakOffNoticeRepo->getWorkflowTaskDetailForBackOffice($isAdmin, $userId);
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, null));
        }
    }
}

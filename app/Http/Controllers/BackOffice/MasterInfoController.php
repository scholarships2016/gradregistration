<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\McourseStudyRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MasterInfoController extends Controller
{
    //
    protected $mcStudyRepo;

    /**
     * MasterInfoController constructor.
     */
    public function __construct(McourseStudyRepository $mcStudyRepo)
    {
        $this->mcStudyRepo = $mcStudyRepo;
    }

    public function showManageCoursePage(Request $request)
    {
        return view('backoffice.masterInfo.courseManage');
    }

    public function getMCourseData(Request $request)
    {
        try {
            $result = $this->mcStudyRepo->getMcourseStudyPaging1($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        }
    }

}

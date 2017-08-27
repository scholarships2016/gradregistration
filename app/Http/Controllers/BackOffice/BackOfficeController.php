<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\CurriculumRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackOfficeController extends Controller
{
    //

    protected $curriculumRepo;

    /**
     * BackOfficeController constructor.
     */
    public function __construct(CurriculumRepository $curriculumRepo)
    {
        $this->curriculumRepo = $curriculumRepo;
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
            return response()->json($this->curriculumRepo->doToDoListPaging($request->all()));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

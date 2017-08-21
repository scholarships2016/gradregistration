<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplicantRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicantManagementController extends Controller
{

    protected $applicantRepo;

    /**
     * ApplicantManagementController constructor.
     */
    public function __construct(ApplicantRepository $applicantRepo)
    {
        $this->applicantRepo = $applicantRepo;
    }

    public function showManagePage(Request $request)
    {
        try {
            return view('backoffice.applicant.manage');
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function showAddPage(Request $request)
    {

    }

    public function showEditPage(Request $request)
    {

    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->applicantRepo->doApplicantPaging($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

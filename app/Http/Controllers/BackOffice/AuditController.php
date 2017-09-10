<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\TblAudittrailActionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{

    protected $auditRepo;
    protected $auditActRepo;

    /**
     * AuditController constructor.
     */
    public function __construct(AudittrailRepository $auditRepo,
                                TblAudittrailActionRepository $auditActRepo)
    {
        $this->auditRepo = $auditRepo;
        $this->auditActRepo = $auditActRepo;
    }

    public function showAuditManagePage(Request $request)
    {
        try {
            $sections = $this->auditRepo->getDistinctSection();
            $actions = $this->auditActRepo->all();
            return view('backoffice.audit.manage', ['sections' => $sections, 'actions' => $actions]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->auditRepo->doPaging($request->all());
            return response()->json($result);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

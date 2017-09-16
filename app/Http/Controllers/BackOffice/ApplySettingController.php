<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\ApplySettingRepository;
use App\Repositories\Contracts\AudittrailRepository;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplySettingController extends Controller
{
    private static $SECTION_NAME = 'ApplySetting';

    protected $appSetRepo;

    /**
     * ApplySettingController constructor.
     */
    public function __construct(ApplySettingRepository $appSetRepo, AudittrailRepository $auditRepo)
    {
        parent::__construct(null, null, $auditRepo);
        $this->appSetRepo = $appSetRepo;
    }

    public function showManagePage(Request $request)
    {
        try {
            return view('backoffice.applysetting.manage');
        } catch (\Exception $ex) {
            $this->WLog('func=showManagePage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->appSetRepo->getApplySettingPaging();
            return response()->json($result);
        } catch (\Exception $ex) {
            $this->WLog('func=doPaging', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }


    public function showAddPage(Request $request)
    {
        try {
            $acaYearList = Util::prepareAcademicYearList(Carbon::now()->year, 1, 1, Util::ORDER_DESC);
            return view('backoffice.applysetting.edit', ['yearList' => $acaYearList, 'appSetList' => null,
                'academic_year' => null, 'semester' => null, 'isEdit' => false]);
        } catch (\Exception $ex) {
            $this->WLog('func=showAddPage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }

    public function showEditPage(Request $request)
    {
        try {

            $param = $request->all();
            if (!(isset($param['semester']) && isset($param['academic_year']))) {
                return redirect()->route('admin.applysetting.showManagePage');
            }

            $yearList = array();
            $academicYears = $this->appSetRepo->getDistinctAcademicYear();
            foreach ($academicYears as $index => $value) {
                array_push($yearList, $value->academic_year);
            }
            rsort($yearList);

            $appSetList = $this->appSetRepo->getApplySettingBySemesterAndAcademicYear($param['semester'], $param['academic_year']);
            if ($appSetList->isEmpty()) {
                return redirect()->route('admin.applysetting.showManagePage');
            }

            $this->WLog('func=showEditPage', self::$SECTION_NAME, null);

            return view('backoffice.applysetting.edit', ['yearList' => $yearList, 'appSetList' => $appSetList,
                'academic_year' => $param['academic_year'], 'semester' => $param['semester'], 'isEdit' => true]);
        } catch (\Exception $ex) {
            $this->WLog('func=showEditPage', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
        }
    }

    public function doSave(Request $request)
    {
        try {
            $data = $request->all();
            $who = session('user_id');
            $data['creator'] = $who;
            $data['modifier'] = $who;

            if (!isset($data['semester']) || !isset($data['academic_year'])) {
                $data['isEdit'] = true;
                $data['semester'] = $data['semesterHidden'];
                $data['academic_year'] = $data['academicYearHidden'];
            } else {
                $data['isEdit'] = false;
            }

            if (isset($data['apply_setting_group'])) {
                $ids = array();
                foreach ($data['apply_setting_group'] as $index => $value) {
                    if (isset($value['apply_setting_id'])) {
                        array_push($ids, $value['apply_setting_id']);
                    }
                    $data['apply_setting_group'][$index]['semester'] = $data['semester'];
                    $data['apply_setting_group'][$index]['academic_year'] = $data['academic_year'];

                    if (isset($value['start_date'])) {
                        $data['apply_setting_group'][$index]['start_date'] = Carbon::createFromFormat('d/m/Y', $value['start_date'])->format('Y-m-d');
                    }

                    if (isset($value['end_date'])) {
                        $data['apply_setting_group'][$index]['end_date'] = Carbon::createFromFormat('d/m/Y', $value['end_date'])->format('Y-m-d');
                    }

                    if (!isset($value['status'])) {
                        $data['apply_setting_group'][$index]['status'] = 0;
                    }
                    if (!isset($value['is_active'])) {
                        $data['apply_setting_group'][$index]['status'] = 0;
                    }

                    if (!isset($value['apply_setting_id'])) {
                        $data['apply_setting_group'][$index]['creator'] = $who;
                        $data['apply_setting_group'][$index]['modifier'] = $who;
                    } else {
                        $data['apply_setting_group'][$index]['modifier'] = $who;
                    }
                }
                $data['ids'] = $ids;
                $result = $this->appSetRepo->saveApplySetting($data);

                /*
                 * Audit Info
                 */

                $audit = array();
                $audit['section'] = self::$SECTION_NAME;
                $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
                $audit['detail'] = 'createUpdate,semester=' . $data['semester'] . 'academic_year=' . $data['semester'];
                $audit['performer'] = $who;
                $this->auditRepo->save($audit);

                $this->WLog('func=doSave', self::$SECTION_NAME, null);

                return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
            }

            $this->WLog('func=doSave', self::$SECTION_NAME, null);

        } catch (\Exception $ex) {
            $this->WLog('func=doSave', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $param = $request->all();
            $who = session('user_id');

            if (!(isset($param['semester']) && isset($param['academic_year']))) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $canDel = $this->appSetRepo->checkRemoveableApplySettingBySemesterAndAcademicYear($param['semester'], $param['academic_year']);

            if ($canDel) {
                $this->appSetRepo->deleteBySemesterAndAcademicYear($param['semester'], $param['academic_year']);
                $this->WLog('func=doDelete', self::$SECTION_NAME, null);
                $audit = array();
                $audit['section'] = self::$SECTION_NAME;
                $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
                $audit['detail'] = 'delete,semester=' . $param['semester'] . 'academic_year=' . $param['academic_year'];
                $audit['performer'] = $who;
                $this->auditRepo->save($audit);

                return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
            } else {
                return response()->json(Util::jsonResponseFormat(2, null, Util::CANNOT_DELETE));
            }
        } catch (\Exception $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }


}

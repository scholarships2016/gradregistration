<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\AudittrailRepository;
use App\Repositories\Contracts\TblPermissionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminManagementController extends Controller
{

    private static $SECTION_NAME = 'AdminManagement';

    protected $userRepo;
    protected $permissionRepo;

    /**
     * AdminManagementController constructor.
     */
    public function __construct(UserRepository $userRepo, TblPermissionRepository $permissionRepo, AudittrailRepository $auditRepo)
    {
        parent::__construct(null, null, $auditRepo);
        $this->userRepo = $userRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function showManagePage(Request $request)
    {
        return view('backoffice.admin.manage');
    }

    public function showAddPage(Request $request)
    {
        try {
            $permissionList = $this->permissionRepo->all();
            return view('backoffice.admin.edit', ['permissionList' => $permissionList, 'user' => null]);
        } catch (\Exception $ex) {
            $this->WLog('func=showAddPage', self::$SECTION_NAME, $ex->getMessage());
            return redirect()->route('admin.adminManage.showManagePage');
        }
    }

    public function showEditPage(Request $request, $id)
    {
        try {
            $this->WLog('func=showEditPage', self::$SECTION_NAME, null);
            $who = 'test';

            $user = $this->userRepo->findOrFail($id);
            $permissionList = $this->permissionRepo->all();

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_VIEW;
            $audit['detail'] = 'showEditPage,user_id=' . $id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);

            return view('backoffice.admin.edit', ['permissionList' => $permissionList,
                'user' => $user]);
        } catch (\Exception $ex) {
            $this->WLog('func=showEditPage', self::$SECTION_NAME, $ex->getMessage());
            return redirect()->route('admin.adminManage.showManagePage');
        }
    }

    public function doSave(Request $request)
    {
        try {
            $this->WLog('func=doSave', self::$SECTION_NAME, null);

            $data = $request->all();
            $who = session('user_id');
            $data['modifier'] = $who;
            $data['creator'] = $who;

            //Test
                    if (empty($data['user_id'])) {
                        $data['user_password'] = bcrypt('123456');
                    }


            $result = $this->userRepo->doSave($data);

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_UPDATE;
            $audit['detail'] = 'doSave,user_id=' . $data['user_id'];
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);


            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            $this->WLog('func=doSave', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->userRepo->getUserPaging();
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        } catch (\Exception $ex) {
            $this->WLog('func=doPaging', self::$SECTION_NAME, $ex->getMessage());
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $this->WLog('func=doDelete', self::$SECTION_NAME, null);
            $who = session('user_id');

            $user_id = $request->input('user_id');
            if (empty($user_id)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $this->userRepo->deleteByUserId($user_id);

            /*
                 * Audit Info
                 */

            $audit = array();
            $audit['section'] = self::$SECTION_NAME;
            $audit['audit_action_id'] = Util::AUDIT_ACT_DELETE;
            $audit['detail'] = 'doSave,user_id=' . $user_id;
            $audit['performer'] = $who;
            $this->auditRepo->save($audit);


            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            $this->WLog('func=doDelete', self::$SECTION_NAME, $ex->getMessage());
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }
}

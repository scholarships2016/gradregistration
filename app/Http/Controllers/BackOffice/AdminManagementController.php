<?php

namespace App\Http\Controllers\BackOffice;

use App\Repositories\Contracts\TblPermissionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Utils\Util;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminManagementController extends Controller
{

    protected $userRepo;
    protected $permissionRepo;

    /**
     * AdminManagementController constructor.
     */
    public function __construct(UserRepository $userRepo, TblPermissionRepository $permissionRepo)
    {
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
            return redirect()->route('admin.adminManage.showManagePage');
        }
    }

    public function showEditPage(Request $request, $id)
    {
        try {
            $user = $this->userRepo->findOrFail($id);
            $permissionList = $this->permissionRepo->all();

            return view('backoffice.admin.edit', ['permissionList' => $permissionList,
                'user' => $user]);
        } catch (\Exception $ex) {
            return redirect()->route('admin.adminManage.showManagePage');
        }
    }

    public function doSave(Request $request)
    {
        try {
            $data = $request->all();
            $who = 'test';
            $data['modifier'] = $who;
            $data['creator'] = $who;
            //Test
                    if (empty($data['user_id'])) {
                        $data['user_password'] = bcrypt('123456');
                    }


            $result = $this->userRepo->doSave($data);
            return response()->json(Util::jsonResponseFormat(1, $result, Util::SUCCESS_SAVE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doPaging(Request $request)
    {
        try {
            $result = $this->userRepo->getUserPaging();
            return response()->json(Util::jsonResponseFormat(1, $result, null));
        } catch (\Exception $ex) {
            throw $ex;
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }

    public function doDelete(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            if (empty($user_id)) {
                return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
            }
            $this->userRepo->deleteByUserId($user_id);
            return response()->json(Util::jsonResponseFormat(1, null, Util::SUCCESS_DELETE));
        } catch (\Exception $ex) {
            return response()->json(Util::jsonResponseFormat(3, null, Util::ERROR_OCCUR));
        }
    }
}

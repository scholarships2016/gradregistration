<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserPermissionRepository;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserRepositoryImpl extends AbstractRepositoryImpl implements UserRepository
{

    protected $userPerRepo;

    public function __construct(UserPermissionRepository $userPerRepo)
    {
        parent::setModelClassName(User::class);
        $this->userPerRepo = $userPerRepo;
    }

    public function save(array $data)
    {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('user_id', $data) || !empty($data['user_id']))
                $id = $data['user_id'];

            $chk = User::where('user_id', $id)->first();
            $curObj = $chk ? $chk : new User;
            if (array_key_exists('user_name', $data))
                $curObj->user_name = $data['user_name'];
            if (array_key_exists('user_password', $data))
                $curObj->user_password = $data['user_password'];
            if (array_key_exists('user_email', $data))
                $curObj->user_email = $data['user_email'];
            if (array_key_exists('name', $data))
                $curObj->name = $data['name'];
            if (array_key_exists('nickname', $data))
                $curObj->nickname = $data['nickname'];
            if (array_key_exists('role_id', $data))
                $curObj->role_id = $data['role_id'];
            if (array_key_exists('last_login', $data))
                $curObj->last_login = $data['last_login'];
            if (array_key_exists('ipaddress', $data))
                $curObj->ipaddress = $data['ipaddress'];

            //Creator Modifier
            if (array_key_exists('modifier', $data))
                $curObj->modifier = $data['modifier'];
            if (array_key_exists('creator', $data) && empty($curObj->user_id))
                $curObj->creator = $data['creator'];

            $curObj->save();
            return $curObj;
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function doSave(array $data)
    {
        DB::beginTransaction();
        try {

            $newObj = $this->save($data);

            $this->userPerRepo->deleteUserPermissionByUserId($newObj->user_id);

            if (isset($data['permission_id'])) {
                foreach ($data['permission_id'] as $value) {
                    $permissionMap['user_id'] = $newObj->user_id;
                    $permissionMap['permission_id'] = $value;
                    $this->userPerRepo->create($permissionMap);
                }
            }

            DB::commit();
            return $newObj;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function getUserPaging()
    {
        try {
            $query = DB::table('user as u')
                ->select('u.user_id', 'u.user_name', 'u.name', 'u.nickname',
                    'u.role_id',
                    DB::raw("GROUP_CONCAT(tblp.permission_name order by tblp.permission_id asc SEPARATOR ',' ) as permission"),
                    DB::raw("date_format(u.last_login,'%d/%m/%Y %H:%i') as last_login")
                )
                ->leftJoin('user_permission as up', function ($join) {
                    $join->on('up.user_id', '=', 'u.user_id');
                })
                ->leftJoin('tbl_permission as tblp', function ($join) {
                    $join->on('tblp.permission_id', '=', 'up.permission_id');
                })
                ->groupBy('u.user_id', 'u.user_name', 'u.name', 'u.nickname', 'u.role_id', 'u.last_login');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function deleteByUserId($userId)
    {
        DB::beginTransaction();

        try {
            $user = $this->findOrFail($userId);

            if (!empty($user->userPermission)) {
                $this->userPerRepo->deleteUserPermissionByUserId($userId);
            }
            $result = $user->delete();
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function doSave2(array $data)
    {
        DB::beginTransaction();
        try {

            $user = $this->findOrFail($data['user_id']);
            $user->nickname = $data['nickname'];
            $user->user_email = $data['user_email'];
            $user->modifier = $data['modifier'];
            $user->save();

            DB::commit();
            return $user;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

}

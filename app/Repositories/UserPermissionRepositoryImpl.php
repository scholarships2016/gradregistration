<?php

namespace App\Repositories;

use App\Models\UserPermission;
use App\Repositories\Contracts\UserPermissionRepository;
use Illuminate\Support\Facades\DB;

class UserPermissionRepositoryImpl extends AbstractRepositoryImpl implements UserPermissionRepository
{

    public function __construct()
    {
        parent::setModelClassName(UserPermission::class);
    }

    public function save(array $data)
    {
    }

    public function deleteUserPermissionByUserId($userId)
    {
        try {
            return UserPermission::where('user_id', '=', $userId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

<?php

namespace App\Repositories\Contracts;

interface UserPermissionRepository
{
    public function save(array $data);

    public function deleteUserPermissionByUserId($userId);
}

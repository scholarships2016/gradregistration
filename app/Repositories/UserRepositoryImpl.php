<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepository;
use App\Models\User;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl extends AbstractRepositoryImpl implements UserRepository {

    public function __construct() {
        parent::setModelClassName(User::class);
    }

    public function save(array $data) {
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
            if (array_key_exists('name', $data))
                $curObj->name = $data['name'];
            if (array_key_exists('role_id', $data))
                $curObj->role_id = $data['role_id'];
            if (array_key_exists('last_login', $data))
                $curObj->last_login = $data['last_login'];
            if (array_key_exists('ipaddress', $data))
                $curObj->ipaddress = $data['ipaddress'];
            if (array_key_exists('user_name', $data))
                $curObj->modifier = $data['user_name'];
            if ($id == null)
                $curObj->creator = $data['user_name'];



            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

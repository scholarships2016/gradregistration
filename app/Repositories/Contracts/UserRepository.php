<?php

namespace App\Repositories\Contracts;

interface UserRepository
{
    public function save(array $data);

    public function doSave(array $data);

    public function getUserPaging();

    public function deleteByUserId($userId);
}
 

 

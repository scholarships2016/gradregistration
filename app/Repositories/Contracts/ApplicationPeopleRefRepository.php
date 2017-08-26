<?php

namespace App\Repositories\Contracts;

interface ApplicationPeopleRefRepository
{
    public function save($data);

    public function getDetail($appID);

    public function deleteByApplicationId($applicationId);
}

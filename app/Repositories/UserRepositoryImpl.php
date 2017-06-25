<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProfileRepository;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class UserRepositoryImpl extends AbstractRepositoryImpl implements UserRepository
{

    protected $profileRepo;

    public function __construct(ProfileRepository $profileRepo)
    {
        parent::setModelClassName(User::class);
        $this->profileRepo = $profileRepo;
    }
 
}
<?php

namespace App\Repositories;

use App\Repositories\Contracts\EngTestRepository;
use App\Models\TblEngTest;


class EngTestRepositoryImpl extends AbstractRepositoryImpl implements EngTestRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblEngTest::class);
    }

}

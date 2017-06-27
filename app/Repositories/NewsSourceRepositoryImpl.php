<?php

namespace App\Repositories;

use App\Repositories\Contracts\NewsSourceRepository;
use App\Models\TblNewsSource;

class NewsSourceRepositoryImpl extends AbstractRepositoryImpl implements NewsSourceRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblNewsSource::class);
    }


}

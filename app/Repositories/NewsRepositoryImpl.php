<?php

namespace App\Repositories;

use App\Repositories\Contracts\NewsRepository;
use App\Models\News;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class NewsRepositoryImpl extends AbstractRepositoryImpl implements NewsRepository {

    protected $newsPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(News::class);
    }

    public function getNewsNow() {
        $reuslt = null;
        try {
            $reuslt = News::where('news_is_active', '1')->orderBy('news_seq', 'asc')->orderBy('news_id', 'desc')->take(5)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $reuslt;
    }

}

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
            $reuslt = News::where('news_is_active', '1')->orderBy('news_seq', 'asc')->orderBy('modified', 'asc')->take(5)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $reuslt;
    }

    public function getNewsAll() {
        $reuslt = null;
        try {
            $reuslt = News::orderBy('news_seq', 'asc')->orderBy('modified', 'desc')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $reuslt;
    }

    public function DeleteNews($id) {
        $reuslt = null;
        try {
            $reuslt = News::where('news_id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $reuslt;
    }

    public function save(array $data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('news_id', $data) || !empty($data['news_id']))
                $id = $data['news_id'];

            $chk = News::where('news_id', $id)->first();
            $curObj = $chk ? $chk : new News;
            if (array_key_exists('news_title', $data))
                $curObj->news_title = $data['news_title'];
            if (array_key_exists('news_detail', $data))
                $curObj->news_detail = $data['news_detail'];
            if (array_key_exists('news_title_en', $data))
                $curObj->news_title_en = $data['news_title_en'];
            if (array_key_exists('news_detail_en', $data))
                $curObj->news_detail_en = $data['news_detail_en'];
            if (array_key_exists('news_seq', $data))
                $curObj->news_seq = $data['news_seq'];
            if (array_key_exists('news_is_active', $data))
                $curObj->news_is_active = $data['news_is_active'];
            
            if (!$chk){
                $curObj->creator =session('first_name').' '.session('last_name');
            }else{
                $curObj->modifier =session('first_name').' '.session('last_name');
            }

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

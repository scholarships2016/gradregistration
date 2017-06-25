<?php

namespace App\Repositories;

use App\Repositories\Contracts\NameTitleRepository;
use App\Models\TblNameTitle;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class NameTitleRepositoryImpl extends AbstractRepositoryImpl implements NameTitleRepository {

    protected $nametitlePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblNameTitle::class);
    }

    public function getByID($id) {
        $result = null;
        try {
            $result = TblNameTitle::where('name_title_id', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }
      public function getAll() {
        $result = null;
        try {
            $result = TblNameTitle::orderBy('name_title_id')->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

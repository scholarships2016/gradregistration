<?php

namespace App\Repositories;

use App\Repositories\Contracts\DocumentsApplyRepository;
use App\Models\TblDocumentsApply;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DocumentsApplyRepositoryImpl extends AbstractRepositoryImpl implements DocumentsApplyRepository {

    protected $DocumentsApplyPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDocumentsApply::class);
    }
 
    public function getDetail(){
         $result = null;
        try {
            $result = TblDocumentsApply::where('active', 0)->get();
              } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }
     public function getGroup(){
         $result = null;
        try {
            $result = TblDocumentsApply::where('active', 0)->groupBy('doc_apply_group','doc_apply_group_en') ->select('doc_apply_group','doc_apply_group_en')->orderby('doc_apply_id')->get();
             } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

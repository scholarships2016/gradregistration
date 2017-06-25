<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicantRepository;
use App\Models\TblApplicant;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicantRepositoryImpl extends AbstractRepositoryImpl implements ApplicantRepository {

    protected $statusPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblApplicant::class);
    }
      public function getById($id) {
        $result = null;
        try {
            $result = TblApplicant::where('applicant_id ', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }
 

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\SatisfactionRepository;
use App\Models\Satisfaction;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class SatisfactionRepositoryImpl extends AbstractRepositoryImpl implements SatisfactionRepository {

    protected $SatisfactionRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(Satisfaction::class);
    }

    public function getById($id) {
        $result = null;
        try {
            $result = Satisfaction::where('stu_citizen_card', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('stu_citizen_card', $data) || !empty($data['stu_citizen_card']))
                $id = $data['stu_citizen_card'];

            $chk = Satisfaction::where('stu_citizen_card', $id)->first();
            $curObj = $chk ? $chk : new Satisfaction;

            if (array_key_exists('stu_citizen_card', $data))
                $curObj->stu_citizen_card = $data['stu_citizen_card'];
            if (array_key_exists('SATI_LEVEL', $data))
                $curObj->SATI_LEVEL = $data['SATI_LEVEL'];
            if (array_key_exists('SATI_SUGGESTION', $data))
                $curObj->SATI_SUGGESTION = $data['SATI_SUGGESTION'];

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

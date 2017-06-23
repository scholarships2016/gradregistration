<?php

namespace App\Repositories;

use App\Repositories\Contracts\DegreeRepository;
use App\Models\TblDegree;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DegreeRepositoryImpl extends AbstractRepositoryImpl implements DegreeRepository {

    protected $degreeRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblDegree::class);
    }

    public function getById($id) {
        $result = null;
        try {
            $result = TblDegree::where('degree_id', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteria($criteria = null, $paging = false) {
        $result = null;
        try {
            $degrees = TblDegree::where('degree_id', 'like', '%' . $criteria . '%')
                    ->orwhere('degree_name', 'like', '%' . $criteria . '%')
                    ->orwhere('degree_name_en', 'like', '%' . $criteria . '%')
                    ->orderBy('degree_id');
            $result = ($paging) ? $degrees->paginate($this->paging) : $degrees;
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data) {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('id', $data) || !empty($data['id']))
                $id = $data['id'];

            $chk = TblDegree::where('degree_id', $id)->first();
            $curObj = $chk ? $chk : new TblDegree;
            if (array_key_exists('degree_id', $data))
                $curObj->degree_id = $data['degree_id'];
            if (array_key_exists('degree_name', $data))
                $curObj->degree_name = $data['degree_name'];
            if (array_key_exists('degree_name_en', $data))
                $curObj->degree_name_en = $data['degree_name_en'];

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function delete($id) {
        $result = false;
        try {
            $result = TblDegree::where('degree_id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

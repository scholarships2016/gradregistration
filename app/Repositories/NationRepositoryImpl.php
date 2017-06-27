<?php

namespace App\Repositories;

use App\Models\TblNation;
use App\Repositories\Contracts\NationRepository;


class NationRepositoryImpl extends AbstractRepositoryImpl implements NationRepository
{

    protected $nationRepo;
    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblNation::class);

    }

    public function getById($id)
    {
        $result = null;
        try {
            $result = TblNation::where('nation_id', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteria($criteria = null, $paging = false)
    {
        $result = null;
        try {
            $nations = TblNation::where('nation_id', 'like', '%' . $criteria . '%')
                ->orwhere('nation_name', 'like', '%' . $criteria . '%')
                ->orwhere('nation_name_en', 'like', '%' . $criteria . '%')
                ->orderBy('nation_id');
            $result = ($paging) ? $nations->paginate($this->paging) : $nations;
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save(array $data)
    {
        $result = false;
        try {
            $id = null;

            if (array_key_exists('id', $data) || !empty($data['id']))
                $id = $data['id'];

            $chk = TblNation::where('nation_id', $id)->first();
            $curObj = $chk ? $chk : new TblNation;

            if (array_key_exists('nation_id', $data))
                $curObj->nation_id = $data['nation_id'];
            if (array_key_exists('nation_name', $data))
                $curObj->nation_name = $data['nation_name'];
            if (array_key_exists('nation_name_en', $data))
                $curObj->nation_name_en = $data['nation_name_en'];

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function delete($id)
    {
        $result = false;
        try {
            $result = TblNation::where('nation_id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\BankRepository;
use App\Models\TblBank;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class BankRepositoryImpl extends AbstractRepositoryImpl implements BankRepository {

    protected $bankRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblBank::class);
    }

    public function getById($id) {
        $result = null;
        try {
            $result = TblBank::where('id', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteria($criteria = null, $paging = false) {
        $result = null;
        try {
            $banks = TblBank::where('bank_id', 'like', '%' . $criteria . '%')
                    ->orwhere('bank_account', 'like', '%' . $criteria . '%')
                    ->orwhere('bank_name', 'like', '%' . $criteria . '%')
                    ->orderBy('id');
            $result = ($paging) ? $banks->paginate($this->paging) : $banks;
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

            $chk = TblBank::where('bank_id', $id)->first();
            $curObj = $chk ? $chk : new TblBank;
            if (array_key_exists('bank_id', $data))
                $curObj->bank_id = $data['bank_id'];
            if (array_key_exists('bank_name', $data))
                $curObj->bank_name = $data['bank_name'];
            if (array_key_exists('bank_account', $data))
                $curObj->bank_account = $data['bank_account'];
            if (array_key_exists('bank_fee', $data))
                $curObj->bank_fee = $data['bank_fee'];
            if (array_key_exists('bank_logo', $data))
                $curObj->bank_logo = $data['bank_logo'];


            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function delete($id) {
        $result = false;
        try {
            $result = TblBank::where('id', $id)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

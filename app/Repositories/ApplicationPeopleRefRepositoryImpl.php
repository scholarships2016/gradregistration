<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationPeopleRefRepository;
use App\Models\ApplicationPeopleRef;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ApplicationPeopleRefRepositoryImpl extends AbstractRepositoryImpl implements ApplicationPeopleRefRepository {

    protected $ApplicationPeopleRefRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(ApplicationPeopleRef::class);
    }

    public function getDetail($appID) {
        $result = null;
        try {
            $result = ApplicationPeopleRef::where('application_id', $appID)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save($data) {
        $result = false;
        try {
            $id = null;
            if (array_key_exists('app_people_id', $data) || !empty($data['app_people_id']))
                $id = $data['app_people_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new ApplicationPeopleRef;
            if (array_key_exists('application_id ', $data))
                $curObj->application_id = $data['application_id '];
            if (array_key_exists('app_people_name ', $data))
                $curObj->app_people_name = $data['app_people_name '];
            if (array_key_exists('app_people_phone ', $data))
                $curObj->app_people_phone = $data['app_people_phone '];
            if (array_key_exists('app_people_address', $data))
                $curObj->app_people_address = $data['app_people_address '];
            if (array_key_exists('app_people_position ', $data))
                $curObj->app_people_position = $data['app_people_position '];

            $result = $curObj->save();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

}

<?php

namespace App\Repositories;

use App\Repositories\Contracts\ApplicationPeopleRefRepository;
use App\Models\ApplicationPeopleRef;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApplicationPeopleRefRepositoryImpl extends AbstractRepositoryImpl implements ApplicationPeopleRefRepository
{

    protected $ApplicationPeopleRefRepo;
    private $paging = 10;
    private $controllors;

    public function __construct(Controller $controllors)
    {
        parent::setModelClassName(ApplicationPeopleRef::class);
        $this->controllors = $controllors;
    }

    public function getDetail($appID)
    {
        $result = null;
        try {
            DB::statement(DB::raw('set @rownum=0'));
            $result = DB::table('application_people_ref')
                ->select(DB::raw('application_people_ref.*, @rownum := @rownum + 1  AS RowNum'))
                ->where('application_id', $appID)->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function save($data)
    {
        $result = false;
        try {
            $id = null;
            if (array_key_exists('app_people_id', $data) || !empty($data['app_people_id']))
                $id = $data['app_people_id'];

            $chk = $this->find($id);
            $curObj = $chk ? $chk : new ApplicationPeopleRef;
            if (array_key_exists('application_id', $data))
                $curObj->application_id = $data['application_id'];
            if (array_key_exists('app_people_name', $data))
                $curObj->app_people_name = $data['app_people_name'];
            if (array_key_exists('app_people_phone', $data))
                $curObj->app_people_phone = $data['app_people_phone'];
            if (array_key_exists('app_people_address', $data))
                $curObj->app_people_address = $data['app_people_address'];
            if (array_key_exists('app_people_position', $data))
                $curObj->app_people_position = $data['app_people_position'];
            $this->controllors->WLog('Save People Reference [Application id:' . $data['application_id'] . ']', 'Enroll', null);
            $result = $curObj->save();
        } catch (\Exception $ex) {
            $this->controllors->WLog('Save People Reference Error', 'Enroll', $ex->getMessage());
            throw $ex;
        }
        return $result;
    }

    public function deleteByApplicationId($applicationId)
    {
        try {
            return ApplicationPeopleRef::where('application_id', '=', $applicationId)->delete();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

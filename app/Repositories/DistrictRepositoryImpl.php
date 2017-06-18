<?php
/**
 * Created by PhpStorm.
 * User: worakanpongnumkul
 * Date: 5/4/2017 AD
 * Time: 10:55 AM
 */

namespace App\Repositories;


use App\Models\Districts;
use App\Repositories\Contracts\DistrictRepository;

class DistrictRepositoryImpl extends AbstractRepositoryImpl implements DistrictRepository
{

    public function __construct()
    {
        parent::setModelClassName(Districts::class);
    }

    public function findDistrictByCriteria($criteria)
    {
        // TODO: Implement findDistrictByCriteria() method.
    }

    public function getDistrictByProvinceId($id)
    {

        $district = null;
        try {
            $district = Districts::where('province_id', $id)->get();
        } catch (\Exception $ex) {
            throw  $ex;
        }
        return $district;
    }

}
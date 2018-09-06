<?php

namespace App\Repositories;

use App\Repositories\Contracts\DegreeRepository;
use App\Models\TblDegree;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class DegreeRepositoryImpl extends AbstractRepositoryImpl implements DegreeRepository
{

    private $paging = 10;

    public function __construct()
    {
        parent::setModelClassName(TblDegree::class);
    }

    public function getById($id)
    {
        $result = null;
        try {
            $result = TblDegree::where('degree_id', $id)->first();
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $result;
    }

    public function searchByCriteria($criteria = null, $paging = false)
    {
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

    public function save(array $data)
    {
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

    public function delete($id)
    {
        $result = false;
        try {
            $result = TblDegree::where('degree_id', $id)->delete();
            return $result;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getAllDegreeForDropdown()
    {
        try {
            $query = DB::table('tbl_degree')
                ->select('degree_id', 'degree_name', 'degree_name_en',
                    DB::raw("concat(degree_name,' (',degree_name_en,')') as degree_name_full"));
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getDegreeByMajorIdForDropdown($majorId, $is_active='')
    {
        try {
            $query = DB::table('tbl_major as ma')
                ->select('de.degree_id', 'de.degree_name', 'de.degree_name_en',
                    DB::raw("concat(de.degree_name,' (',de.degree_name_en,')') as degree_name_full")
                )->join('mcoursestudy as m', function ($join) {
                    $join->on('m.majorcode', '=', 'ma.major_id')
                      ->whereRaw("(m.stopacadyear='' || m.stopacadyear is NULL) && (m.lastacadyear ='' || m.lastacadyear is NULL) ");
                })->join('tbl_degree as de', function ($join) {
                    $join->on('de.degree_id', '=', 'm.degree');
                })->groupBy('de.degree_id', 'de.degree_name', 'de.degree_name_en');
            if (!empty($majorId)) {
                $query->where('ma.major_id', '=', $majorId);
            }
            if (!empty($is_active)) {
              $query->where('ma.is_active', '=', $is_active);
            }
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}

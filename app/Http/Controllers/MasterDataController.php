<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\DistrictRepository;
use App\Repositories\Contracts\EngTestRepository;
use App\Repositories\Contracts\NameTitleRepository;
use App\Repositories\Contracts\NationRepository;
use App\Repositories\Contracts\NewsSourceRepository;
use App\Repositories\Contracts\ProvinceRepository;
use App\Utils\Util;
use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    protected $districtRepo;
    protected $provinceRepo;
    protected $engTestRepo;
    protected $nationRepo;
    protected $nameTitleRepo;
    protected $newSrcRepo;

    /**
     * MasterDataController constructor.
     */
    public function __construct(DistrictRepository $districtRepo, ProvinceRepository $provinceRepo,
                                EngTestRepository $engTestRepo, NationRepository $nationRepo,
                                NameTitleRepository $nameTitleRepo, NewsSourceRepository $newSrcRepo)
    {
        $this->districtRepo = $districtRepo;
        $this->provinceRepo = $provinceRepo;
        $this->engTestRepo = $engTestRepo;
        $this->nationRepo = $nationRepo;
        $this->nameTitleRepo = $nameTitleRepo;
        $this->newSrcRepo = $newSrcRepo;
    }

    public function getDistrictByProvinceIdForDropdown(Request $request)
    {
        if ($request->ajax()) {
            $param = $request->all();
            try {
                if (array_key_exists('province_id', $param)) {
                    $result = Util::prepareDataForDropdownList($this->districtRepo->getDistrictByProvinceId($param['province_id']), 'district_id', 'district_name');
                    return response()->json($result);
                }
            } catch (\Exception $ex) {
                return null;
            }
        }
        return null;
    }
}

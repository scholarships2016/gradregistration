<?php

namespace App\Repositories;

use App\Repositories\Contracts\FacultyRepository;
use App\Models\TblFaculty;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacultyRepositoryImpl extends AbstractRepositoryImpl implements FacultyRepository {

    protected $facultyPassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblFaculty::class);
    }

    public function getAllFacultyForDropdown()
    {
        Log::info('getAllFacultyForDropdown');

        try {
            $query = DB::table('tbl_faculty as fac')
                ->select('fac.faculty_id',
                    DB::raw('concat(fac.faculty_name," (",fac.faculty_full,")") as faculty_full'));
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }


}

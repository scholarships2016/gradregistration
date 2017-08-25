<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProgramTypeRepository;
use App\Models\TblProgramType;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;

class ProgramTypeRepositoryImpl extends AbstractRepositoryImpl implements ProgramTypeRepository {

    protected $ProgramTypePassRepo;
    private $paging = 10;

    public function __construct() {
        parent::setModelClassName(TblProgramType::class);
    }

    public function getAllProgramTypeForDropdown()
    {
        try {
            $query = DB::table('tbl_program_type as pt')
                ->select("pt.program_type_id", DB::raw("concat(pt.prog_type_name,' (',pt.cond_id,')') as prog_type_name"))
                ->where('cond_id', '!=', '0');
            return $query->get();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}

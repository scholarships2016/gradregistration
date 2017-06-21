<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblNation;

class NationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
//
        $this->show(null);
    }

    public function create() {
//
    }

    public function show($id = null) {
//        $nations = DB::table('tbl_nation')->get();

        $nations = TblNation::where(function($query)use($id) {
                    $query->whereRaw('nation_id = "' . $id . '"or "' . $id . '" = ""');
                })->paginate(10);
        return view('nation', ['nations' => $nations]);
    }

    public function delete($id) {
        TblNation::where('nation_id', $id)->delete();
    }

    public function update(Request $request, $id) {
        $data = ['nation_name' => 'กัมพูชาs',
            'nation_name_en' => 'Cambodiass'];
        
                TblNation::where('nation_id', $id)->update($data);
                 
            
    }

}

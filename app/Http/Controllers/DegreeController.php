<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblDegree;
use App\Repositories\DegreeRepositoryImpl;

class DegreeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $part_doc = "master.degree.";
    protected $degreeRepo;

    public function __construct(DegreeRepositoryImpl $degreeRepo) {
        $this->degreeRepo = $degreeRepo;
    }

    public function index() {
        $this->show(null);
    }

    public function show(Request $request) {
        $qserch = ($request != null) ? $request->txtSearhc : null;
        $degrees = $this->degreeRepo->searchByCriteria($qserch, TRUE);
        return view($this->part_doc . 'degree', ['degrees' => $degrees]);
    }

    public function getForm($id = 0) {
        if ($id != 0) {
            $degree = $this->degreeRepo->getById($id);
            if (!$degree)
                return redirect('degree/degree_form');
        }else {
            $degree = false;
        }
        return view($this->part_doc . 'degree_form', ['degree' => $degree], ['id' => $id]);
    }

    public function postForm(Request $data) {
        $this->degreeRepo->save($data->all());
        return redirect('degree');
    }

    public function delete($id) {
        $this->degreeRepo->delete($id);
        return redirect('degree');
    }

}

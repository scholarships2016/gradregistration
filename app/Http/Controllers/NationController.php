<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NationRepositoryImpl;

class NationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $part_doc = "master.nation.";
    protected $nationRepo;
    public function __construct(NationRepositoryImpl $nationRepo){
        $this->nationRepo = $nationRepo;
    }

    public function index() {
        $this->show(null);
    }

    public function show(Request $request) {
        $qserch = ($request != null) ? $request->txtSearhc : null;
        $nations = $this->nationRepo->searchByCriteria($qserch,TRUE);
        return view($this->part_doc . 'nation', ['nations' => $nations]);
    }

    public function getForm($id = 0) {
        if ($id != 0) {
            $nation = $this->nationRepo->getById($id);
            if (!$nation)
                return redirect('nation/nation_form');
        }else {
            $nation = false;
        }
        return view($this->part_doc . 'nation_form', ['nation' => $nation], ['id' => $id]);
    }

    public function postForm(Request $data) {
        $this->nationRepo->save($data->all());
        return redirect('nation');
    }

    public function delete($id) {
        $this->nationRepo->delete($id);
        return redirect('nation');
    }

}

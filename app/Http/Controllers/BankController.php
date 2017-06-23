<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\TblBank;
use App\Repositories\BankRepositoryImpl;

class BankController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $paging = 10;
    private $part_doc = "master.bank.";
    protected $bankRepo;

    public function __construct(BankRepositoryImpl $bankRepo) {
        $this->bankRepo = $bankRepo;
    }

    public function index() {
        $this->show(null);
    }

    public function show(Request $request) {
        $qserch = ($request != null) ? $request->txtSearhc : null;
        $banks = $this->bankRepo->searchByCriteria($qserch, TRUE);
        return view($this->part_doc . 'bank', ['banks' => $banks]);
    }

    public function getForm($id = 0) {
        if ($id != 0) {
            $bank = $this->bankRepo->getById($id);
            if (!$bank)
                return redirect('bank/bank_form');
        }else {
            $bank = false;
        }
        return view($this->part_doc . 'bank_form', ['bank' => $bank], ['id' => $id]);
    }

    public function postForm(Request $data) {
        $this->bankRepo->save($data->all());
        return redirect('bank');
    }

    public function delete($id) {
        $this->bankRepo->delete($id);
        return redirect('bank');
    }

}

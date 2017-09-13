<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\NewsRepositoryImpl;
use App\Repositories\ApplicationRepositoryImpl;
use App\Repositories\ApplySettingRepositoryImpl;

class HomeController extends Controller {

    protected $NewsRepo;
    protected $ApplicationRepo;
    protected $ApplySettingRepo;

    public function __construct(NewsRepositoryImpl $NewsRepo, ApplicationRepositoryImpl $ApplicationRepo, ApplySettingRepositoryImpl $ApplySetting) {
//        $this->middleware('auth');
        $this->NewsRepo = $NewsRepo;
        $this->ApplicationRepo = $ApplicationRepo;
        $this->ApplySettingRepo = $ApplySetting;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return $this->viewHome();
    }

    public function showRegisHead() {
        if (session('Applicant')) {
            $countStatus = $this->ApplicationRepo->getDatacountByStatusUse(session('Applicant')->applicant_id);

            $val = '';
            $cval = 0;
            foreach ($countStatus as $cStatus) {
                $val .= ' <li> ';
                $val .= ' <a href="' . url('application/manageMyCourse') . '"> ';
                $val .= '  <span class="time">' . $cStatus->numc . '</span> ';
                $val .= '  <span class="details"> ';
                $val .= '  <span class="label label-sm label-icon label-success"> ';
                $val .= '  <i class="fa fa-bell-o"></i> ';
                $val .= '  </span> ' . ((session('locale') == 'th') ? $cStatus->flow_name : $cStatus->flow_name_en) . ' </ span> ';
                $val .= '  </a> ';
                $val .= '  </li>  ';
                $cval += $cStatus->numc;
            }


            return ['val' => $val, 'cot' => $cval];
        }
    }

    public function viewHome() {
        if (!session('locale'))
            session()->put('locale', 'th');


        if (!session('locale'))  session()->put('locale', 'th');       
        
        $Newslist = $this->NewsRepo->getNewsNow();
        $Apply = $this->ApplySettingRepo->getApplySettingNow();
        return view('home', ['NewsList' => $Newslist, 'Applys' => $Apply]);
    }

}

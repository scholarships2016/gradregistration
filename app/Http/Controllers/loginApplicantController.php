<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\NameTitleRepository;
use Illuminate\Support\Facades\Mail;

class LoginApplicantController extends Controller {

    protected $loginapplicantRepo;
    protected $nametitleRepo;

    public function __construct(ApplicantRepository $loginapplicantRepo, NameTitleRepository $nametitleRepo) {
        $this->loginapplicantRepo = $loginapplicantRepo;
        $this->nametitleRepo = $nametitleRepo;
    }

    public function showLoginPage(Request $request) {
        $titles = $this->nametitleRepo->getAll();
        return view('loginApplicant', ['titles' => $titles]);
    }

    public function postLogin(Request $request) {
        $result = $this->loginapplicantRepo->checkLogin($request);
        if ($result) {
            session()->flash('successMsg', 'ยินดีต้อนรับเข้าสู่ระบบ');
            return view('test', ['test' => $result]);
        } else {
            session()->flash('errorMsg', 'ไม่สามารถเข้าสู่ระบบได้กรุณาตรวจสอบ e-mail หรือ password');
            return view('loginApplicant');
        }
    }

    public function reLogin(Request $request) {
        $result = $this->loginapplicantRepo->getByCitizenOrEmail('', $request->stu_email);
        if ($result) {
            $message = "testssss";
            Mail::send('test', array('key' => 'value'), function($message) {
                $message->to('pacusm128@gmail.com', 'John Smith')->subject('Welcome!');
            });
            session()->flash('successMsg', 'ตรวจสอบ e-mail เพื่อทำการ Re-password.');
            return view('loginApplicant');
        } else {
            session()->flash('errorMsg', 'ไม่สามารถเข้าสู่ระบบได้กรุณาตรวจสอบ e-mail หรือ password');
            return view('loginApplicant');
        }
    }

    public function register(request $request) {
        
    }

}

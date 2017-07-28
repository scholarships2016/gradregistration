<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ApplicantRepository;
use App\Repositories\Contracts\NameTitleRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Utils\ChangeLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use \Illuminate\Support\Facades\Crypt;

class LoginApplicantController extends Controller {

    protected $redirectTo = '/seller_home';

    use AuthenticatesUsers;

    protected $loginapplicantRepo;
    protected $nametitleRepo;

    public function __construct(ApplicantRepository $loginapplicantRepo, NameTitleRepository $nametitleRepo) {
        $this->loginapplicantRepo = $loginapplicantRepo;
        $this->nametitleRepo = $nametitleRepo;
    }

    //Authen
    protected function guard() {
        return Auth::guard('web');
    }

    public function showLoginForm() {
        $titles = $this->nametitleRepo->getAll();
        return view('auth.loginApplicant', ['titles' => $titles]);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'stu_email' => 'required|max:255|unique:users',
                    'stu_password' => 'required|confirmed|min:6',
        ]);
    }

    public function language(Request $request) {
        $changeLocale = new ChangeLocale($request->input('lang'));
        $this->dispatch($changeLocale);
        return redirect()->back();
    }

    public function showLoginPage(Request $request) {
        $titles = $this->nametitleRepo->getAll();
        return view('loginApplicant', ['titles' => $titles]);
    }

    public function postLogin(Request $request) {
        if (Auth::attempt(['stu_email' => $request->stu_email, 'password' => $request->stu_password])) {
            $user_data = Auth::user();
            session()->put('user_id', $user_data->applicant_id);
            session()->put('first_name', $user_data->stu_first_name);
            session()->put('last_name', $user_data->stu_last_name);
            session()->put('email_address', $user_data->stu_email);
            
            $app = new \stdClass();
            $app->applicant_id= $user_data->applicant_id;
            $app->stu_citizen_card=$user_data->stu_citizen_card;
            $app->stu_email=$user_data->stu_email;            
            session()->put('Applicant',$app);
            Controller::WLog('User Applicant Login['.$user_data->applicant_id.']', 'User_Login', null);
           
            session()->flash('successMsg', Lang::get('resource.lbWelcome') . $user_data->stu_first_name . ' ' . $user_data->stu_last_name);
            return redirect('/home');
        } else {
            Controller::WLog('User Applicant Not Login', 'User_Login', null);
            session()->flash('errorMsg', Lang::get('resource.lbCannotLogin'));
            return redirect('login');
        }
    }

    public function getLogout() {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }

    public function reLogin(Request $request) {
        $result = $this->loginapplicantRepo->getByCitizenOrEmail('', $request->stu_email);
        if ($result) {

            $random_pass = str_random(8);
            $update_pass = ['applicant_id' => $result->applicant_id, 'stu_password' => $random_pass];
            $this->loginapplicantRepo->saveApplicant($update_pass);
            $data = [
                'stu_name' => $result->stu_first_name . ' ' . $result->stu_last_name,
                'stu_password' => $random_pass,
                'email' => $result->stu_email
            ];
            Mail::send('email.rePassword', $data, function($message)use ($result) {
                $message->to($result->stu_email, $result->stu_first_name)->subject('Your new password!');
            });
            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return redirect('login');
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function register(request $request) {

        if (count($this->loginapplicantRepo->getByCitizenOrEmail($request->stu_citizen_card, $request->stu_email)) == 0) {
            $result = $this->loginapplicantRepo->saveApplicant($request->all());
            if ($result) {
                session()->flash('successMsg',Lang::get('resource.lbSuccess'));
                return redirect('login');
            } else {
                session()->flash('errorMsg', 'ไม่สามารถใช้งาน Email หรือ รหัสบัตรประชาชน/passport นี้ได้เนื่องจากมีการใช้งาน');
                return back();
            }
        } else {
            session()->flash('errorMsg', 'ไม่สามารถใช้งาน Email หรือ รหัสบัตรประชาชน/passport นี้ได้เนื่องจากมีการใช้งาน');
            return back();
        }
    }

}

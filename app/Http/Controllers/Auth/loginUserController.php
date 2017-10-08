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
use App\Repositories\UserRepositoryImpl;
use GuzzleHttp\Client;

class LoginUserController extends Controller {

    protected $redirectTo = '/seller_home';

    use AuthenticatesUsers;

    protected $loginapplicantRepo;
    protected $nametitleRepo;
    protected $userRepo;
    protected $ClientRepo;

    public function __construct(ApplicantRepository $loginapplicantRepo, NameTitleRepository $nametitleRepo, UserRepositoryImpl $userRepo, Client $ClientRepo) {
        $this->loginapplicantRepo = $loginapplicantRepo;
        $this->nametitleRepo = $nametitleRepo;
        $this->userRepo = $userRepo;
        $this->ClientRepo = $ClientRepo;

        Auth::setDefaultDriver('admins');
    }

    //Authen
    protected function guard() {
        return Auth::guard('admins');
    }

    public function showLoginForm() {

        return view('auth.loginApplicant_admin');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
                    'user_name' => 'required|max:255|unique:users',
                    'user_password' => 'required|confirmed|min:6',
        ]);
    }

    public function checkuserldap($username, $password) {

        if ($username != 'administrator' && $username != 'facultystaff' && $username != 'gradstaff') {

            $url = 'https://ethesis.grad.chula.ac.th/ldap/authen/get_account.php';
            $key = md5("1d@p-{$username}{$password}");
            $data = array('user' => "{$username}", 'pass' => "$password", 'key' => "{$key}");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $result = curl_exec($ch);
            curl_close($ch);
            $json = json_decode($result);

            if (isset($json->{'status'}) && $json->{'status'} === false) {
                //Invalid Username or Password
                return false;
            } else {
                //Authenticate Successed
                $user_id = $json->{'0'}->{'uid'}->{'0'};
                $firstname_th = $json->{'0'}->{'thcn'}->{'0'};
                $surname_th = $json->{'0'}->{'thsn'}->{'0'};
                $fullname_en = $json->{'0'}->{'cn'}->{'0'};
                $firstname_en = $json->{'0'}->{'givenname'}->{'0'};
                $surname_en = $json->{'0'}->{'sn'}->{'0'};
                $email = $json->{'0'}->{'mail'}->{'0'};
                $citizen_id = $json->{'0'}->{'pplid'}->{'0'};
                session()->put('fullname_en', $fullname_en);

                /* Start update fullname to USER Table */

                return true;
            }
        } else {
            return true;
        }
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
        if ($this->checkuserldap($request->user_name, $request->user_password)) {
            $pas = (($request->user_name != 'administrator' && $request->user_name != 'facultystaff' && $request->user_name != 'gradstaff')? "p@ssw0rd" : $request->user_password);
            if (Auth::attempt(['user_name' => $request->user_name, 'password' => $pas])) {
                $user_data = Auth::user();
                $pic = null;
                if ($user_data->stu_img) {
                    $pic = $this->FileRepo->getImageFileAsBase64ById($user_data->stu_img);
                }
                session()->put('user_name', ($user_data->user_name != "" ? $user_data->user_name : $user_data->user_id));
                session()->put('user_id', $user_data->user_id);
                session()->put('first_name', session('fullname_en'));
                session()->put('last_name', '');
                session()->put('email_address', $user_data->user_name);
                session()->put('stu_img', $pic);
                $role = null;
                if (!empty($user_data->role) && $user_data->role->role_id == 1) {
                    $role = array("user_role" => $user_data->role->role_id, "user_type" => "Admin");
                } else if (!empty($user_data->role) && $user_data->role->role_id == 2) {
                    $role = array("user_role" => $user_data->role->role_id, "user_type" => "GradStaff");
                } else if (!empty($user_data->role) && $user_data->role->role_id == 3) {
                    $role = array("user_role" => $user_data->role->role_id, "user_type" => "FacStaff");
                }
                session()->put('user_type', (object) $role);
                session()->put('locale', 'th');
                $permMap = array();
                foreach ($user_data->userPermission as $index => $value) {
                    array_push($permMap, $value->permission_id);
                }
                session()->put('user_permission', $permMap);
//            $app = new \stdClass();
//            $app->applicant_id = 1;
//            $app->stu_citizen_card = '123456789';
//            $app->stu_email = 'pacusm128@gmail.com';
//            $app->nation_id = 1;
//            session()->put('Applicant', $app);
                $datenow = \Carbon\Carbon::now();
                $this->userRepo->save(['user_id' => $user_data->user_id, 'name' => session('fullname_en'), 'last_login' => $datenow, 'ipaddress' => $_SERVER['REMOTE_ADDR']]);
                Controller::WLog('Staff Login[' . $user_data->user_name . ']', 'Staff_Login', null);
                session()->flash('successMsg', Lang::get('resource.lbWelcome') . $user_data->user_name);
                return redirect('/admin/toDoList');
            } else {
                Controller::WLog('Staff Not Login', 'Staff_Login', null);
                session()->flash('errorMsg', Lang::get('resource.lbCannotLogin'));
                return redirect('admin/login');
            }
        } else {
            session()->flash('errorMsg', Lang::get('resource.lbCannotLogin'));
            return redirect('admin/login');
        }
    }

    public function getLogout() {
        Auth::logout();
        Controller::WLog('User Logout[' . session('email_address') . ']', 'User_Logout', null);

        session()->flush('successMsg', 'LogOut');
        return redirect('admin/login');
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
            Mail::send('email.rePassword', $data, function ($message) use ($result) {
                $message->to($result->stu_email, $result->stu_first_name)->subject('Your new password!');
            });
            Controller::WLog('User Re-password[' . $result->stu_email . ']', 'User_Login', null);

            session()->flash('successMsg', Lang::get('resource.lbSuccess'));
            return redirect('login');
        } else {
            Controller::WLog('User can not Re-password not User', 'User_Login', null);
            session()->flash('errorMsg', Lang::get('resource.lbError'));
            return back();
        }
    }

    public function register(request $request) {

        if (count($this->loginapplicantRepo->getByCitizenOrEmail($request->stu_citizen_card, $request->stu_email)) == 0) {
            $result = $this->loginapplicantRepo->saveApplicant($request->all());
            if ($result) {
                Controller::WLog('User Register[' . $request->stu_email . ']', 'User_Login', null);

                session()->flash('successMsg', Lang::get('resource.lbSuccess'));
                return redirect('login');
            } else {
                Controller::WLog('User cannot register, Email or citizen are in the system.', 'User_Login', null);
                session()->flash('errorMsg', 'ไม่สามารถใช้งาน Email หรือ รหัสบัตรประชาชน/passport นี้ได้เนื่องจากมีการใช้งาน');
                return back();
            }
        } else {
            Controller::WLog('User cannot register, Email or citizen are in the system.', 'User_Login', null);

            session()->flash('errorMsg', 'ไม่สามารถใช้งาน Email หรือ รหัสบัตรประชาชน/passport นี้ได้เนื่องจากมีการใช้งาน');
            return back();
        }
    }

}

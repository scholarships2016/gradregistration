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

    public function get_account_ldap($user, $pass){

    	$ldaphost = "ldapgw.it.chula.ac.th";  // ldap servers
      $ldaphosts = "ldaps://ldapgw.it.chula.ac.th:636";
    	$ldaptree  = "dc=chula,dc=ac,dc=th";  // ldap tree search



    	// Connecting to LDAP
    	$ldapconn = ldap_connect($ldaphosts) or die("Could not connect to $ldaphosts");
      ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

      if(!ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3)){
      print "Could not set LDAPv3\r\n";
      }


    	$result = ldap_search($ldapconn, $ldaptree, "(uid=".$user.")")
    				or die ("Error in search query: ".ldap_error($ldapconn));
    	$count = ldap_count_entries($ldapconn, $result);
    	if ($count != 1) {
    		return NULL;
    	} else {
    		$data = ldap_get_entries($ldapconn, $result);
    		$dn = (isset($data[0]["dn"])?$data[0]["dn"]:false);

    		// try to bindling with dn
    		if($dn !== false){
    			// verify binding
    			$bind = ldap_bind($ldapconn, $dn, $pass);
    			if ($bind) {
    				return $data;
    			} else {
    				return false;
    			}
    		}else{
    			return false;
    		}
    	}
    }

    public function checkuserldap($username, $password) {

        if ($username != 'administrator' && $username != 'facultystaff' && $username != 'gradstaff') {

            $json = $this->get_account_ldap($username, $password);

             if (strtolower($json[0]['uid'][0])==  strtolower($username)) {

               //Login Successed
               $user_id = $json[0]['uid'][0];
               $firstname_th = $json[0]['thcn'][0];
               $surname_th = $json[0]['thsn'][0];
               $fullname_en = $json[0]['cn'][0];
               $firstname_en = $json[0]['givenname'][0];
               $surname_en = $json[0]['sn'][0];
               $email = $json[0]['mail'][0];
               $email_option = $json[0]['miforwardingaddress'][0];
               $citizen_id = $json[0]['pplid'][0];

               session()->put('fullname_en', $fullname_en);
               /* Start update fullname to USER Table */

               return true;
             }else{
               //Login Failed
               return false;
             }

        } else {
            return true;
        }
    }
    public function checkuserldapViaGateWay($username, $password) {

        if ($username != 'administrator' && $username != 'facultystaff' && $username != 'gradstaff') {

          //API URL
          $url = 'http://161.200.133.13/ldap/get_account.php';
          $key = md5("Register.Gradchula.C0M!-{$username}");
          $password = $this->encryptIt($password, md5("!C0M.GradChula.Register-{$username}-iChok1046"));
          $data = array('username' => "{$username}", 'password' => "{$password}", 'key' => "{$key}");

           $data_string = json_encode($data);

           $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            // Will return the response, if false it print the response
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                               'Content-Type: application/json',
                           'Content-Length: ' . strlen($data_string))
             );
            $result = curl_exec($ch);
            curl_close($ch);

            $json = json_decode($result);



             if ($json !="NULL" && $json != "false" && $json != null && $json !=false && strtolower($json->{'user_id'})==  strtolower($username)) {

               //Login Successed
               $user_id = $json->{'user_id'};
               $firstname_th = $json->{'firstname_th'};
               $surname_th = $json->{'surname_th'};
               $fullname_en = $json->{'fullname_en'};
               $firstname_en = $json->{'firstname_en'};
               $surname_en = $json->{'surname_en'};
               $email = $json->{'email'};
               $citizen_id = $json->{'citizen_id'};

               session()->put('fullname_en', $fullname_en);
			   session()->put('email', $email);
               /* Start update fullname to USER Table */

               return true;
             }else{
               //Login Failed
               return false;
             }

        } else {
            return true;
        }
    }

    public function checkuserldap_backup($username, $password) {

        if ($username != 'administrator' && $username != 'facultystaff' && $username != 'gradstaff') {

            //$url = 'https://ethesis.grad.chula.ac.th/ldap/authen/get_account.php';
            $url = 'http://161.200.133.13/ldap/get_account.php';
            $key = md5("1d@p-{$username}{$password}");
            $data = array('username' => "{$username}", 'password' => "$password", 'key' => "{$key}");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $result = curl_exec($ch);
            curl_close($ch);
            print_r($result);
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
    public function encryptIt( $q , $cryptKey) {
        //$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    public function decryptIt( $q ,$cryptKey) {
        ///$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
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
        if ($this->checkuserldapViaGateWay($request->user_name, $request->user_password)) {
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
                session()->put('email_address', $user_data->user_email);
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

				$user_email = ($user_data->user_email != "" ? $user_data->user_email : session('email'));
		
				
                $datenow = \Carbon\Carbon::now();
                $this->userRepo->save(['user_id' => $user_data->user_id, 'user_email' => $user_email, 'name' => session('fullname_en'), 'last_login' => $datenow, 'ipaddress' => $_SERVER['REMOTE_ADDR']]);
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

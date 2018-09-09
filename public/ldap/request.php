<?PHP 

function get_account($username, $password){
//API URL
$url = 'http://161.200.133.13/ldap/get_account.php';
$key = md5("Register.Gradchula.C0M!-{$username}");
$password = encryptIt($password, md5("!C0M.GradChula.Register-{$username}-iChok1046"));
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

  print_r($result);
  $json = json_decode($result);
  
  if($json !="NULL" && $json != "false" && $json != null && $json !=false){
	  print "login success";
  }else{
	  print "login failed";
  }
  //print_r($json);
  $user_id = $json->{'user_id'}; 
$firstname_th = $json->{'firstname_th'};
$surname_th = $json->{'surname_th'};
$fullname_en = $json->{'fullname_en'};
$firstname_en = $json->{'firstname_en'};
$surname_en = $json->{'surname_en'};
$email = $json->{'email'};
$citizen_id = $json->{'citizen_id'};

}
function encryptIt( $q , $cryptKey) {
    //$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ,$cryptKey) {
    ///$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}



//get_account('cccc','ccc');

 ?>


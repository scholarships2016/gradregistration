<?PHP 
//$origin = $_SERVER['HTTP_ORIGIN'];
/*
$origin = $_SERVER['HTTP_ORIGIN'];
$allowed_domains = [
    'https://www.register.gradchula.com',
    'https://register.gradchula.com',
    'http://127.0.0.1/ldap/request.php'
];

if (in_array($origin, $allowed_domains)) {
    header('Access-Control-Allow-Origin: ' . $origin);
}
*/


header('Access-Control-Allow-Origin: https://www.register.gradchula.com');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");


$rawdata = json_decode(file_get_contents('php://input'), true);
$username = $rawdata['username'];
$request_key = $rawdata['key'];
$password = decryptIt($rawdata['password'], md5("!C0M.GradChula.Register-{$username}-iChok1046"));


$response_key = md5("Register.Gradchula.C0M!-{$username}");
//$fp = fopen('php://input', 'r');
//$rawData = stream_get_contents($fp);

 //echo "<pre>";
 //print_r($rawData);
 //echo "</pre>";

 if($request_key === $response_key){
 
 	$ldaphost = "ldap1.it.chula.ac.th";  // ldap servers
	$ldaptree  = 'dc=chula,dc=ac,dc=th';  // ldap tree search

	// Connecting to LDAP
	$ldapconn = ldap_connect($ldaphost) or die("Could not connect to $ldaphost");

	$result = ldap_search($ldapconn, $ldaptree, "(uid=".$username.")") 
				or die ("Error in search query: ".ldap_error($ldapconn));
	$count = ldap_count_entries($ldapconn, $result);
	if ($count != 1) {
		logWrite("username={$username}, password=xxx : Result -> NULL");
		print 'NULL';	
	} else {
		$data = ldap_get_entries($ldapconn, $result);
		$dn = (isset($data[0]["dn"])?$data[0]["dn"]:false);

		// try to bindling with dn
		if($dn !== false){
			// verify binding
			$bind = ldap_bind($ldapconn, $dn, $password);
			if ($bind) {	
			$array = array(
					"user_id" => $data[0]['uid'][0],
					"firstname_th" => '',
					"surname_th" => '',
					"fullname_en" => $data[0]['cn'][0],
					"firstname_en" => $data[0]['givenname'][0],
					"surname_en" => $data[0]['sn'][0],
					"email" => $data[0]['mail'][0],	
					"citizen_id" =>  $data[0]['pplid'][0]
				  );
				  /*
				$array = array(
					"user_id" => $data[0]['uid'][0],
					"firstname_th" => $data[0]['thcn'][0],
					"surname_th" => $data[0]['thsn'][0],
					"fullname_en" => $data[0]['cn'][0],
					"firstname_en" => $data[0]['givenname'][0],
					"surname_en" => $data[0]['sn'][0],
					"email" => $data[0]['mail'][0],	
					"citizen_id" =>  $data[0]['pplid'][0]
				  );		
				  */
				  logWrite("username={$username}, password=xxx : Result -> SUCCESS");
               	echo json_encode($array);		
				//print_r($array);								
			} else {
				logWrite("username={$username}, password=xxx : Result -> false");
				print 'false';			
			}
		}else{
			logWrite("username={$username}, password=xxx : Result -> false");
			print 'false';	
		}
		
	}
 }else{
	 logWrite("username={$username}, password=xxx : Result -> false");
	 print 'false';
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
function logWrite($messages){
$file = 'logs/login-transaction.log';
// The new person to add to the file
$dateTime=date("Y-m-d H:i:s");
$ip= $_SERVER['REMOTE_ADDR'];
$messages = $dateTime ." ".$ip . " ".$messages . "\n";
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
//file_put_contents($file, $messages, FILE_APPEND | LOCK_EX);
file_put_contents($file, $messages, FILE_APPEND);
}

?>
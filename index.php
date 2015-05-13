<?php 
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using defne.
define('clientID', '65d48edbb16143519b7096a59f69549c');
define('clientSecret', '18caa1e571844a76adf811a0d6e9b0fa');
define('redirectURI', 'http://localhost/apiproject/index.php');
define('ImageDirectory', 'pics/');

if (isset($_GET['code'])){
	$code = ($_GET['code']);
	$url = 'https://api.instagrm.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
																	'client_secret' => clientSecret,
																	'grant_type' => 'authorize_code',
																	'redirect_uri' => redirectURI,
																	'code' => $code
																	);
//cURL is what we use in PHP, it's a library calls to other API's
$curl = curl_init($url); // setting a cURL session and we put in cURL because that's where we are gettting the data from.
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings);// setting the POSTFIELD to the array setup that we create.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);// setting it equal to 1 because we are getting strings back.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//but in live work-production we want to set it to true.

$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);

}
else{
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<body>
<!-- Creating a login for people to go and give approval for our web app to acess their Intasgram their Instagram Account
After getting approval we are now going to have the information so that we can play with it.
 -->
		<a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI?>&response_type=code">Login</a>
	</body>
</html>
<?php
}
?>
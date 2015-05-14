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

//function that is going to connect to Instagram.
function connectToInstagram($url){
		$ch = curl_init();

		curl_setopt_array($ch, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => 2,
		));
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
}
//function to get userID cause username doesn't allow us to get pictures!
function getUserID($userName){
	$url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;//to get id
	$instagramInfo = connectToInstagram($url);//connecting to Instagram.
	$results = json_decode($instagramInfo, true);//creating out userID.

	return $results['data']['0']['id'];//echoing out userID.
}
//function to print out images onto screen
function printImages($userID){
		$url = 'https://api.instagram.com/v1/users/'.$userID.'/media/recent?client_id='.clientID.'&count=5';
		$instagramInfo = connectToInstagram($url);
		$results = json_decode($instagramInfo, true);
		//parse through the information one by one.
		foreach ($results['data'] as $items){
			$image_url = $items['images']['low_resolution']['url'];//going to go throuhg all of my results and give myself back the URL of those pictures 
			//because we want to save it in the PHP Server.			
			echo'<img src=" '.$image_url.' "/><br/>';
		}
}

if (isset($_GET['code'])){
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
																	'client_secret' => clientSecret,
																	'grant_type' => 'authorization_code',
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

$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
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
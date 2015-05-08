<?php 
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using defne.
define('client_ID', '65d48edbb16143519b7096a59f69549c');
define('client_Secret', '18caa1e571844a76adf811a0d6e9b0fa');
define('redirectURL', 'http://localhost/appscsdemyapi/index.php');
define('ImageDirectory', 'pics/');
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
<a href="https:api.instagram/oauth/authorize/?client_id=<?php echo client_ID; ?>&redirect_url<?php echo redirectURI?>&response_type=code">LOGIN</a>
</body>
</html>
<?php 
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//Make Constants using defne.
define('client_id', '65d48edbb16143519b7096a59f69549c');
define('client_secret', '18caa1e571844a76adf811a0d6e9b0fa');
define('redirectURL', 'http://localhost/appscsdemyapi/index.php');
define('ImageDirectory', 'pics/');

?>

<!-- 
CLIENT INFO
CLIENT ID	65d48edbb16143519b7096a59f69549c
CLIENT SECRET	18caa1e571844a76adf811a0d6e9b0fa
WEBSITE URL	http://localhost/appscsdemyapi/index.php
REDIRECT URI	http://localhost/appscsdemyapi/index.php -->
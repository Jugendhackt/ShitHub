<?php
define("SECURITY", "TRUE");	

require_once __DIR__ . '/vendor/autoload.php'; //Start autoloader
$dotenv = new Dotenv\Dotenv('/var/www/', 'config.env'); //Path for config comes here
$dotenv->load();

if($_ENV['ERROR_LEVEL'] == "DEBUG"){
	ini_set("display_errors", 1);
}else{
	ini_set("display_errors", 0);
}

$loader = new \ShitHub\Core\Loader();
$loader->load();
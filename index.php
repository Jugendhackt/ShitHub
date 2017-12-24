<?php
define("SECURITY", "TRUE");	
require_once __DIR__ . '/vendor/autoload.php'; //Start autoloader
$dotenv = new Dotenv\Dotenv('/var/www/', 'config.env'); //Path for config comes here
$dotenv->load();

if($_ENV['ERROR_LEVEL'] == "DEBUG"){ //Read out error level, set error reporting settings
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

$loader = new \ShitHub\Core\Loader();
$loader->load();
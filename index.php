<?php
require_once __DIR__ . '/config.php'; //Include config file
if(ERROR_LEVEL == "DEBUG"){ //Read out error level, set error reporting settings
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}

require_once __DIR__ . '/vendor/autoload.php'; //Start autoloader

$loader = new \ShitHub\Core\Loader();
$loader->load();
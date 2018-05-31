<?php

use anghenfil\Templater\TemplateParser;

define("SECURITY", "TRUE");
define("CONFIG_PATH", "/var/www/");
define("CONFIG_NAME", "config-old.env");

//Install check:
if(file_exists("install") || !file_exists(CONFIG_PATH.CONFIG_NAME)){
    require_once("install/install.php");
}else {
    if(!(@include_once __DIR__ . '/vendor/autoload.php')){
        die("Please install composer first.");
    }
    $dotenv = new Dotenv\Dotenv(CONFIG_PATH, CONFIG_NAME);
    $dotenv->load();

    if ($_ENV['ERROR_LEVEL'] == "DEBUG") {
        ini_set("display_errors", 1);
    } else {
        ini_set("display_errors", 0);
    }

    TemplateParser::init();
    $loader = new \ShitHub\Core\Loader();
    $loader->load();
    $loader->construct();
}
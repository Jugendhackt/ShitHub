<?php
//Error Levels:
//DEBUG -> all errors
//NONE -> no errors
define("ERROR_LEVEL", "DEBUG");

define("SITE_LIST", array("header", "footer", "dashboard", "upload"));
define("SITE_NAMES", array("header"=>"", "footer"=>"", "dashboard"=>"Dashboard", "upload"=>"Upload"));

define("UPLOAD_DIR", "data/snippets");

define("DB_HOST", "localhost")
define("DB_NAME", "shithub");
define("DB_UNAME", "shithub");
define("DB_PW", "test");
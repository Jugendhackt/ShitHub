<?php
//Error Levels (RFC 5424)

define("ERROR_LEVEL", "DEBUG");

define("SITE_LIST", array("header", "footer", "dashboard", "upload", "dreview", "404", "login"));
define("SITE_NAMES", array("header"=>"", "footer"=>"", "dashboard"=>"Dashboard", "upload"=>"Upload", "dreview"=>"Review", "404"=>"404-Error", "login"=>"Login"));

define("UPLOAD_DIR", "data/snippets");

define("DB_HOST", "127.0.0.1");
define("DB_NAME", "shithub");
define("DB_UNAME", "shithub");
define("DB_PW", "test");
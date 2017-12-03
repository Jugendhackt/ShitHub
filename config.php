<?php
//Error Levels (RFC 5424)

define("ERROR_LEVEL", "DEBUG");

$config = json_encode(file_get_contents("secret/configuration.cfg"), TRUE);

define("SITE_LIST", $config['site_list']);
define("SITE_NAMES", $config['site_names']);

define("UPLOAD_DIR", $config['upload_dir']);

define("DB_HOST", $config['db_host']);
define("DB_NAME", $config['db_name']);
define("DB_UNAME", $config['db_uname']);
define("DB_PW", $config['db_pw']);
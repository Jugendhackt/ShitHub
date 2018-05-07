<?php

namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use ShitHub\Core\SiteManager;

class header extends Module{
	public function call_modul(...$args){
		$site = $args[0];
		$sm = new SiteManager();

		if($sm->get_title($site) != null){
			TemplateParser::$globalstore->set_variable("title", $sm->get_title($site));
		}else{
			TemplateParser::$globalstore->set_variable("title", "");
		}

		if(isset($_SESSION['login_userid'])){
			TemplateParser::$globalstore->set_variable("loginor", file_get_contents("templates/profil_menu.php"));
		}else{
			TemplateParser::$globalstore->set_variable("loginor", file_get_contents("templates/login/login_menu.php"));
		}

		TemplateParser::$globalstore->set_variable("upload_error", "");
		TemplateParser::$globalstore->set_variable("upload_error_code", "");
	}
}

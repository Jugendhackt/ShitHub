<?php

namespace ShitHub\Modules;

class header{
	public function call_modul(...$args){
		$site = $args[0];
		$sm = new \ShitHub\Core\SiteManager();

		if($sm->get_title($site) != null){
			\ShitHub\Templater\TemplateParser::set_variable("title", $sm->get_title($site));
		}else{
			\ShitHub\Templater\TemplateParser::set_variable("title", "");
		}

		if(isset($_SESSION['loggedin'])){
			\ShitHub\Templater\TemplateParser::set_variable("loginor", file_get_contents("templates/profil_menu.php"));
		}else{
			\ShitHub\Templater\TemplateParser::set_variable("loginor", file_get_contents("templates/login_menu.php"));
		}

		\ShitHub\Templater\TemplateParser::set_variable("upload_error", "");
		\ShitHub\Templater\TemplateParser::set_variable("upload_error_code", "");
	}
}
<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class header{
	public function call_modul(...$args){
		session_start();
		
		$site = $args[0];
		$sm = new \ShitHub\Core\SiteManager();

		if($sm->get_title($site) != null){
			\anghenfil\Templater\TemplateParser::set_variable("title", $sm->get_title($site));
		}else{
			\anghenfil\Templater\TemplateParser::set_variable("title", "");
		}

		if(isset($_SESSION['login_userid'])){
			\anghenfil\Templater\TemplateParser::set_variable("loginor", file_get_contents("templates/profil_menu.php"));
		}else{
			\anghenfil\Templater\TemplateParser::set_variable("loginor", file_get_contents("templates/login/login_menu.php"));
		}

		\anghenfil\Templater\TemplateParser::set_variable("upload_error", "");
		\anghenfil\Templater\TemplateParser::set_variable("upload_error_code", "");
	}
}

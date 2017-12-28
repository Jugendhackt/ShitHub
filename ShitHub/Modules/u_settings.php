<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class u_settings{
	public function call_modul(...$args){
		if(!isset($_SESSION['login_userid'])){
			header("Location: index.php?site=login&returnurl=index.php?site=u_settings");
			die();
		}

		$sql = new \ShitHub\SQL\ShitHubSQL();
		$user = $sql->get_user($_SESSION['login_userid']);
		
		if($user[4] != null){
			$date = \DateTime::createFromFormat('U', $user[4]);
			$date->setTimezone(new \DateTimeZone("Europe/Berlin"));
			\ShitHub\Templater\TemplateParser::set_variable("settings_changedate", $date->format('d.m.Y G:i'));
		}else{
			\ShitHub\Templater\TemplateParser::set_variable("settings_changedate", "Niemals geändert.");
		}

		\ShitHub\Templater\TemplateParser::set_variable("settings_uname", $user[0]);
		\ShitHub\Templater\TemplateParser::set_variable("settings_email", $user[2]);
		
	}
}
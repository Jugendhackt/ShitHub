<?php

namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use ShitHub\SQL\ShitHubSQL;

class u_settings extends Module{
	public function call_modul(...$args){
		if(!isset($_SESSION['login_userid'])){
			header("Location: index.php?site=login&returnurl=index.php?site=u_settings");
			die();
		}

		$sql = new ShitHubSQL();
		$user = $sql->get_user($_SESSION['login_userid']);
		
		if($user[4] != null){
			$date = \DateTime::createFromFormat('U', $user[4]);
			$date->setTimezone(new \DateTimeZone("Europe/Berlin"));
			TemplateParser::$globalstore->set_variable("settings_changedate", $date->format('d.m.Y G:i'));
		}else{
			TemplateParser::$globalstore->set_variable("settings_changedate", "Niemals geändert.");
		}

		TemplateParser::$globalstore->set_variable("settings_uname", $user[0]);
		TemplateParser::$globalstore->set_variable("settings_email", $user[2]);
		
	}
}

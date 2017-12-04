<?php

namespace ShitHub\Modules;

class login{
	public function call_modul(...$args){
		\ShitHub\Templater\TemplateParser::set_variable("loginerror", "");

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(isset($_POST['username']) && isset($_POST['password'])){ //TODO: Bug - ius always set
				print('uname:'.$_POST['username']);
			}else{
				\ShitHub\Templater\TemplateParser::set_variable("login_errormsg", "Please fill in all fields.");
				$parser = \ShitHub\Templater\TemplateParser("templates/login_error.php");
				\ShitHub\Templater\TemplateParser::set_variable("loginerror", $paser->parseReturn());
			}
			\ShitHub\Templater\TemplateParser::set_variable("loginform", "Test");
		}else{
			\ShitHub\Templater\TemplateParser::set_variable("loginform", file_get_contents("templates/login_form.php"));
		}
	}	
}
<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class login{
	public function call_modul(...$args){
		\anghenfil\Templater\TemplateParser::set_variable("loginerror", "");
		\anghenfil\Templater\TemplateParser::set_variable("logininfo", "");

		if(isset($_GET['returnurl'])){ //If we came from another site, show "Please login to proceed" box
			\anghenfil\Templater\TemplateParser::set_variable("infomsg", "<strong>Information: </strong>Please login to proceed.");
			$parser = new \anghenfil\Templater\TemplateParser("templates/info.php");
			\anghenfil\Templater\TemplateParser::set_variable("logininfo", $parser->parseReturn());
		}

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['username'] != "" && $_POST['password'] != ""){ //TODO: Bug - is always set
				$sql = new \ShitHub\SQL\ShitHubSQL();
				$success = $sql->check_login($_POST['username'], $_POST['password']);

				if($success != null){
					$_SESSION['login_userid'] = $success;

					if(isset($_GET['returnurl'])){
						header("Location: ".$_GET['returnurl']);
					}else{
						header("Location: index.php?login=true");
					}
				}else{
					\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Login failed!</strong> Wrong username or password.");
					$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
					\anghenfil\Templater\TemplateParser::set_variable("loginerror", $parser->parseReturn());
					$this->load_form();
				}
			}else{
				\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Login failed!</strong> Please fill in all fields.");
				$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
				\anghenfil\Templater\TemplateParser::set_variable("loginerror", $parser->parseReturn());
				$this->load_form();
			}
		}else{
			$this->load_form();
		}
	}	

	private function load_form(){
		\anghenfil\Templater\TemplateParser::set_variable("loginform", file_get_contents("templates/login/login_form.php"));
	}
}

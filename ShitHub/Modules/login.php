<?php

namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use anghenfil\Templater\VariableStore;
use ShitHub\SQL\ShitHubSQL;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class login{
	public function call_modul(...$args){
		TemplateParser::$globalstore->set_variable("loginerror", "");
		TemplateParser::$globalstore->set_variable("logininfo", "");

		if(isset($_GET['returnurl'])){ //If we came from another site, show "Please login to proceed" box
            $stor = new VariableStore();
            $parser = new TemplateParser("templates/info.php", $stor);
			$stor->set_variable("infomsg", "<strong>Information: </strong>Please login to proceed.");

			TemplateParser::$globalstore->set_variable("logininfo", $parser->parse());
		}

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST['username'] != "" && $_POST['password'] != ""){ //TODO: Bug - is always set
				$sql = new ShitHubSQL();
				$success = $sql->check_login($_POST['username'], $_POST['password']);

				if($success != null){
					$_SESSION['login_userid'] = $success;

					if(isset($_GET['returnurl'])){
						header("Location: ".$_GET['returnurl']);
					}else{
						header("Location: index.php?login=true");
					}
				}else{
				    $stor = new VariableStore();
					$parser = new TemplateParser("templates/error.php", $stor);
                    $stor->set_variable("errormsg", "<strong>Login failed!</strong> Wrong username or password.");
					TemplateParser::$globalstore->set_variable("loginerror", $parser->parse());
					$this->load_form();
				}
			}else{
                $stor = new VariableStore();
				$stor->set_variable("errormsg", "<strong>Login failed!</strong> Please fill in all fields.");
				$parser = new TemplateParser("templates/error.php", $stor);
				TemplateParser::$globalstore->set_variable("loginerror", $parser->parse());
				$this->load_form();
			}
		}else{
			$this->load_form();
		}
	}

	private function load_form(){
		TemplateParser::$globalstore->set_variable("loginform", file_get_contents("templates/login/login_form.php"));
	}
}

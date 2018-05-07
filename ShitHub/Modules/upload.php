<?php

namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use anghenfil\Templater\VariableStore;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class upload extends Module{
	public function call_modul(...$args){
		if(!isset($_SESSION['login_userid'])){
			header("Location: index.php?site=login&returnurl=index.php?site=upload");
		}
		$pl = "<option>".implode("</option><option>", explode("\n", file_get_contents("data/pllist")))."</option>";
        TemplateParser::$globalstore->set_variable('pl', $pl);

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!isset($_POST['upload_title']) || !isset($_FILES['upload_file']) || !isset($_POST['upload_language']) || !isset($_POST['upload_description']) || !isset($_POST['upload_tags'])){

			    $stor = new VariableStore();
				$stor->set_variable("errormsg", "<strong>Upload failed!</strong> Bitte alle Felder ausfüllen!");
				$parser = new TemplateParser("templates/error.php", $stor);
				TemplateParser::$globalstore->set_variable("upload_error", $parser->parse()); //TODO: export fileload with template parsing
				$parser = new TemplateParser("templates/upload/upload_form.php", null);
				TemplateParser::$globalstore->set_variable("upload_form", $parser->parse());

			}else{
				if(explode("/", $_FILES['upload_file']['type'])[0] != "text"){
                    $stor = new VariableStore();
					$stor->set_variable("errormsg", "<strong>Upload failed!</strong> Ungültiges Format!");
					$parser = new TemplateParser("templates/error.php", $stor);
					TemplateParser::$globalstore->set_variable("upload_error", $parser->parse());
					$parser = new TemplateParser("templates/upload/upload_form.php", null);
					TemplateParser::$globalstore->set_variable("upload_form", $parser->parse());
				}else{
					try{
						$dbcon = new \ShitHub\SQL\ShitHubSQL();
						$uname = $dbcon->get_user($_SESSION['login_userid'])['uname'];
						$lastid = $dbcon->save_snippet(htmlentities($_POST['upload_title']), htmlentities($_POST['upload_description']), htmlentities($_POST['upload_language']), htmlentities($_POST['upload_tags']), $_SESSION['login_userid'], $uname); //TODO: Protect language against manipulated POST requests

						move_uploaded_file($_FILES["upload_file"]["tmp_name"], $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet');
						$temp = file_get_contents( $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet');
						file_put_contents( $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet', htmlentities($temp));

						if(file_exists($_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet') && filesize($_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet') != 0){
							//Upload successful
							TemplateParser::$globalstore->set_variable("upload_error", "");
							TemplateParser::$globalstore->set_variable("upload_form", "Upload successful");
						}else{
							$dbcon->delete_snippet($lastid);
							//Upload failed
							$stor = new VariableStore();
                            $stor->set_variable("errormsg", "<strong>Upload failed!</strong>");
							$parser = new TemplateParser("templates/error.php", $stor);
							TemplateParser::set_variable("upload_error", $parser->parse());
							TemplateParser::set_variable("upload_form", file_get_contents("templates/upload_form.php"));
						}
					}catch(\Exception $e){
                        $stor = new VariableStore();
						$stor->set_variable("errormsg", "<strong>Upload failed!</strong> Unkown error");
						$parser = new TemplateParser("templates/error.php", $stor);
						TemplateParser::$globalstore->set_variable("upload_error", $parser->parse());
						TemplateParser::$globalstore->set_variable("upload_form", file_get_contents("templates/upload_form.php"));

						\ShitHub\Core\Loader::getLogger()->alert('Unkown Exception while upload: '.$e->getMessage());
					}
				}
			}
		}else{
			//Formular anzeigen
			$parser = new TemplateParser("templates/upload/upload_form.php", null);
			TemplateParser::$globalstore->set_variable("upload_form", $parser->parse());
			TemplateParser::$globalstore->set_variable("upload_error", "");
		}
	}
}

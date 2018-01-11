<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class upload{
	public function call_modul(...$args){
		if(!isset($_SESSION['login_userid'])){
			header("Location: index.php?site=login&returnurl=index.php?site=upload");
		}
		$pl = "<option>".implode("</option><option>", explode("\n", file_get_contents("data/pllist")))."</option>";
        \anghenfil\Templater\TemplateParser::set_variable('pl', $pl);

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!isset($_POST['upload_title']) || !isset($_FILES['upload_file']) || !isset($_POST['upload_language']) || !isset($_POST['upload_description']) || !isset($_POST['upload_tags'])){

				\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Upload failed!</strong> Bitte alle Felder ausfüllen!");
				$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
				\anghenfil\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn()); //TODO: export fileload with template parsing
				$parser = new \anghenfil\Templater\TemplateParser("templates/upload/upload_form.php");
				\anghenfil\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());

			}else{
				if(explode("/", $_FILES['upload_file']['type'])[0] != "text"){
					\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Upload failed!</strong> Ungültiges Format!");
					$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
					\anghenfil\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn());
					$parser = new \anghenfil\Templater\TemplateParser("templates/upload/upload_form.php");
					\anghenfil\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());
				}else{
					try{
						$dbcon = new \ShitHub\SQL\ShitHubSQL();
						$uname = $dbcon->get_user($_SESSION['login_userid'])['uname'];
						$lastid = $dbcon->save_snippet($_POST['upload_title'], $_POST['upload_description'], $_POST['upload_language'], $_POST['upload_tags'], $_SESSION['login_userid'], $uname);

						move_uploaded_file($_FILES["upload_file"]["tmp_name"], $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet');
						$temp = file_get_contents( $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet');
						file_put_contents( $_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet', htmlentities($temp));

						if(file_exists($_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet') && filesize($_ENV['UPLOAD_DIR'].'/'.$lastid.'.snippet') != 0){
							//Upload successful
							\anghenfil\Templater\TemplateParser::set_variable("upload_error", "");
							\anghenfil\Templater\TemplateParser::set_variable("upload_form", "Upload successful");
						}else{
							$dbcon->delete_snippet($lastid);
							//Upload failed
							\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Upload failed!</strong>");
							$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
							\anghenfil\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn());
							\anghenfil\Templater\TemplateParser::set_variable("upload_form", file_get_contents("templates/upload_form.php"));
						}
					}catch(\Exception $e){
						\anghenfil\Templater\TemplateParser::set_variable("errormsg", "<strong>Upload failed!</strong> Unkown error");
						$parser = new \anghenfil\Templater\TemplateParser("templates/error.php");
						\anghenfil\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn());
						\anghenfil\Templater\TemplateParser::set_variable("upload_form", file_get_contents("templates/upload_form.php"));

						\ShitHub\Core\Loader::getLogger()->alert('Unkown Exception while upload: '.$e->getMessage());
					}
				}
			}
		}else{
			//Formular anzeigen
			$parser = new \anghenfil\Templater\TemplateParser("templates/upload/upload_form.php");
			\anghenfil\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());
			\anghenfil\Templater\TemplateParser::set_variable("upload_error", "");
		}
	}
}

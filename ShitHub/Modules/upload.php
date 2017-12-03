<?php

namespace ShitHub\Modules;

class upload{
	public function call_modul(...$args){
		$pl = "<option>".implode("</option><option>", explode("\n", file_get_contents("data/pllist")))."</option>";
        \ShitHub\Templater\TemplateParser::set_variable('pl', $pl);

		if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!isset($_POST['upload_title']) || !isset($_FILES['upload_file']) || !isset($_POST['upload_language']) || !isset($_POST['upload_description']) || !isset($_POST['upload_tags'])){

				\ShitHub\Templater\TemplateParser::set_variable("upload_error_code", "Bitte alle Felder ausfüllen!");
				$parser = new \ShitHub\Templater\TemplateParser("templates/upload_error.php");
				\ShitHub\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn()); //TODO: export fileload with template parsing
				$parser = new \ShitHub\Templater\TemplateParser("templates/upload_form.php");
				\ShitHub\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());

			}else{
				//TODO: Upload file

				if(explode("/", $_FILES['upload_file']['type'])[0] != "text"){
					\ShitHub\Templater\TemplateParser::set_variable("upload_error_code", "Ungültiges Format!");
					$parser = new \ShitHub\Templater\TemplateParser("templates/upload_error.php");
					\ShitHub\Templater\TemplateParser::set_variable("upload_error", $parser->parseReturn());
					$parser = new \ShitHub\Templater\TemplateParser("templates/upload_form.php");
					\ShitHub\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());
				}else{
					try{
						$dbcon = new \ShitHub\SQL\ShitHubSQL();
						$lastid = $dbcon->save_snippet($_POST['upload_title'], $_POST['upload_description'], $_POST['upload_language'], $_POST['upload_tags']);

						move_uploaded_file($_FILES["upload_file"]["tmp_name"], UPLOAD_DIR.'/'.$lastid.'.snippet');
						$temp = file_get_contents( UPLOAD_DIR.'/'.$lastid.'.snippet');
						file_put_contents( UPLOAD_DIR.'/'.$lastid.'.snippet', htmlentities($temp));

						if(file_exists(UPLOAD_DIR.'/'.$lastid.'.snippet') && filesize(UPLOAD_DIR.'/'.$lastid.'.snippet') != 0){
							//Upload successful
							\ShitHub\Templater\TemplateParser::set_variable("upload_error", "");
							\ShitHub\Templater\TemplateParser::set_variable("upload_form", "Upload successful");
						}else{
							//Upload failed
							\ShitHub\Templater\TemplateParser::set_variable("upload_error", "Upload failed");
							\ShitHub\Templater\TemplateParser::set_variable("upload_form", file_get_contents("templates/upload_form.php"));
						}
					}catch(\Exception $e){
						\ShitHub\Templater\TemplateParser::set_variable("upload_error", "Unkown error occured.");
						\ShitHub\Templater\TemplateParser::set_variable("upload_form", file_get_contents("templates/upload_form.php"));

						\ShitHub\Core\Loader::getLogger()->alert('Unkown Exception while upload: '.$e->getMessage());
					}
				}
			}
		}else{
			//Formular anzeigen
			$parser = new \ShitHub\Templater\TemplateParser("templates/upload_form.php");
			\ShitHub\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());
			\ShitHub\Templater\TemplateParser::set_variable("upload_error", "");
		}
	}
}
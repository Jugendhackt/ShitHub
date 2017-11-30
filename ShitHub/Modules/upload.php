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
				//Auswerten?site=upload#
				\ShitHub\Templater\TemplateParser::set_variable("upload_error", "");
				\ShitHub\Templater\TemplateParser::set_variable("upload_form", "Test");
				//TODO: Upload file
			}
		}else{
			//Formular anzeigen
			$parser = new \ShitHub\Templater\TemplateParser("templates/upload_form.php");
			\ShitHub\Templater\TemplateParser::set_variable("upload_form", $parser->parseReturn());
			\ShitHub\Templater\TemplateParser::set_variable("upload_error", "");
		}
	}
}
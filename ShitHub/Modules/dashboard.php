<?php

namespace ShitHub\Modules;

class dashboard{
	public function call_modul(...$args){
		$sql = new \ShitHub\SQL\ShitHubSQL();
		$parser = new \ShitHub\Templater\TemplateParser("templates/dashboard_row.php");
		$result = $sql->get_unresponded_reviews(5);
		
		$full = "";		
		foreach($result as $key){
			$tags = "";
			$temp = explode(", ", $key['tags']);
			$tagparser = new \ShitHub\Templater\TemplateParser("templates/dashboard_row_tags_tag.php");

			foreach($temp as $tag){
				\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_tags_tag", $tag);
				$tags .= $tagparser->parseReturn();
			}

			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_title", $key['title']);
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_author", $key['author_name']);
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_tags", $tags);
			$full .= $parser->parseReturn();
		}

		\ShitHub\Templater\TemplateParser::set_variable("dashboard_tab_content", $full);
	}
}
<?php

namespace ShitHub\Modules;

class dashboard{
	public function call_modul(...$args){
		if(isset($_GET['tab'])){
			$tab = $_GET['tab'];
		}else{
			$tab = "newest";
		}

		$sql = new \ShitHub\SQL\ShitHubSQL();
		$parser = new \ShitHub\Templater\TemplateParser("templates/dashboard_row.php");

		\ShitHub\Templater\TemplateParser::set_variable("newest_active", "");
		\ShitHub\Templater\TemplateParser::set_variable("discussed_active", "");

		if($tab == "discussed"){
			\ShitHub\Templater\TemplateParser::set_variable("discussed_active", "active");
			$result = $sql->get_discussed_reviews(5);
		}else{
			\ShitHub\Templater\TemplateParser::set_variable("newest_active", "active");
			$result = $sql->get_newest_reviews(5);
		}
		
		
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
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_author_name", $key['author_name']);
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_author_id", $key['author_id']);
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_date", $key['date']);
			\ShitHub\Templater\TemplateParser::set_variable("dashboard_row_tags", $tags);
			$full .= $parser->parseReturn();
		}

		\ShitHub\Templater\TemplateParser::set_variable("dashboard_tab_content", $full);
	}
}
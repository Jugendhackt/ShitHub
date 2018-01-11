<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class dashboard{
	public function call_modul(...$args){
		if(isset($_GET['tab'])){
			$tab = $_GET['tab'];
		}else{
			$tab = "newest";
		}

		$sql = new \ShitHub\SQL\ShitHubSQL();
		$parser = new \anghenfil\Templater\TemplateParser("templates/dashboard/dashboard_row.php");

		\anghenfil\Templater\TemplateParser::set_variable("newest_active", "");
		\anghenfil\Templater\TemplateParser::set_variable("discussed_active", "");

		if($tab == "discussed"){
			\anghenfil\Templater\TemplateParser::set_variable("discussed_active", "active");
			$result = $sql->get_discussed_reviews(5);
		}else{
			\anghenfil\Templater\TemplateParser::set_variable("newest_active", "active");
			$result = $sql->get_newest_reviews(5);
		}
		
		if($result == null){
			$full = "";
		}else{
		$full = "";		
		foreach($result as $key){
			$tags = "";
			$temp = explode(", ", $key['tags']);
			$tagparser = new \anghenfil\Templater\TemplateParser("templates/dashboard/dashboard_row_tags_tag.php");

			foreach($temp as $tag){ 
				if(!empty($tag)){
					\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_tags_tag", $tag);
					$tags .= $tagparser->parseReturn();
				}
			}

			\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_id", $key['id']);
			\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_title", $key['title']);
			\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_author_name", $key['author_name']);
			\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_author_id", $key['author_id']);

			if($key['date'] != null){
				$date = \DateTime::createFromFormat('U', $key['date']);
				$date->setTimezone(new \DateTimeZone("Europe/Berlin"));
				\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_date", $date->format('d.m.Y G:i'));
			}else{
				\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_date", "");
			}

			\anghenfil\Templater\TemplateParser::set_variable("dashboard_row_tags", $tags);
			$full .= $parser->parseReturn();
		}
		}
		\anghenfil\Templater\TemplateParser::set_variable("dashboard_tab_content", $full);
	}
}

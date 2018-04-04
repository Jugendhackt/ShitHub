<?php

namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use anghenfil\Templater\VariableStore;

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
		$store = new VariableStore();
		$parser = new TemplateParser("templates/dashboard/dashboard_row.php", $store);

		TemplateParser::$globalstore->set_variable("newest_active", "");
		TemplateParser::$globalstore->set_variable("discussed_active", "");

		if($tab == "discussed"){
			TemplateParser::$globalstore->set_variable("discussed_active", "active");
			$result = $sql->get_discussed_reviews(5);
		}else{
			TemplateParser::$globalstore->set_variable("newest_active", "active");
			$result = $sql->get_newest_reviews(5);
		}
		
		if($result == null){
			$full = "";
		}else{
		$full = "";		
		foreach($result as $key){
			$tags = "";
			$temp = explode(", ", $key['tags']);

			$rowstorage = new VariableStore();
			$tagparser = new TemplateParser("templates/dashboard/dashboard_row_tags_tag.php", $rowstorage);

			foreach($temp as $tag){ 
				if(!empty($tag)){
					$rowstorage->set_variable("dashboard_row_tags_tag", $tag);
					$tags .= $tagparser->parse();
				}
			}

			$store->set_variable("dashboard_row_id", $key['id']);
            $store->set_variable("dashboard_row_title", $key['title']);
            $store->set_variable("dashboard_row_author_name", $key['author_name']);
            $store->set_variable("dashboard_row_author_id", $key['author_id']);

			if($key['date'] != null){
				$date = \DateTime::createFromFormat('U', $key['date']);
				$date->setTimezone(new \DateTimeZone("Europe/Berlin"));
                $store->set_variable("dashboard_row_date", $date->format('d.m.Y G:i'));
			}else{
                $store->set_variable("dashboard_row_date", "");
			}

            $store->set_variable("dashboard_row_tags", $tags);
			$full .= $parser->parse();
		}
		}
		TemplateParser::$globalstore->set_variable("dashboard_tab_content", $full);
	}
}

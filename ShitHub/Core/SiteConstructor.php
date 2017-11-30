<?php

namespace ShitHub\Core;

class SiteConstructor{
	private $site;

	function __construct(){
		
		if(isset($_GET['site'])){
			$this->site = $_GET['site'];
		}else{
			$this->site = "dashboard";
		}
	}

	public function construct(){
		if(!in_array($this->site, SITE_LIST)){
			$this->site = '404';
		}

		$this->load("header"); //Load header
		$this->load($this->site); //Load site content
		$this->load("footer"); //Load footer
	}

	private function load($what){
		if(in_array($what, SITE_LIST) && file_exists(__DIR__.'/../../templates/'.$what.'.php')){
			if(class_exists('\\ShitHub\\Modules\\'.$what)){

				$cname = "ShitHub\\Modules\\".$what;
				$modul = new $cname;

				if(method_exists($modul, 'call_modul')){
					$modul->call_modul($this->site, SITE_LIST);
				}
			}

			$this->printpart(__DIR__.'/../../templates/'.$what.'.php');

		}
	}

	private function printpart($filename){
		$templater = new \ShitHub\Templater\TemplateParser($filename);
		$templater->parse();
	}
}
<?php

namespace ShitHub\Core;

class SiteConstructor{
	private $site_list;
	private $site;

	function __construct($site_list){
		$this->site_list = $site_list;
		
		if(isset($_GET['site'])){
			$this->site = $_GET['site'];
		}else{
			$this->site = "dashboard";
		}
	}

	public function construct(){
		$this->load($this->header); //Load header
		$this->load($this->site); //Load site content
		$this->load($this->footer); //Load footer
	}

	private function load($what){
		if(in_array($what, $this->site_list) && file_exists(__DIR__.'/../../templates/'.$what.'.php')){
			if(class_exists('\\ShitHub\\Modules\\'.$what)){

				$cname = "ShitHub\\Modules\\".$what;
				$modul = new $cname;

				if(method_exists($modul, 'call_modul')){
					$modul->call_modul();
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
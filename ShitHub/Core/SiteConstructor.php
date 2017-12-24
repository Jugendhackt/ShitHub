<?php

namespace ShitHub\Core;

class SiteConstructor{
	private $site;
	private $sm;

	function __construct(){
		$this->sm = new \ShitHub\Core\SiteManager();

		if(isset($_GET['site'])){
			$this->site = $_GET['site'];
		}else{
			$this->site = "dashboard";
		}
	}

	public function construct(){
		if(!$this->sm->site_allowed($this->site)){
			$this->site = '404';
		}

		$this->load("header"); //Load header
		$this->load($this->site); //Load site content
		$this->load("footer"); //Load footer
	}

	private function load($what){
		if($this->sm->site_allowed($this->site)){
			if(file_exists(__DIR__.'/../../templates/'.$what.'.php')){
				if(class_exists('\\ShitHub\\Modules\\'.$what)){

					$cname = "ShitHub\\Modules\\".$what;
					$modul = new $cname;

					if(method_exists($modul, 'call_modul')){
						$modul->call_modul($this->site);
					}
				}

				$this->printpart(__DIR__.'/../../templates/'.$what.'.php');
			}elseif(file_exists(__DIR__.'/../../templates/'.$what.'/'.$what.'.php')){
				if(class_exists('\\ShitHub\\Modules\\'.$what)){

					$cname = "ShitHub\\Modules\\".$what;
					$modul = new $cname;

					if(method_exists($modul, 'call_modul')){
						$modul->call_modul($this->site);
					}
				}

				$this->printpart(__DIR__.'/../../templates/'.$what.'/'.$what.'.php');
			}
		}
	}

	private function printpart($filename){
		$templater = new \ShitHub\Templater\TemplateParser($filename);
		$templater->parse();
	}
}
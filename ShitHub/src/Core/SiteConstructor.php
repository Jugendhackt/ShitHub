<?php

namespace ShitHub\Core;

use anghenfil\Templater\TemplateParser;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

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
        TemplateParser::$globalstore->set_variable("customcss", "");
        session_start();

		$this->loadModule($this->site); //Load site content
        $this->loadModule("header");
        $this->loadTemplate("header"); //Load header
        $this->loadTemplate($this->site);
		$this->loadModule("footer");
        $this->loadTemplate("footer");
	}

	private function loadTemplate($what){
		if($this->sm->site_allowed($this->site)){
			if(file_exists(__DIR__ . '/../../templates/' .$what.'.php')){
				$this->printpart(__DIR__ . '/../../templates/' .$what.'.php');
			}elseif(file_exists(__DIR__ . '/../../templates/' .$what.'.php')){
				$this->printpart(__DIR__ . '/../../templates/' .$what.'.php');
			}
		}
	}

	private function loadModule($what){
        if(class_exists('\\ShitHub\\Modules\\'.$what)){

            $cname = "ShitHub\\Modules\\".$what;
            $modul = new $cname;

            if(method_exists($modul, 'call_modul')){
                $modul->call_modul($this->site);
            }
        }
    }

	private function printpart($filename){
		$templater = new \anghenfil\Templater\TemplateParser($filename, null);
		print($templater->parse());
	}
}

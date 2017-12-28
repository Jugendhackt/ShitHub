<?php

namespace ShitHub\Core;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class SiteManager{
	private $sitelist;

	public function __construct(){
		$this->sitelist = $_ENV['SITE_LIST'];
	}

	public function site_allowed($site){
		if(in_array($site, explode(", ", $this->sitelist))){
			return true;
		}else{
			return false;
		}
	}
	public function get_title($site){
		$sitetitle = $_ENV['SITE_NAME_'.$site];
		return $sitetitle;
	}
}
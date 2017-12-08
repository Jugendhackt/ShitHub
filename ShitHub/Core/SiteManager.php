<?php

namespace ShitHub\Core;

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
		$sitetitles = $_ENV['SITE_NAMES'];

		$sitetitles = explode(",", $sitetitles); //Get array from string

		foreach($sitetitles as $key){
			$temp = explode(" => ", $key);

			if($temp[0] == $site){
				return $temp[1];
			}
		}
	}
}
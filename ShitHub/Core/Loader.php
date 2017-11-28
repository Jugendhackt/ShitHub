<?php

namespace ShitHub\Core;

class Loader{
	public function load(){
		$sites_list = array("test", "test1");
		$constructor = new \ShitHub\Core\SiteConstructor($sites_list);

		$constructor->construct();
	}
}
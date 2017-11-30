<?php

namespace ShitHub\Core;

class Loader{
	public function load(){
		$constructor = new \ShitHub\Core\SiteConstructor();

		$constructor->construct();
	}
}
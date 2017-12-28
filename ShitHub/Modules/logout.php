<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class logout{
	public function call_modul(...$args){
		session_destroy();
		header("Location: index.php?logout=true");
	}
}
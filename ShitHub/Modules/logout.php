<?php

namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class logout extends Module{
	public function call_modul(...$args){
		session_destroy();
		header("Location: index.php?logout=true");
	}
}
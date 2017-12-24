<?php

namespace ShitHub\Modules;

class logout{
	public function call_modul(...$args){
		session_destroy();
		header("Location: index.php?logout=true");
	}
}
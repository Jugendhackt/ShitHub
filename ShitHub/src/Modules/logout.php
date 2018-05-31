<?php

namespace ShitHub\Modules;

class logout extends Module{
	public function call_modul(...$args){
		session_destroy();
		header("Location: index.php?logout=true");
	}
}
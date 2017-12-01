<?php

namespace ShitHub\SQL;

class ShitHubSQL{

	private $pdo = null; //pdo object

	public function __construct(){
		try{
			$this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.', '.DB_UNAME.', '.DB_PW);
		}catch(PDOException $e){
			if(ERROR_LEVEL == "DEBUG"){
				print("PDO Error:"+$e->getMessage());
			}else{
				//Write to log
			}
		}
	}
	public function save_snippet(){
		
	}
}
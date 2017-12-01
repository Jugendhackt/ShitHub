<?php
ini_set('display_errors', 1);
namespace ShitHub\SQL;

class ShitHubSQL{

	private $pdo = null; //pdo object

	public function __construct(){
		try{
			$this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.', '.DB_UNAME.', '.DB_PW);
		}catch(PDOException $e){
			\ShitHub\Core\Loader::getLogger()->alert('PDOException: '.$e->getMessage());
		}
	}
	public function save_snippet(){
		if($this->pdo != null){
			$query = $this->pdo->prepare("");
		}
		//TODO: return int as result
	}
}
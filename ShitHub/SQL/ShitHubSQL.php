<?php
namespace ShitHub\SQL;

class ShitHubSQL{

	private $pdo = null; //pdo object

	public function __construct(){
		try{
			$this->pdo = new \PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_UNAME,DB_PW);
		}catch(\PDOException $e){
			\ShitHub\Core\Loader::getLogger()->alert('PDOException: '.$e->getMessage());
		}
	}
	public function save_snippet($title, $description, $language, $tags){
		if($this->pdo != null){
			$query = $this->pdo->prepare("INSERT INTO snippets (title, description, language, tags) VALUES (?, ?, ?, ?);");
			$query->execute(array($title, $description, $language, $tags));

			return $this->pdo->lastInsertId();
		}
	}
}
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
			if($query->execute(array($title, $description, $language, $tags))){
				return $this->pdo->lastInsertId();
			}else{
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
			}
		}//TODO: Handle if pdo is null
	}

	public function load_snippet($id){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT title, description, language, tags FROM snippets WHERE id = ?");
			if($query->execute(array($id))){
				if($query->rowCount() > 0){
					$row = $query->fetch();
					return array($row['title'], $row['description'], $row['language'], $row['tags']);
				}else{
					return null;
				}
			}else{
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
			}

			return $this->pdo->lastInsertId();
		}//TODO: Handle if pdo is null
	}
}
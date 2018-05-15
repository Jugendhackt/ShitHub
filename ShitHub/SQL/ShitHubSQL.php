<?php
namespace ShitHub\SQL;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class ShitHubSQL extends SQL{

	public function save_snippet($title, $description, $language, $tags, $author_id, $author_name){
		if($this->pdo != null){
			$query = $this->pdo->prepare("INSERT INTO snippets (title, description, language, tags, author_id, author_name, date) VALUES (?, ?, ?, ?, ?, ?, ?);");
			if($query->execute(array($title, $description, $language, $tags, $author_id, $author_name, time()))){
				return $this->pdo->lastInsertId();
			}else{
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
			}
		}else{
			SQL::offlineErr();
		}
	}
	public function delete_snippet($id){
		if($this->pdo != null){
			$query = $this->pdo->prepare("DELETE FROM snippets WHERE id = ?");
			if($query->execute(array($id))){
				return true;
			}else{
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
				return false;
			}
		}else{
			SQL::offlineErr();
		}
	}
	public function load_snippet($id){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT title, description, language, tags FROM snippets WHERE id = ?");
			$query->execute(array($id));
			$row = $query->fetch();
			
			return $row;
		}else{
			SQL::offlineErr();
		}
	}
	public function get_user($id){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT uname, pwhash, email, lastlogin, pwchange FROM users WHERE id = ?");
			$query->execute(array($id));
			$row = $query->fetch();
			
			return $row;
		}else{
			SQL::offlineErr();
		}
	}
	public function get_discussed_reviews(int $anz){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT id, author_id, author_name, title, language, tags, date, status FROM snippets WHERE status = 1 ORDER BY id DESC LIMIT :limit"); //TODO: implement state 
			$query->bindParam(':limit', $anz, \PDO::PARAM_INT);
			$query->execute();

			$array = array();
			while($row = $query->fetch()){
				array_push($array, $row);
			}
			
			return $array;
		}else{
			SQL::offlineErr();
		}
	}

	public function get_newest_reviews(int $anz){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT  id, author_id, author_name, title, language, tags, date FROM snippets ORDER BY id DESC LIMIT :limit");
			$query->bindParam(':limit', $anz, \PDO::PARAM_INT);
			$query->execute();

			$array = array();
			while($row = $query->fetch()){
				array_push($array, $row);
			}

			return $array;
		}else{
			SQL::offlineErr();
		}
	}
	public function check_login($uname, $pword){
		if($this->pdo != null){
			$query = $this->pdo->prepare("SELECT id, pwhash, lastlogin FROM users WHERE uname = :uname");
			$query->bindParam(':uname', $uname);

			if($query->execute()){
				$row = $query->fetch();
				if(count($row) > 0){
					if(password_verify($pword, $row['pwhash'])){
						//Password correct
						$this->update_last_login($row['id']);
						return $row['id'];
					}else{
						//Password incorrect
						return null;
					}
				}else{
					return null;
				}
			}else{
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
			}
		}else{
			SQL::offlineErr();
		}	
	}
	private function update_last_login($id){
		if($this->pdo != null){
			$query = $this->pdo->prepare("UPDATE users SET lastlogin = ? WHERE id = ?");
			if(!$query->execute(array(time(), $id))){
				\ShitHub\Core\Loader::getLogger()->alert('SQL Error: '.$query->queryString.': '.$query->errorInfo()[2]);
			}
		}else{
			SQL::offlineErr();
		}	
	}
}
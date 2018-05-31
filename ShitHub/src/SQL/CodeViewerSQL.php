<?php
/**
 * Description: provides SQL methods for codeviewer
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:30
 */

namespace ShitHub\SQL;


use ShitHub\CodeViewer\Snippet;

class CodeViewerSQL extends SQL{

    public function checkProjectID($projectID){
        //TODO: create method body
        return true;
    }

    public function fetchSnippets($projectID){
        //TODO: create method body
        return array();
    }

    public function checkSnippetID($snippetID, $projectID){
        //TODO: create method body
        return true;
    }

    /**
     * @param int $snippetID snippetID
     * @return Snippet object
     */
    public function getSnippet($snippetID){
        if($this->pdo != null){
            $query = $this->pdo->prepare("SELECT id, title, description, language, tags, author_id, author_name, status, date FROM snippets WHERE id = ?");
            $query->execute(array($snippetID));
            $row = $query->fetch(); //TODO: Specify fetch style

            if(!empty($row)){
                return $snippet = new Snippet($row['id'], $row['title'], $row['description'], $row['language'], $row['tags'], $row['author_id'], $row['author_name'], $row['status'], $row['date']);
            }//TODO: Exception
        }else{
            SQL::offlineErr();
        }
    }
}
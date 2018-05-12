<?php
/**
 * Description: class provides navigation utility for CodeViewer
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:23
 */

namespace ShitHub\CodeViewer;

use ShitHub\SQL\CodeViewerSQL;

class Navigation{
    private $projectID;
    private $activeSnippet;
    private $projectSnippets = array();

    public function __construct($project){
        if(!is_null($project) && is_int($project)){ //Check if projectID submitted
            $db = new CodeViewerSQL();
            if($db->checkProjectID($project)) {
                $this->projectID = $project;

                $this->projectSnippets = $db->fetchSnippets($project);
            }else{
                throw new \InvalidArgumentException("projectID not valid");
            }
        }else{
            throw new \InvalidArgumentException("projectID as first parameter (int) required");
        }
    }

    public function setActive($snippet){
        if(!is_null($snippet) && is_int($snippet)){
            if(in_array($snippet, $this->projectSnippets)){
                $this->activeSnippet = $snippet;
            }else{
                throw new \InvalidArgumentException("snippet doesn't belong to project");
            }
        }else{
            throw new \InvalidArgumentException("snippetID as first parameter (int) required");
        }
    }

    public function generateNavigation(){

    }
}
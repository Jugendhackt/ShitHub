<?php
/**
 * Description: class provides navigation utility for CodeViewer
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:23
 */

namespace ShitHub\CodeViewer;

class Navigation{
    private $projectID;

    public function __construct($project){
        if(!is_null($project)){ //Check if projectID submitted
            $this->projectID = $project;
        }else{
            throw new \InvalidArgumentException("projectID as first parameter required");
        }
    }

    public function setActive(){
    }
}
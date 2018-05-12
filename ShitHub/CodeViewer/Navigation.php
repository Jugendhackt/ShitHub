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

    /**
     * Navigation constructor.
     * @param integer $project project ID
     */
    public function __construct($project){
        if(CodeViewer::checkProject($project)){
                $db = new CodeViewerSQL();
                $this->projectID = $project;
                $this->projectSnippets = $db->fetchSnippets($project);
        }else{
            throw new \InvalidArgumentException("valid projectID as first parameter (int) required");
        }
    }

    /**
     * @param integer $snippet set snippet as active
     */
    public function setActive($snippet){
        if(CodeViewer::checkSnippet($snippet)){
            if(in_array($snippet, $this->projectSnippets)){
                $this->activeSnippet = $snippet;
            }else{
                throw new \InvalidArgumentException("snippet doesn't belong to project");
            }
        }else{
            throw new \InvalidArgumentException("snippetID as first parameter (int) required");
        }
    }

    /**
     * Generate navigation
     */
    public function generateNavigation(){

    }
}
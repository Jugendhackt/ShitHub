<?php
/**
 * Description: main class for CodeViewer
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:00
 */

namespace ShitHub\CodeViewer;

use ShitHub\SQL\CodeViewerSQL;

class CodeViewer{
    private $projectID;
    private $activeSnippet;
    private $mode;
    private $navigation;

    /**
     * CodeViewer constructor.
     * @param integer $project project id
     * @param integer null $snippet active snippet
     * @param boolean false $editmode view or edit mode; false = read mode true = write mode
     */
    public function __construct($project, $snippet = null, $editmode = false){
        $db = new CodeViewerSQL();

        if(!is_null($project) && is_int($project)){ //CheckprojectID
            if($db->checkProjectID($project)) {
                $this->projectID = $project; //Assign projectid

                if (!is_null($snippet)) { //Check snippetID
                    if (is_int($snippet)) {
                        if($db->checkSnippetID($snippet, $project)) {
                            $this->activeSnippet = $snippet;
                        }else{
                            throw new \InvalidArgumentException("snippet doesn't belong to project");
                        }
                    } else {
                        throw new \InvalidArgumentException("snippetID as second parameter must be int or unset");
                    }
                }
                if (is_bool($editmode)) {
                    $this->mode = $editmode;
                } else {
                    throw new \InvalidArgumentException("mode as second parameter must be boolean: false (read) or true (read/write)");
                }

                $this->navigation = new Navigation($project); //Create navigation object
            }else{
                throw new \InvalidArgumentException("projectID not valid");
            }
        }else{
            throw new \InvalidArgumentException("projectID as first parameter (int) required");
        }
    }

    public function show(){

    }
}
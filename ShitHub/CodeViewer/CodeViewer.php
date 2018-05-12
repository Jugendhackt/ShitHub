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
    private $activeSnippet = null;
    private $mode;
    private $navigation;

    /**
     * CodeViewer constructor.
     * @param integer $project project id
     * @param integer null $snippet active snippet
     * @param boolean false $editmode view or edit mode; false = read mode true = write mode
     */
    public function __construct($project, $snippet = null, $editmode = false){
        if (self::checkProject($project)) {
            $this->projectID = $project;
            $this->navigation = new Navigation($project);

            if (!is_null($snippet)) {
                if (self::checkSnippet($snippet)) {
                    if (self::checkSnippetInProject($snippet, $project)) {
                        $this->activeSnippet = $snippet;
                    } else {
                        throw new \InvalidArgumentException("snippet doesn't belong to project");
                    }
                } else {
                    throw new \InvalidArgumentException("snippetID as second parameter must be int or null");
                }
            }
            if (is_bool($editmode)) { //Check if editmode is bool
                $this->mode = $editmode;
            } else {
                throw new \InvalidArgumentException("mode as third parameter must be boolean: false (read) or true (read/write)");
            }
        } else {
            throw new \InvalidArgumentException("Valid projectID as first parameter (int) required");
        }
    }

    /**
     * Shows CodeViewer
     */
    public function show(){
        $this->navigation->generateNavigation();
    }

    static public function checkSnippet($snippet){
        if (!is_null($snippet)) {
            if (is_int($snippet)) { //Check if snippetID is int
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    static public function checkSnippetInProject($snippet, $project){
        $db = new CodeViewerSQL();

        if($db->checkSnippetID($snippet, $project)) { //Check if snippetID is in project
            return true;
        }else{
            return false;
        }
    }

    static public function checkProject($project){
        $db = new CodeViewerSQL();

        if(!is_null($project) && is_int($project)) { //CheckprojectID
            if ($db->checkProjectID($project)) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
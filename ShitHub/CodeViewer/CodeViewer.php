<?php
/**
 * Description: main class for CodeViewer
 * User: anghenfil
 * Date: 12.05.18
 * Time: 13:00
 */

namespace ShitHub\CodeViewer;

class CodeViewer{
    private $projectID;
    private $activeSnippet;
    private $mode;

    /**
     * CodeViewer constructor.
     * @param integer $project project id
     * @param integer null $snippet active snippet
     * @param boolean false $editmode view or edit mode; false = read mode true = write mode
     */
    public function __construct($project, $snippet = null, $editmode = false){
        if(!is_null($project) && is_int($project)){
            $this->projectID = $project;
            if(!is_null($snippet)){
                if(is_int($snippet)){
                    $this->activeSnippet = $snippet;
                }else{
                    throw new \InvalidArgumentException("snippetID as second parameter must be int or unset");
                }
            }
            if(is_bool($editmode)){
                $this->mode = $editmode;
            }else{
                throw new \InvalidArgumentException("mode as second parameter must be boolean: false (read) or true (read/write)");
            }
        }else{
            throw new \InvalidArgumentException("projectID as first parameter (int) required");
        }
    }
}
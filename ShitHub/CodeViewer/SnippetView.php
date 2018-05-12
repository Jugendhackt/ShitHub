<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 12.05.18
 * Time: 14:39
 */

namespace ShitHub\CodeViewer;


class SnippetView{
    private $snippet;

    public function generateSnippetView($snippet){
        if($snippet instanceof Snippet){ //parameter snippet must be object type Snippet
            $this->snippet = $snippet;
        }else{
            throw new \InvalidArgumentException("Parameter must be type Snippet");
        }
    }

    private function highlightCode(){

    }
}
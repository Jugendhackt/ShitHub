<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 12.05.18
 * Time: 14:39
 */

namespace ShitHub\CodeViewer;


use anghenfil\Templater\VariableStore;

class SnippetView{

    public function generateSnippetView($snippet){
        if($snippet instanceof Snippet){ //parameter snippet must be object type Snippet
            $code = "";
            $highlighted = $this->highlightCode($snippet);

            if(!is_null($highlighted)){
                $code = $highlighted;
            }else{ //Fallback if highlight failed
                $code = html_entity_decode(file_get_contents($snippet->getFilepath()));
            }

            $rownums = $this->generateLineNumbers($code);

            $vs = new VariableStore();
            $vs->set_variable("code", $code);
            $vs->set_variable("rownums", $rownums);

            return $vs;
        }else{
            throw new \InvalidArgumentException("Parameter must be type Snippet");
        }
    }

    private function highlightCode(Snippet $snippet){
        $highlighter = new \Highlight\Highlighter();
        try {
            $code = $highlighter->highlight($snippet->getLanguage(), html_entity_decode(file_get_contents($snippet->getFilepath())));
            return $code->value;
        } catch (\Exception $e) {
            return null; //If Highlighting fails, return false to turn it off
        }
    }

    private function generateLineNumbers($code){
        $codearray = explode("\n", $code->value);
        $size = sizeof($codearray);
        unset($codearray);

        $nums = "";
        for($i = 0;$i<$size;$i++){
            $nums .= $i."\n";
        }

        return $nums;
    }
}
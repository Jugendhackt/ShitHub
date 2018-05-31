<?php
/**
 * Created by PhpStorm.
 * User: anghenfil
 * Date: 12.05.18
 * Time: 14:39
 */

namespace ShitHub\CodeViewer;


use anghenfil\Templater\TemplateParser;

class SnippetView{

    public function generateSnippetView($snippet){
        if($snippet instanceof Snippet){ //parameter snippet must be object type Snippet
            $this->highlightCode($snippet);
        }else{
            throw new \InvalidArgumentException("Parameter must be type Snippet");
        }
    }

    private function highlightCode(Snippet $snippet){
        $highlighter = new \Highlight\Highlighter();
        try {
            $code = $highlighter->highlight($snippet->getLanguage(), html_entity_decode(file_get_contents($snippet->getFilepath())));
            $codearray = explode("\n", $code->value);
            $size = sizeof($codearray);
            unset($codearray);

            $nums = "";
            for($i = 0;$i<$size;$i++){
                $nums .= $i."\n";
            }

            TemplateParser::$globalstore->set_variable("displaycode", $code->value);
            TemplateParser::$globalstore->set_variable("displaynums", $nums);
        } catch (\Exception $e) {
            //TODO: Error handling
        }
    }
}
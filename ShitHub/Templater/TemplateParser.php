<?php

namespace ShitHub\Templater;

class TemplateParser{
	private $filename;
	private $html;
	private static $array = Array();

	function __construct($filename){
		$this->filename = $filename;
	}

	private function loadFile(){
        $doc = new \DOMDocument();
        $doc->loadHTMLFile($this->filename);
        $this->html = $doc->saveHTML();
    }
    
    public function parse(){
        $this->loadFile();

        foreach(self::$array as $key => $value){
            $this->html = str_replace('{'.$key.'}', self::$array[$key],$this->html);
        }
        
        print($this->html);
    }
    
    public static function set_variable($key1, $val1){
        self::$array[$key1] = $val1;
    }
    
    public static function issaved($key1){
        if(isset(self::$array[$key1])){
            return true;
        }
    }
}
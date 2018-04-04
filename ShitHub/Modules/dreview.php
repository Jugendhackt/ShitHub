<?php
namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use ShitHub\SQL\ShitHubSQL;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class dreview{
	private $id;
	private $code;

	public function call_modul(...$args){
		$this->id = intval($_GET['id']);

		$sql = new ShitHubSQL();
		$this->code = $sql->load_snippet($this->id);

		if($this->code != null && file_exists ('data/snippets/'.$this->id.'.snippet')){
			$highlighter = new \Highlight\Highlighter();
            try {
                $code = $highlighter->highlight('cpp', file_get_contents('data/snippets/' . $this->id . '.snippet'));
            } catch (\Exception $e) {
                //TODO: Handle error
            }
            $codearray = explode("\n", $code->value);
			$size = sizeof($codearray);
			unset($codearray);

			$nums = "";
			$i = 1;
			for($i = 0;$i<$size;$i++){
				$nums .= $i."\n";
			}

			TemplateParser::$globalstore->set_variable("displaycode", $code->value);
			TemplateParser::$globalstore->set_variable("displaynums", $nums);
		}else{
			header('Location: ?site=404');
		}
	}
}

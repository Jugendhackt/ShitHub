<?php
namespace ShitHub\Modules;

use anghenfil\Templater\TemplateParser;
use ShitHub\SQL\ShitHubSQL;

class dreview extends Module{
	private $id;
	private $snippet;

	public function call_modul(...$args){
	    TemplateParser::$globalstore->push("customcss", "<link href=\"vendor/scrivo/highlight.php/styles/default.css\" rel=\"stylesheet\"");
		$this->id = intval($_GET['id']);

		$sql = new ShitHubSQL();
		$this->snippet = $sql->load_snippet($this->id);

		if($this->snippet != null && file_exists ('data/snippets/'.$this->id.'.snippet')){
			$highlighter = new \Highlight\Highlighter();
            try {
                $code = $highlighter->highlight($this->snippet['language'], html_entity_decode(file_get_contents('data/snippets/' . $this->id . '.snippet')));
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
		}else{
			header('Location: ?site=404');
		}
	}
}

<?php
namespace ShitHub\Modules;

if(!defined(SECURITY)){
	die("Direct invocation isn't allowed.");
}

class dreview{
	private $id;
	private $code;

	public function call_modul(...$args){
		$this->id = intval($_GET['id']);

		$sql = new \ShitHub\SQL\ShitHubSQL();

		$this->code = $sql->load_snippet($this->id);

		if($this->code != null && file_exists ('data/snippets/'.$this->id.'.snippet')){
			$code = file_get_contents('data/snippets/'.$this->id.'.snippet');
			$codearray = explode("\n", $code);
			$size = sizeof($codearray);
			unset($codearray);

			$nums = "";
			$i = 1;
			for($i = 0;$i<$size;$i++){
				$nums .= $i."\n";
			}

			\ShitHub\Templater\TemplateParser::set_variable("displaycode", $code);
			\ShitHub\Templater\TemplateParser::set_variable("displaynums", $nums);
		}else{
			header('Location: ?site=404');
		}
	}
}

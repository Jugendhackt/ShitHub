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
			\ShitHub\Templater\TemplateParser::set_variable("displaycode", file_get_contents('data/snippets/'.$this->id.'.snippet'));
		}else{
			header('Location: ?site=404');
		}
	}
}

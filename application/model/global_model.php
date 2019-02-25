<?php 
require_once "application/model/extra/config_class.php";
require_once "application/model/extra/article_class.php";




abstract class Model {
	
	public $config;
	protected $data;
	protected $article;
	protected $feedback;
	
	

	
	
	public function __construct ($db){
		$this->config = new Config();
		$this->data = $this->secureData($_GET);
		$this->article = new Article($db);
		$this->feedback = new FeedBack($db);
	}
	
	abstract function getTitle();
	
	
	private function secureData ($data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) $this->secureData($value);
			else $data [$key] = htmlspecialchars($value); 
		}
		return $data;
	}
	
	
	
	
}


?>
<?php 
	
class Article {
	
	private $db;
	
	public function __construct ($db) {
		$this->db = $db;
	}
	
	public function getArticles ($fields, $where="", $sort="", $up="") {
		return $this->db->getData("articles", $fields, $where, $sort, $up);
	}

	
}
	
	

?>
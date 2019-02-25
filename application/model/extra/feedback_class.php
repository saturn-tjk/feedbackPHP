<?php 
	
class FeedBack {
	
private $db;
	
	public function __construct ($db) {
		$this->db = $db;
	}
	
	public function getFeedBacks ($fields, $where="", $sort="", $up="") {
		return $this->db->getData("feedbacks", $fields, $where, $sort, $up);
	}
	
	
	

	
}
	
	

?>
<?php 
require_once "application/model/global_model.php";

class AdminModel extends Model {
	
	public $art_titles;
	public $feeds;
	public $where;
	
	public function __construct ($db) {
		parent::__construct($db);
		$this->art_titles = $this->getQueryArtTitleList(); 
		$this->feeds = $this->getQueryFeedList(); 
	}
	
	public function getTitle (){
		return "Администратор";
	}
	
	public function getQueryArtTitleList() {
		return $this->article->getArticles(array("id", "title"));		
	}
	
	public function getQueryFeedList () {
		if ($this->data["status_id"]) $this->where = "status_id=".$this->data["status_id"];
		elseif ($this->data["art_id"]) $this->where = "art_id=".$this->data["art_id"];
		else $this->where = "status_id=1";
		
		$feed_sort = $this->data["feedsort"];
		$up = $this->data["up"];
		if ($feed_sort=="") $feed_sort = "date"; 
		
		
		$query_rslt = $this->feedback->getFeedBacks(array("*"), $this->where, $feed_sort, $up);
		
		for ($i=0; $i<count($query_rslt); $i++) {
			switch ($query_rslt[$i]["status_id"]) {
				case 1: 
					$query_rslt[$i]["alert_type"] = "alert-info";
					$query_rslt[$i]["alert_text"] = "Не проверенный отзыв.";
					break;
				case 2:
					$query_rslt[$i]["alert_type"] = "alert-success";
					$query_rslt[$i]["alert_text"] = "Отзыв одобрен.";
					break;
				case 3:
					$query_rslt[$i]["alert_type"] = "alert-danger";
					$query_rslt[$i]["alert_text"] = "Отзыв отказан в публичный показ.";
					break;						
			};
		}
		return $query_rslt;
	}
	
	
	
	
}

?>
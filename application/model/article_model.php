<?php 
require_once "application/model/extra/feedback_class.php";
require_once "application/model/global_model.php";

class ArticleModel extends Model {
	
	public $article_text;
	public $art_title_list;
	public $feed_list;
	
	public function __construct ($db) {
		parent::__construct($db);
		$this->article_text = $this->getQueryArticleText();
		$this->art_title_list = $this->getQueryArtTitleList();
		$this->feed_list = $this->getQueryFeedList();
	}
	
	public function getTitle (){
		return "Статьи";
	}
	
	public function getQueryArticleText (){
		if ($this->data["art_id"]) $art_id = $this->data["art_id"];
		else $art_id = 1;
		return $this->article->getArticles(array("id", "title", "text"), "id=".$art_id);
	}
	
	public function getQueryArtTitleList () {
		return $this->article->getArticles(array("id", "title"));		
	}
	
	public function getQueryFeedList () {
		if ($this->data["feedsort"]) {
			$feed_sort = $this->data["feedsort"];
			$up = $this->data["up"];
		}else $feed_sort = "date";
		
		if (empty($this->data["art_id"]))  $where = "art_id=1";
		else $where = "art_id=".$this->data["art_id"];
		$where .= " AND status_id = 2";
		return $this->feedback->getFeedBacks(array("*"), $where, $feed_sort, $up);
	}
	
	
}

?>
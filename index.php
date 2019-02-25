<?php 
	mb_internal_encoding("UTF-8");
	require_once "application/model/article_model.php";
	require_once "application/model/admin_model.php";
	require_once "application/model/extra/config_class.php";
	require_once "application/model/extra/db_class.php";
	error_reporting(E_ALL & ~E_NOTICE);

	$db = new DataBase();
	$view = $_GET["view"];	
	session_start();
	switch ($view) {
		
		case "": 
			$model = new ArticleModel ($db);
			$content_tpl = "article_view.php";
			break;
		case "article": 
			$model = new ArticleModel ($db);
			$content_tpl = "article_view.php";
			break;
		case "admin": 
			if ($_SESSION["userstatus"] != "admin") header("Location: http://dev.halapay.ae/ali/");
				$model = new AdminModel ($db);
				$content_tpl = "admin_view.php";
				break;
			
	};

	include "application/view/general_view.php";
	
	//
	
?>
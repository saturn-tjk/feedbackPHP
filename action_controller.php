<?php

	require_once "application/model/extra/db_class.php";
	require_once "application/model/extra/actions_class.php";
	error_reporting(E_ALL & ~E_NOTICE);
	
	$db = new DataBase ();
	$actions = new Actions ($db);

	
	switch ($actions->http_data["action"]) {
		case "addfeedback":
			$actions->addFeedBack();
			break;
		case "save_changes_in_feed_txt":
			if ($actions->upDateFeedBack(array("text"=>$actions->http_data["text"], "edited_msg"=>"Редактирован админом"), 
											"id=".$actions->http_data["feedback_id"])) {
				echo json_encode($resmsg["mess"] = "Saccess edited");				
			} 
			break;
		case "allow_feed":
			if ($actions->upDateFeedBack(array("status_id"=>2), "id=".$actions->http_data["feedback_id"])){
				echo json_encode($resmsg["mess"] = "Разрешен для общего просмотра");
			} else echo json_encode($resmsg["mess"] = "Операция не прошла");
			break;
		case "reject_feed":
			if ($actions->upDateFeedBack(array("status_id"=>3), "id=".$actions->http_data["feedback_id"])){
				echo json_encode($resmsg["mess"] = "Отказан в общем просмотре");
			} else echo json_encode($resmsg["mess"] = "Операция не прошла");
			break;
		case "login":
			$result = $actions->login();
			echo json_encode($result);
			break;
		case "logout":
			$actions->logout();
			break;
	};


?>
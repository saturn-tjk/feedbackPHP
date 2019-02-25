<?php

require_once "application/model/extra/config_class.php";
require_once "application/model/extra/user_class.php";


class Actions {
	public $http_data;
	private $db;
	private $imgsrc;
	public $config;
	private $user;
	
	
	public function __construct ($db) {
		session_start();
		$this->db = $db;
		if ($_POST) $this->http_data = $this->secureData($_POST);
		else $this->http_data = $this->secureData($_GET);
		$this->config = new Config;
		
		
	}


	private function secureData ($data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) $this->secureData($value);
			else $data [$key] = htmlspecialchars($value); 
		}
		return $data;
	}
	
	public function redirect ($link) {
		header ("Location: $link");
		exit;
	}
	
	public function login () {
	
		if ($this->http_data["login"] == "admin" && $this->http_data["pass"] = "123") {
			$_SESSION ["username"] = "admin";
			$_SESSION ["userstatus"] = "admin";
			
			ob_start();
			include "application/view/user_panel.php";
			$content["user_panel"] = ob_get_contents();
			$content["saccess"] = "Авторизация успешна прошла";
			ob_end_clean(); 
			
			return $content;
			
		} else {
			$err_auth["errauth"] = 1;
			$err_auth["errmsg"] = "Не верный логин или пароль!";
			return $err_auth;
		}
	}
	
	public function logout () {
		unset ($_SESSION["username"]);
		unset ($_SESSION["userstatus"]);
		$this->redirect ("http://beetask.freeoda.com");
	}
	
	public function upDateFeedBack ($upd_fields, $where) {
		if ($this->db->update("feedbacks", $upd_fields, $where)) return true;
		return false;
	}

	public function addFeedBack($values = array()) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
		if ($_FILES['userfile']['tmp_name']) $img = $this->resizeImg($this->uploadImg(), 420);
		else $img="";
		
		if (count($values) <= 0) {
			$values = array("text"=>$this->http_data["feedback_form_area"], "email"=>$this->http_data["feedback_form_email"], 
			 "name_commented"=>$this->http_data["feedback_form_name"], "art_id"=>$this->http_data["art_id"], 
			 "status_id"=>1, "edited_msg"=>"", "imgsrc"=>$img, "date"=>date("Y-m-d H:i:s"));
		} 
		$this->db->insert("feedbacks", $values);
		return $this->redirect ($_SERVER["HTTP_REFERER"]);
	}
	
	private function uploadImg(){
		$new_file_name = $this->http_data["art_id"]."_".$this->http_data["feedback_form_email"]."_".uniqid()."_".$_FILES['userfile']['name'];
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $this->config->user_img_dir.$new_file_name)) {
			return $this->config->user_img_dir.$new_file_name;
		} else {
			return false;
		}
	}
	
	private function resizeImg($image, $w_o = false, $h_o = false) {
		if (($w_o < 0) || ($h_o < 0)) {
		  echo "Некорректные входные параметры";
		  return false;
		}
		list($w_i, $h_i, $type) = getimagesize($image); // Получаем размеры и тип изображения (число)
		$types = array("", "gif", "jpeg", "png"); // Массив с типами изображений
		$ext = $types[$type]; // Зная "числовой" тип изображения, узнаём название типа
		if ($ext) {
		  $func = 'imagecreatefrom'.$ext; // Получаем название функции, соответствующую типу, для создания изображения
		  $img_i = $func($image); // Создаём дескриптор для работы с исходным изображением
		} else {
		  echo 'Некорректное изображение'; // Выводим ошибку, если формат изображения недопустимый
		  return false;
		}
		/* Если указать только 1 параметр, то второй подстроится пропорционально */
		if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
		if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
		$img_o = imagecreatetruecolor($w_o, $h_o); // Создаём дескриптор для выходного изображения
		imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его
		$func = 'image'.$ext; // Получаем функция для сохранения результата
		if($func($img_o, $image)) return $image; // Сохраняем изображение в тот же файл, что и исходное, возвращая результат этой операции
		else return false;
	  }

}
?>
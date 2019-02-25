<?php 
	
class User {
	
	private $users;
	
	public function __construct (){
		$this->user = array (array("username=>admin", "password=>123", "user_status=>admin"), 
							array("username=>user", "password=>1234", "user_status=>user"));
	}
	
	public function getUsers (){
		return $this->users;
	}
	
}
	
	

?>
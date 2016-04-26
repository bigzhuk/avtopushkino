<?php

class users {
	function __construct($lang, $db){
		if(!$db){
			require_once($_SERVER['DOCUMENT_ROOT']."/config.php");
		}
		$this->lang='ru';
		$this->db=$db;
	}

	function getLoginByEmail($email){
		
	}
	
	function getUserDataById($id){
	
	}
	
	function getUserGroup($email){
	
	}
	
	function getAllUsers(){
		$query="SELECT * FROM users WHERE 1 order by `reg_date` desc ";
		return $query;
	}
	
	function auth($login,$pass){
		
	}
	
	

}

?>
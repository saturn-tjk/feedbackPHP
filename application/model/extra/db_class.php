<?php

class DataBase {
	
	private $mysqli;
	private $config;
	private $valid;
	

	public function __construct () {
		//$this->valid = new CheckValid();
		$this->config = new Config();
		$this->mysqli = new mysqli($this->config->host, $this->config->user, $this->config->password, $this->config->db);
		if ($this->mysqli->connect_errno) {
			printf("Connect failed: %s\n", $mysqli->connect_error); 		/* check connection */
			exit();
		}
		$this->mysqli->query ("SET NAMES 'utf8'");
	}
	
	private function query ($query){
		return $this->mysqli->query($query);
	}
	
	private function select ($table_name, $fields, $where, $order, $up) {
		for ($i=0; $i < count($fields); $i++){
			if ((strpos($fields[$i], "(") === false) && ($fields[$i] != "*")) {
				$fields[$i] = "`".$fields[$i]."`"; 
			}
		}
		$fields = implode(",", $fields);
		if (!$order) $order = "ORDER BY `id`"; 
		else {
			$order = "ORDER BY `$order`";
			if (!$up) $order .= " DESC";
		}	
		if ($where) $query = "SELECT $fields FROM $table_name WHERE $where $order";
		else $query = "SELECT $fields FROM $table_name $order";
		$result_set = $this->query($query);
		if (!$result_set)  return false;
		$i = 0;
		while ($row = $result_set->fetch_assoc()){
			$data[$i]=$row;
			$i++;
		}
		$result_set->close();
		return $data;
	}
	
	public function insert ($table_name, $new_values) {
		$query = "INSERT INTO $table_name (";
		foreach ($new_values as $field => $value) $query .= "`".$field."`,";
		$query = substr ($query, 0, -1);
		$query .= ") VALUES (";
		foreach ($new_values as $value) $query .= "'".addslashes($value)."',";
		$query = substr($query, 0, -1);
		$query .= ")";
		return $this->query($query);
	}
	
	public function update ($table_name, $upd_fields, $where) {
		$query = "UPDATE $table_name SET ";
		foreach ($upd_fields as $field => $value) $query .= "`$field` = '" .addslashes($value). "',";
		$query = substr ($query, 0, -1);
		if ($where){
			$query .= " WHERE $where";
			return $this->query($query);
		}
		else return false;
	}
	
	public function getData ($table_name, $fields, $where, $order, $up) {
		return $this->select ($table_name, $fields, $where, $order, $up);
	}
	
	

}

?>
<?php

Class DB{

	private $host	= DB_SVR;
	private $user 	= DB_USER;
	private $pass 	= DB_PASS;
	private $dbname = DB_NAME;

	private $db;
	private $error;
	private $stmt;
	
	public function __construct(){

		  $this->db = new mysqli(DB_SVR,DB_USER,DB_PASS,DB_NAME);

		  if($this->db->connect_errno){
		  	$this->error = "Failed to connect to MySQL: " . $this->db->connect_error;
		  }
	}

	public function execute($sql){

		return $this->db->query($sql);
	
	}

	public function insert_id(){
        return $this->db->insert_id;
    }

	public function escape_string($sql){

		return mysqli_real_escape_string($this->db,$sql);
	
	}		

	public function fetch_all($data){
		
		$arr = array();
		while($row= mysqli_fetch_object($data)){
			array_push($arr,$row);
		}
		
		return json_encode($arr);
	}
	public function fetch($data){
		
		return json_encode(mysqli_fetch_object($data));
	}
}

?>
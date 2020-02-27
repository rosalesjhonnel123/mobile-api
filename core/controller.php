<?php

class Api_Controller {
	public $action;
	public $params;
	public $id;
	public $uri;
	public function __construct() {	
		$this->uri = new Url();	
		$this->action = isset($_GET['action']) ? $_GET['action'] : '';
		$this->id = isset($_GET['id']) ? $_GET['id'] : '';
		$this->params = json_decode(file_get_contents('php://input'));
	}
 		
 	public function index(){
 		echo "HELLO WORLD";
 	}	
} 
?>
<?php

Class Users extends Api_Controller{
	protected $model;
	protected $userid;
	function __construct()
	{
		parent::__construct();
		$this->model = new Usersmodel();
		$this->userid = $this->uri->segment(3);
	}
	
	public function getrow(){
		echo $this->model->getrow($this->userid);
	}

	public function displayall(){
		echo $this->model->getresults();
	}

	public function insertrow(){
		echo $this->model->insertRow('users',$this->params);
	}

	public function updaterow(){
		$arr = array('id' => $this->userid);
		$this->model->updateRow('users',$this->params,$arr);
		echo $this->model->getrow($this->userid);
	}
	public function deleterow(){
		$arr = array('id' => $this->userid);
		echo $this->model->deleteRow('users',$arr);
	}
}

?>
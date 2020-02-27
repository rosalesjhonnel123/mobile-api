<?php
class Usersmodel extends Api_Model {

	public function getresults(){
		
		$sql = "SELECT * FROM users ORDER BY id DESC";
		$result = $this->get_results($sql);
		return $result;	
	}

	public function getrow($id){

		$sql = "SELECT * FROM users WHERE id=$id";
		$result = $this->get_row($sql);
		return $result;
	}

	public function insertRow($tablename,$data){
		
		$this->insert($tablename,$data);
		return $this->last_insert_id();
	}

	public function deleteRow($tablename,$arr){
		
		return $this->delete($tablename,$arr);

	}

	public function updateRow($tablename,$data,$arr){
		
		return $this->update($tablename,$data,$arr);

	}


} 
?>
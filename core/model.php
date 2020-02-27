<?php
class Api_Model {

	protected $db;
	protected $post;
    private $uri;
    function __construct(){
    	$this->db = new DB();
        $this->uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    }
    
    public function query($sql){
        $data = $this->db->execute($sql);
        return $result;
    }
    public function get_results($sql){
		$data = $this->db->execute($sql);
		$result = $this->db->fetch_all($data);

		return $result;
    }

    public function get_row($sql){
        $data = $this->db->execute($sql);
        $result = $this->db->fetch($data);

        return $result;
    }
    public function keys($data){
    	$arr = array();
    	foreach($data as $key => $value){
			foreach($value as $k => $v){
				array_push($arr,$k);
			}
		}
		return $arr;
    }
    
    public function values($data){
    	$arr = array();
    	foreach($data as $key => $value){

			foreach($value as $k => $v){
				$val = trim($v);
				array_push($arr,"'{$val}'");
			}
		}
		return $arr;
    }

    public function postupdate($data){
        $arr = array();
        foreach($data as $key => $value){
            foreach($value as $k => $v){
                $val = trim($v);
                array_push($arr,$k."="."'{$val}'");
            }
        }
        return $arr;
    }

    public function where($data){
        $arr = array();
        $end = end($data);
        
        foreach($data as $k => $v){
            $val = trim($v);
            if($val == $end){
                $and = "";
            }
            else{
                $and = " AND";
            }
            if(intval($val)){
                $val = $val;
            }      
            else{
                $val = "'{$val}'";
            }
            array_push($arr,$k."=".$val.$and);

        }
      return $arr;
    }
    public function insert($tablename,$data){
    	$key = implode(', ',$this->keys($data));
    	$values = implode(', ',$this->values($data));
        $sql = "INSERT INTO {$tablename}({$key}) values($values)";
    	
        return $this->db->execute($sql);    	
    }

    public function last_insert_id(){
        return $this->db->insert_id();
    }
    public function update($tablename,$data,$arr){

        $where = implode(' ',$this->where($arr));
        $udata = implode(', ',$this->postupdate($data));
        $sql = "UPDATE {$tablename} SET {$udata} WHERE {$where}";

        return $this->db->execute($sql);  
    }

    public function delete($tablename,$arr){
        $where = implode(' ',$this->where($arr));
        $sql = "DELETE FROM {$tablename} WHERE {$where}";
        
        return $this->db->execute($sql);        
    }

    public function deleteall($tablename){
        $sql = "DELETE * FROM {$tablename}";
        return $this->db->execute($sql);        
    }

    public function segment_uri($segment){

        $data = strstr($this->uri, '?', true);
        $arr = explode('/', $data);
        return $arr[$segment];
       
    }
  
 } 
?>
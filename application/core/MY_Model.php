<?php
class MY_Model extends CI_Model {
    
    public function __construct() {

        parent::__construct();
        // Load form helper library    
	//comment while merging    
        //$this->load->model(array('CustomUpload_model'=>'customUpload','CustomEmail_model','DeveloperProfileApi_model'=>'DeveloperProfileApi'));            
    }

    public function getData($table,$column,$where) {
        $this->db->select($column);
        if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get($table);
       //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result();
        }
        
    }

    public function getRowData($table,$column,$where) {
        $this->db->select($column);
        if($where){
            $this->db->where($where);
        }        
        $query = $this->db->get($table);
       //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->row();
        }
        
    }
    public function deleteData($table,$where) {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function deleteDataNotIn($table,$where,$whereNotIn) {        
        $this->db->where_not_in($whereNotIn['key'],$whereNotIn['value']);
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function deleteMultipleRow($table,$column,$array){
        $this->db->where_in($column, $array);
        $this->db->delete($table);
    }             

    
                    

    public function updateData($table,$update_data,$where) {
        $this->db->where($where);
        $this->db->update($table,$update_data); 
       /*echo $this->db->last_query();
        print_r($this->db->error());*/
        return $this->db->affected_rows() ;       

    }

    public function insertData($table,$update_data) {      
        $q = $this->db->insert($table,$update_data);
        if ($q) {
            return  $this->db->insert_id();
        }
        else{
           return $this->db->error()['message'];
        }
    }

    public function logData($message=""){
        $logFile = APPPATH."logs/error.log";
        if(!file_exists($logFile)){
            touch($logFile);
            //chomod($logFile, 777);
        }

        $message = "Log Date ".date("d-m-Y"). " :  ".$message."\n";
        $myfile = fopen($logFile, "a");
        fwrite($myfile, $message);
        fclose($myfile);
    }
}
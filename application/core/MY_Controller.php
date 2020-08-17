<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{ 
   //set the class variable.
    public $template  = array();
    public $data      = array();

    public function __construct() {    
      parent::__construct();    
      $this->load->library('session');

    }
   
    public function frontend(){
	   
      $this->template['header']        = $this->load->view('frontend/layout/header', $this->data, true);  
      $this->template['middle']        = $this->load->view('frontend/'.$this->middle, $this->data, true);
      $this->template['footer']        = $this->load->view('frontend/layout/footer', $this->data, true);
      $this->template;
	 
    }
}
?>
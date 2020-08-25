<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct() {
        parent::__construct();
        // Load form helper library
        $_POST = json_decode(file_get_contents('php://input'), true);
        $this->load->model('home_model','Home');		
    }

	public function index()
	{
		$this->load->view('index');
	}

	public function view($page)
	{
      switch ($page) {
        case 'home': 
        		$this->load->view('frontend/layout/header');  
      			$this->load->view('frontend/home');
      			$this->load->view('frontend/layout/footer');
              break;              
        case 'listing':
              $this->load->view('frontend/layout/innerHeader');  
      			  $this->load->view('frontend/listing');
              $this->load->view('frontend/layout/footer');
              break;              
        case 'singleItem':
              $this->load->view('frontend/layout/innerHeader');  
              $this->load->view('frontend/singleItem');
              $this->load->view('frontend/layout/footer');
              break;              
              
      }  
	}
	public function get($value)
	{
		echo $this->Home->getList($value);
	}	
  public function categoryListing()
  { 
    echo $this->Home->getListingItemByCategoryID();    
  } 
  public function getItemByID()
  { 
    echo $this->Home->getItemByID();    
  } 
}

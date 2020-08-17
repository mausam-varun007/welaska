<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

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
              $this->load->view('frontend/layout/header');  
      			  $this->load->view('frontend/listing');
              $this->load->view('frontend/layout/footer');
              break;              
              
      }  
	}
	public function categoryListing(){
		

	}
}

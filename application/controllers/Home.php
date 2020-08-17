<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function __construct() {
        parent::__construct();
        // Load form helper library
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
      			$this->load->view('frontend/home');
              break;              
              
      }  
	}
	public function get($value)
	{
		echo $this->Home->getList($value);
	}
}

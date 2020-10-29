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
  public function LoginCode()
  { 
    echo $this->Home->LoginCode();    
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
        case 'edit-listing':
              $this->load->view('frontend/layout/innerHeader');  
              $this->load->view('frontend/edit-listing');
              $this->load->view('frontend/layout/footer');
              break;              
        case 'profile':
              $this->load->view('frontend/layout/innerHeader');  
              $this->load->view('frontend/profile');
              $this->load->view('frontend/layout/footer');
              break;              
        case 'singleItem':
              $this->load->view('frontend/layout/innerHeader');  
              $this->load->view('frontend/singleItem');
              $this->load->view('frontend/layout/footer');
              break; 
        case 'freeListing':
              $this->load->view('frontend/layout/freeListingHeader');  
              $this->load->view('frontend/freeListing');
              $this->load->view('frontend/layout/footer');
              break; 
        case 'detailForm':
              $this->load->view('frontend/layout/freeListingHeader');  
              $this->load->view('frontend/detailForm');
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

      $itemsData['data']          = '';
      $itemsData['allCount']      = 0;
      $itemsData['offsetResult']  = '';
      $itemsData = $this->Home->getListingItemByCategoryID($countAllItem='all');    

      $selectedItemsData['data']          = '';
      $selectedItemsData['allCount']      = 0;
      $selectedItemsData['offsetResult']  = '';
      $selectedItemsData = $this->Home->getListingItemByCategoryID($countAllItem='category');    


      if($itemsData){        
        echo json_encode(array('status'=>1,
                              'allData'=>$itemsData['data'],
                              'allCount'=>$itemsData['allCount'],
                              'allItemsOffsetResult'=>$itemsData['offsetResult'],
                              'selectedAllData'=>$selectedItemsData['data'],
                              'selectedAllCount'=>$selectedItemsData['allCount'],
                              'selectedAllItemsOffsetResult'=>$selectedItemsData['offsetResult'],
                            ));
      }else{
        echo json_encode(array('status'=>0));
      }
  } 
  public function getItemByID()
  { 
    echo $this->Home->getItemByID();    
  }
   public function getSearchItems()
  { 
    $recieved = $this->Home->getSearchItems();    
    if($recieved){
      echo json_encode(array('status'=>1,'data'=>$recieved));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function getCityList(){ 

    $recieved = $this->Home->getCityList();    
    if($recieved){
      echo json_encode(array('status'=>1,'data'=>$recieved));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function submitBasicDetails()
  { 
      $step = $this->input->post('step');      
      switch ($step) {
              case 'business':                              
                  $result = $this->Home->submitBasicDetails();    
                   break;                             
              case 'location':                              
                  $result = $this->Home->submitLocationInfo();    
                   break;               
              case 'contact':                              
                  $result = $this->Home->submitContact();    
                   break;               
              case 'others':                              
                  $result = $this->Home->submitOthers();    
                   break;               
              case 'keywords':                              
                  $result = $this->Home->submitKeywords();    
                   break;
              case 'get_verification_code':                              
                  $result = $this->Home->getVerifcationCode();    
                   break;                                  
              case 'personal':                              
                  $result = $this->Home->submitPersonalDetails();    
                   break;
              case 'address':                              
                  $result = $this->Home->submitAddressDetails();    
                   break;
              }
            echo $result;
  }
  public function checkCompany(){ 

    $recieved = $this->Home->checkCompany();    
    if($recieved){
      echo json_encode(array('status'=>1,'data'=>$recieved));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function submitReview(){ 

    $recieved = $this->Home->submitReview();    
    if($recieved){
      echo json_encode(array('status'=>1));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function giveRating(){ 

    $recieved = $this->Home->giveRating();    
    if($recieved){
      echo json_encode(array('status'=>1));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function productLike(){ 

    $recieved = $this->Home->productLike();    
    if($recieved){
      echo json_encode(array('status'=>1));
    }else{
      echo json_encode(array('status'=>0));
    }
  } 
  public function getEditItemByID()
  { 
    echo $this->Home->getEditItemByID();    
  }
  public function uploadImages()
  { 
    echo $this->Home->uploadImages();    
  }
  public function deleteImages()
  { 
    echo $this->Home->deleteImages();    
  }
  public function uploadProfileImages()
  { 
    echo $this->Home->uploadProfileImages();    
  }
  public function getProfileDetails()
  { 
    echo $this->Home->getProfileDetails();    
  }
  public function removeAddress()
  { 
    echo $this->Home->removeAddress();    
  }
  public function uploadFiles()
  { 
    echo $this->Home->uploadFiles();    
  }
  public function deleteFiles()
  { 
    echo $this->Home->deleteFiles();    
  }
  public function updateMobile()
  { 
    echo $this->Home->updateMobile();    
  }
  public function checkMobileExist()
  { 
    echo $this->Home->checkMobileExist();    
  }  
  
}

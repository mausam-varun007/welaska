<?php
class Home_model extends MY_model
{
	public function getList($value)
	{
		$this->db->select('*');
		$this->db->from($value);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return json_encode(array('status'=>1,'data'=>$query->result()));
		}
	}
	
	public function insertdb($table,$data){
		
		return	$this->db->insert($table, $data);
	}
	public function LoginCode()
	{		

		if($this->input->post()){
			$msg = '';
			$verifyUser = $this->db->select('id,user_name,user_type,mobile')->from('user')->where(array('mobile'=>$this->input->post('mobile')) )->get();

			$this->form_validation->set_rules('user_name', 'Name', 'required');						
			if(!empty($verifyUser)){
				$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			}else{
				$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_unique[user.mobile]');
			}

			if ($this->form_validation->run() == FALSE){
                $msg.= validation_errors();                
            }
            if (!empty($msg)) {
                return json_encode(array('status'=>0,'msg'=>$msg));
            }else{             	            

            		if($verifyUser->num_rows() > 0){
            			$getUserData = $verifyUser->row();
            			if(!empty($this->input->post('verification_code'))){
            				if($this->session->userdata('temp_verification_code')==$this->input->post('verification_code')){
		      					$sessionData = array('user_name'=>$this->input->post('user_name'),'mobile'=>$getUserData->mobile,'user_type'=>$getUserData->user_type,'user_id'=>$getUserData->id);
								$this->session->set_userdata($sessionData); 
								return json_encode(array('status'=>1,'msg'=>'Successfully Login','result'=>$sessionData));	
            				}
            			}
            			//$otp  = rand(100000, 999999);
               	    	$this->session->set_userdata('temp_verification_code',999999); 
               	    	return json_encode(array('status'=>2,'msg'=>'OTP sent to mobile number'));	

            		}else{            			
            			if(!empty($this->input->post('verification_code'))){
            				if($this->session->userdata('temp_verification_code')==$this->input->post('verification_code')){
		      					$userData = array(
										'user_name'=>$this->input->post('user_name'),						
										'mobile'=>$this->input->post('mobile'),
										'user_type'=>'user',
										'is_active'=>1);
		      					
            					$lastId = $this->insertData('user',$userData);	
            					if($lastId){
            						$this->session->set_userdata($userData); 
            					}
            					// echo $this->db->last_query();
            					// die();
            					if($lastId){
									$this->session->set_userdata($userData); 
									$userData['user_id'] = $lastId;
									return json_encode(array('status'=>1,'msg'=>'Successfully Signup','result'=>$userData));	
            					}else{
            						return json_encode(array('status'=>0));							
            					}		

            				}
            			}
            			//$otp  = rand(100000, 999999);
               	    	$this->session->set_userdata('temp_verification_code',999999); 						
               	    	return json_encode(array('status'=>2,'msg'=>'OTP sent to mobile number'));	
            		}

			
			}
		}
	}
	public function getSearchCategoryList()
	{		
		$this->db->select('listing_items.*,category.id as category_id,category.category_name,count(rating.id) as total_ratings, SUM(rating.rating) as total_rating_sum ,AVG(rating.rating) as rating_average');
		$this->db->from('listing_items');		
		$this->db->join('category','category.id=listing_items.category_id');
		$this->db->join('rating','rating.item_id=listing_items.id','left');
		$this->db->group_by('listing_items.id');
		//$this->db->limit(10);		
		$query = $this->db->get();						

		if ($query->num_rows() > 0) {
			return $query->result();		
		}	
	}
	public function getListingItemByCategoryID($queryType)
	{			
		if(!empty($this->input->post('category_id'))){

			$id = $this->input->post('category_id');
			$this->db->select('listing_items.*,category.id as category_id,category.category_name, count(rating.id) as total_ratings, SUM(rating.rating) as total_rating_sum , FORMAT(AVG(rating.rating), 1) as rating_average ');
			$this->db->from('listing_items');		
			$this->db->join('category','category.id=listing_items.category_id');
			$this->db->join('rating','rating.item_id=listing_items.id','left');
			if($this->input->post('location')!=null){
				$this->db->where('listing_items.city',$this->input->post('location'));
			}
			$this->db->where('category_id',$id);
			$this->db->group_by('listing_items.id');
			$this->db->order_by('listing_items.id desc');
			//$this->db->limit(10);					
			$pageSize = $this->input->post('pageSize');
	        $pageIndex = $this->input->post('pageIndex');
	        $offsetRange = $pageSize*($pageIndex-1);       
			
			if($queryType!='all'){
	        	$this->db->limit($this->input->post('pageSize'),$offsetRange);
			}	      
			$query = $this->db->get();
	        // $this->db->get();
	        // echo $this->db->last_query(); 
	        //print_r($this->db->error());
	        //exit();

	        $num_rows = $query->num_rows();

	        $start = ($offsetRange)?$offsetRange:1;
	        $end = $offsetRange + $num_rows;

	        // $return['allCount'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;
	        $return['allCount'] = $this->db->query('SELECT FOUND_ROWS() count;')->row()->count;	        
	        $return['data'] = $query->result();
	        $return['offsetResult'] = $start.' - '.$end.' of '.$return['allCount'].' Items';

			if ($query->num_rows() > 0) {
				return $return;
				//return $query->result();		
			}	
		}
	}
	public function getItemByID()
	{		
		$id = $this->input->post('item_id');
		if(empty($this->input->post('user_id'))){
			$this->db->select('listing_items.*,category.id as category_id,category.category_name,
						(SELECT GROUP_CONCAT(payment_mode) FROM payment_modes
                    		WHERE item_id = '.$id.') AS payment_mode, (select count(id) from item_likes where item_likes.item_id = '.$this->input->post('item_id').') as likes_count , (select FORMAT(AVG(rating), 1) from rating where rating.item_id = '.$this->input->post('item_id').')  as rating_avg');
		}else{
			$this->db->select('listing_items.*,category.id as category_id,category.category_name,
						(SELECT GROUP_CONCAT(payment_mode) FROM payment_modes
                    		WHERE item_id = '.$id.') AS payment_mode,rating.rating, EXISTS( select * from item_likes join user on user.id= item_likes.user_id  where user.id = '.$this->input->post('user_id').') as likes_exist, (select count(id) from item_likes where item_likes.item_id = '.$this->input->post('item_id').') as likes_count , (select FORMAT(AVG(rating), 1) from rating where rating.item_id = '.$this->input->post('item_id').')  as rating_avg');
		}
		$this->db->from('listing_items');		
		$this->db->join('category','category.id=listing_items.category_id');				
		$this->db->join('rating','rating.item_id=listing_items.id','left');				
		$this->db->join('user','user.id=rating.user_id','left');				
		$this->db->where('listing_items.id',$id);
		$query = $this->db->get();				

		$this->db->select('shop_timming.days,shop_timming.start_from,shop_timming.start_to,shop_timming.is_closed');
		$this->db->from('shop_timming');				
		$this->db->where('shop_timming.item_id',$id);
		$query1 = $this->db->get();								

		$this->db->select('reviews.review,reviews.created_at,listing_items.id,user.user_name as review_user_name,user.first_name,user.last_name,user.image');
		$this->db->from('reviews');				
		$this->db->join('listing_items','listing_items.id=reviews.user_id');		
		$this->db->join('user','user.id=reviews.user_id');		
		$this->db->where('item_id',$id);
		$query2 = $this->db->get();								

		if ($query->num_rows() > 0) {
			$data['listing_items'] = $query->row();
			$data['shop_timming'] = $query1->result();
			$data['reviews'] = $query2->result();
			return json_encode(array('status'=>1,'data'=>$data));
		}	
	}

	public function getSearchItems()
	{	
		
		$this->db->distinct();		
		$this->db->select('category_name as search_item,id as category_id, "category_type" as type, 0 as item_id');
		$this->db->from('category');				
		$this->db->like('category_name', $this->input->post('keyword'));		
		$this->db->group_by('category.category_name');
		$query1 = $this->db->get_compiled_select();	

		$where = "FIND_IN_SET('".$this->input->post('keyword')."', keywords)"; 

		$this->db->select('business_name as search_item,category_id as category_id, "item_type" as type, id as item_id');
		$this->db->from('listing_items');	
		if(!empty($this->input->post('location'))){
			$this->db->where('city',$this->input->post('location'));
		}			
		$this->db->like('business_name', $this->input->post('keyword'));				
		$this->db->or_where($where);
		$query2 = $this->db->get_compiled_select();		


		$query = $this->db->query($query1 . ' UNION ' . $query2);
		if ($query->num_rows() > 0) {
			return $query->result();		
		}				
	}
	public function getCityList()
	{	
		
		$this->db->distinct();		
		$this->db->select('*');
		$this->db->from('cities');				
		$this->db->like('city_name', $this->input->post('keyword'));		
		$query = $this->db->get();		
		// $this->db->get();		
		// echo $this->db->last_query();
		// die();
		if ($query->num_rows() > 0) {
			return $query->result();		
		}		
	}
	public function getItemRating()
	{		
		$this->db->select('id,item_id,rating');
		$this->db->from('rating');	
		$this->db->where('item_id',$this->input->post('item_id'));									
		$query = $this->db->get();				
		if ($query->num_rows() > 0) {
			return json_encode($query->row());		
		}		
	}
	public function getAllRatingItem(){		

		$this->db->select('count(id) as total_ratings, SUM(rating) as total_rating_sum ,AVG(rating) as rating_average',FALSE);
		$this->db->from('rating');	
		$this->db->where('item_id',$this->input->post('item_id'));									
		$query = $this->db->get();				
		if($query->num_rows() > 0) {
			return json_encode($query->row());			
		}		
	}
	public function submitBasicDetails()
	{		
		if($this->input->post()){
			$msg = '';
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');			
			$this->form_validation->set_rules('business_name', 'Company Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');

			if ($this->form_validation->run() == FALSE){
                $msg.= validation_errors();                
            }
            if (!empty($msg)) {
                return json_encode(array('status'=>0,'msg'=>$msg));
            }else{ 
			
					$userData = array(
						// 'user_type'=>'client',
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name'),						
						'business_name'=>$this->input->post('business_name'),
						'mobile'=>$this->input->post('mobile'),
						'city'=>$this->input->post('city'),
						'land_line'=>$this->input->post('land_line'),
						'is_active'=>0 );
					$lastId = $this->insertData('listing_items',$userData);					
					if($lastId){
						$this->session->set_userdata('last_id',$lastId); 
						return json_encode(array('status'=>1,'last_id'=>$lastId));					
					}else{
						return json_encode(array('status'=>0));					
					}
			}
		}		
	}
	public function submitLocationInfo()
	{		
		if($this->input->post()){
			$msg = '';
			$this->form_validation->set_rules('business_name', 'Business Name', 'required');
			$this->form_validation->set_rules('pin_code', 'Pin Code', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');

			if ($this->form_validation->run() == FALSE){				
                $msg.= validation_errors();                
            }
            if (!empty($msg)) {
                return json_encode(array('status'=>0,'msg'=>$msg));
            }else{ 
				
					$userData = array(
						'business_name'=>$this->input->post('business_name'),
						'building'=>$this->input->post('building'),
						'street_address'=>$this->input->post('street_address'),
						'landmark'=>$this->input->post('landmark'),
						'city'=>$this->input->post('city'),
						'state'=>$this->input->post('state'),
						'pin_code'=>$this->input->post('pin_code'),
						 );
					$Updated = $this->updateData('listing_items',$userData,array('id'=>$this->session->userdata('last_id')));
					if($Updated){
						return json_encode(array('status'=>1));					
					}else{
						return json_encode(array('status'=>0));					
					}
			}
		}		
	}
	public function submitContact()
	{		
		if($this->input->post()){
			$msg = '';
			$this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');			
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');			

			if ($this->form_validation->run() == FALSE){				
                $msg.= validation_errors();                
            }
            if (!empty($msg)) {
                return json_encode(array('status'=>0,'msg'=>$msg));
            }else{ 
				
					$userData = array(
						// 'contact_person'=>$this->input->post('contact_person'),
						'designation'=>$this->input->post('designation'),
						'land_line'=>$this->input->post('land_line'),
						'mobile'=>$this->input->post('mobile'),
						'fax'=>$this->input->post('fax'),
						'toll_free_number'=>$this->input->post('toll_free_number'),
						'email'=>$this->input->post('email'),
						'website'=>$this->input->post('website'),
						'facebook'=>$this->input->post('facebook'),
						'twitter'=>$this->input->post('twitter'),
						'linkedin'=>$this->input->post('linkedin'),
						'others'=>$this->input->post('others')						 );
					$Updated = $this->updateData('listing_items',$userData,array('id'=>$this->session->userdata('last_id')));
					if($Updated){
						return json_encode(array('status'=>1));					
					}else{
						return json_encode(array('status'=>0));					
					}
			}
		}		
	}
	public function submitOthers()
	{		
		if($this->input->post()){
			
								
				foreach ($this->input->post('shop_timing') as $key => $value) {					
					
					$data = array('item_id'=>$this->session->userdata('last_id'),
								  'days'=>$value['days'],
								  'start_from'=>$value['from'],
								  'start_to'=>$value['to'],
								  'is_closed'=>$value['isClosed']
									 );											 		
						$lastId = $this->insertData('shop_timming',$data);
				}
				foreach ($this->input->post('payment_mode') as $key => $value) {					
					
					$exist = $this->db->select('id')->from('payment_modes')->where('item_id',$this->session->userdata('last_id'))->get();		    
						if($value['isChecked']==1){
							$data = array('item_id'=>$this->session->userdata('last_id'),
									  'payment_mode'=>$value['value'] );
							$lastId = $this->insertData('payment_modes',$data);
						}

				}
				if($this->input->post('is_display_hours')){
					$Updated = $this->updateData('listing_items',array('is_display_hours'=>$this->input->post('is_display_hours')),array('id'=>$this->session->userdata('last_id')));
				}

				if($lastId){
					return json_encode(array('status'=>1));					
				}else{
					return json_encode(array('status'=>0));					
				}			
		}		
	}
	public function submitKeywords()
	{		
		if($this->input->post()){				
			$NewsString =implode(',',$this->input->post('keywords')); 

				$Updated = $this->updateData('listing_items',array('keywords'=>$NewsString,'category_id'=>$this->input->post('category_id')),array('id'=>$this->session->userdata('last_id')));
				if($Updated){
					return json_encode(array('status'=>1));					
				}else{
					return json_encode(array('status'=>0));					
				}
		}		
	}
	public function getVerifcationCode()
	{		
		if($this->input->post()){	
			
			if(empty($this->input->post('item_verification_code'))){

				$exist = $this->db->select('mobile')->from('listing_items')->where('id',$this->session->userdata('last_id'))->get();
				if($exist->num_rows() > 0){
					$getMobile = $exist->row();					
					$this->session->set_userdata('temp_item_verification_code',999999); 						
               	    return json_encode(array('status'=>2,'msg'=>'OTP sent to mobile number'));	
				}
			}else if(!empty($this->input->post('item_verification_code'))){
					
				if($this->session->userdata('temp_item_verification_code')==$this->input->post('item_verification_code')){

					$Updated = $this->updateData('listing_items',array('is_mobile_verified'=>1) ,array('id'=>$this->session->userdata('last_id')));					
  					if($Updated){
						return json_encode(array('status'=>1,'msg'=>'Successfully Verified'));	
  					}else{
  						return json_encode(array('status'=>1,'msg'=>'Successfully Verified'));	
  					}
				}
			}else{

				return json_encode(array('status'=>0,'msg'=>'Error'));					
			}
				
		}		
	}
	public function checkCompany()
	{
		if($this->input->post('keyword')){						
			$this->db->select('*');
			$this->db->from('category');				
			$this->db->where('category_name', $this->input->post('keyword'));		
			$query = $this->db->get();				
			if ($query->num_rows() > 0) {
				return $query->result();		
			}		
		}	
	}
	public function submitReview()
	{		
		if($this->input->post()){				

				$userData = array(
								'item_id'=>$this->input->post('item_id'),						
								'user_id'=>$this->input->post('user_id'),
								'review'=>$this->input->post('review'));
      					
    			$lastId = $this->insertData('reviews',$userData);	
				if($lastId){
					return json_encode(array('status'=>1));					
				}else{
					return json_encode(array('status'=>0));					
				}
		}		
	}
	public function giveRating()
	{		
		if($this->input->post()){				
				$exist = $this->db->select('id')->from('rating')->where(array('item_id'=>$this->input->post('item_id'),'user_id'=>$this->input->post('user_id')))->get();
				$userData = array(
							'item_id'=>$this->input->post('item_id'),						
							'user_id'=>$this->input->post('user_id'),
							'rating'=>$this->input->post('stars'));

      			if($exist->num_rows() > 0){
    				$lastId = $this->updateData('rating',$userData,array('item_id'=>$this->input->post('item_id'),'user_id'=>$this->input->post('user_id')));	
      			}else{
    				$lastId = $this->insertData('rating',$userData);	
      			}
				if($lastId){
					return json_encode(array('status'=>1));					
				}else{
					return json_encode(array('status'=>0));					
				}
		}		
	}
	public function productLike()
	{		
		if($this->input->post()){				
				$exist = $this->db->select('id')->from('item_likes')->where(array('item_id'=>$this->input->post('item_id'),'user_id'=>$this->input->post('user_id')))->get()->num_rows();
				if($exist == 0){					
					
					$userData = array(
								'item_id'=>$this->input->post('item_id'),						
								'user_id'=>$this->input->post('user_id'),
								'likes'=>1);					
	    			$lastId = $this->insertData('item_likes',$userData);	
	      			
					if($lastId){
						return json_encode(array('status'=>1));					
					}else{
						return json_encode(array('status'=>0));					
					}
				}

		}		
	}
	

}
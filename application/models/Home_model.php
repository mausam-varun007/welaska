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
			$this->db->select('listing_items.*,category.id as category_id,category.category_name, count(rating.id) as total_ratings, SUM(rating.rating) as total_rating_sum ,AVG(rating.rating) as rating_average ');
			$this->db->from('listing_items');		
			$this->db->join('category','category.id=listing_items.category_id');
			$this->db->join('rating','rating.item_id=listing_items.id','left');
			if($this->input->post('location')!=null){
				$this->db->where('listing_items.city',$this->input->post('location'));
			}
			$this->db->where('category_id',$id);
			$this->db->group_by('listing_items.id');
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
		$this->db->select('listing_items.*,category.id as category_id,category.category_name');
		$this->db->from('listing_items');		
		$this->db->join('category','category.id=listing_items.category_id');
		$this->db->where('listing_items.id',$id);
		$query = $this->db->get();								
		if ($query->num_rows() > 0) {
			return json_encode(array('status'=>1,'data'=>$query->row()));
		}	
	}

	public function getSearchItems()
	{	
		
		$this->db->distinct();
		// $this->db->select('category.*,');
		// $this->db->from('category');				
		// $this->db->select('listing_items.business_name as search_item,category.id as category_id,
		// 	CASE WHEN category.category_name is not null THEN listing_items.business_name ELSE listing_items.business_name  END AS search_item ',FALSE);
		// $this->db->select('listing_items.business_name as search_item,category.id as category_id,category.category_name as search_item');
		// $this->db->from('listing_items');		
		// //$this->db->join('category','category.id=listing_items.category_id','left');
		// //$this->db->where('listing_items.city',$this->input->post('location'));
		// // $this->db->or_where('category.category_name',$this->input->post('keyword'));
		// $this->db->like('category.category_name', $this->input->post('keyword'));
		// $this->db->or_like('listing_items.business_name', $this->input->post('keyword'));
		// $this->db->group_by('category.category_name');
		// // $this->db->order_by('FIELD(category.category_name,listing_items.business_name)');
		// //$this->db->limit(10);		
		// $query = $this->db->get();		
		// $this->db->get();		
		// echo $this->db->last_query();
		// die();
		// if ($query->num_rows() > 0) {
		// 	return $query->result();		
		// }		
		$this->db->select('category_name as search_item,id as category_id, "category_type" as type, 0 as item_id');
		$this->db->from('category');				
		$this->db->like('category_name', $this->input->post('keyword'));		
		$this->db->group_by('category.category_name');
		$query1 = $this->db->get_compiled_select();	

		$this->db->select('business_name as search_item,category_id as category_id, "item_type" as type, id as item_id');
		$this->db->from('listing_items');				
		$this->db->where('city',$this->input->post('location'));
		$this->db->like('business_name', $this->input->post('keyword'));						
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
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');

			if ($this->form_validation->run() == FALSE){
                $msg.= validation_errors();                
            }
            if (!empty($msg)) {
                return json_encode(array('status'=>0,'msg'=>$msg));
            }else{ 
			
					$userData = array('user_type'=>'client',
						'first_name'=>$this->input->post('first_name'),
						'last_name'=>$this->input->post('last_name'),
						'email'=>$this->input->post('email'),
						'company_name'=>$this->input->post('company_name'),
						'mobile'=>$this->input->post('mobile'),
						'city'=>$this->input->post('city'),
						'land_line_number'=>$this->input->post('land_line_number'),
						'is_active'=>1 );
					$lastId = $this->insertData('user',$userData);
					if($lastId){
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
				print_r($this->input->post());
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
						'is_active'=>1 );
					$lastId = $this->insertData('listing_items',$userData);
					if($lastId){
						return json_encode(array('status'=>1,'last_id'=>$lastId));					
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
			$this->form_validation->set_rules('business_name', 'Business Name', 'required');
			$this->form_validation->set_rules('pin_code', 'Pin Code', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('city', 'City', 'required');

			if ($this->form_validation->run() == FALSE){
				print_r($this->input->post());
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
						'is_active'=>1 );
					$lastId = $this->insertData('listing_items',$userData);
					if($lastId){
						return json_encode(array('status'=>1,'last_id'=>$lastId));					
					}else{
						return json_encode(array('status'=>0));					
					}
			}
		}		
	}

}
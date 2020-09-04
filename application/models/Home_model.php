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
		$this->db->select('*');
		$this->db->from('category');				
		$this->db->like('category_name', $this->input->post('keyword'));
		//$this->db->limit(10);		
		$query = $this->db->get();		
		// $this->db->get();		
		// echo $this->db->last_query();
		// die();
		if ($query->num_rows() > 0) {
			return json_encode($query->result());		
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

}
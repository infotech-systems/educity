<?php
Class Photos extends SM_Model
{
	public function photo_dtls()
	{
		$query=$this->db->order_by('cm.cat_id','desc')
		 				->from('photo_master pp')
		 				->join('category_master cm','pp.cat_id=cm.cat_id','LEFT')
		 				->get();
			//echo $this->db->last_query();
			if($query->row())
			{
			return $query->result_array();
			}
			else
			{
			return FALSE;
			}
		 
		 
	}
	public function photo_cat($id,$photo_id)
	{
		 $query=$this->db->order_by('photo_id','desc')
		                 ->where_not_in('photo_id',$photo_id)
		                 ->where('md5(cat_id)', $id)
		                  ->get('photo_master');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function photo_dtls3($limit)
	{
		 $query=$this->db->order_by('photo_id','desc')
		 				  ->limit($limit)
		                  ->get('photo_master');
		//  echo $this->db->last_query();
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function photo_group($limit,$cat_id)
	{
		 $query=$this->db->order_by('cm.cat_id','desc')
		                 ->where(array('pp.cat_id'=>$cat_id))
		 				  ->limit($limit)
		                  ->from('photo_master pp')
						  ->join('category_master cm','pp.cat_id=cm.cat_id','LEFT')
						  ->get();
		 //echo $this->db->last_query();
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_photo($id)
	{
		  $query= $this -> db ->  where('md5(photo_id)', $id)
		                      -> get('photo_master');
		                    
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
		public function show($photo_slug)
	{
		  $query= $this -> db ->  where('photo_slug', $photo_slug)
		                      -> get('photo_master');
		                    
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}

	public function photo_dtls2($limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
		                ->get('photo_master');
		  //              echo $this->db->last_query();
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function num_rows()
	{
		 $query=$this->db->get('photo_master');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function add_data($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('photo_master', $data);
		   return $this->db->insert_id();
	}
	
	
	public function photoname2_check($photoname,$category)
	{
       $query= $this -> db ->where(array('cat_id'=>$category,'photo_nm'=>$photoname))
		                   -> get('photo_master');	

		            					  
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function photoname_check($photoname,$category,$hid)
	{
       $query= $this -> db ->where(array('photo_nm'=>$photoname,'cat_id'=>$category))               
                           ->where_not_in('photo_id',$hid)
		                   -> get('photo_master');	
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function update_data($data,$hid)
	{
		  return $this->db->where('photo_id', $hid)
                      ->update('photo_master', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('md5(photo_id)', $id)
                       ->delete('photo_master');
        
	}
	
}
?>
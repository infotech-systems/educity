<?php
Class Sliders extends SM_Model
{
	
	public function slider_dtls()
	{
		 $query=$this->db->where('show_tag','T')
		  				->get('slider_mas');
		 // echo $this->db->last_query();
		 $this->db->cache_on();
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}

	public function show_slider($id)
	{
		  $query= $this -> db ->  where('md5(slider_id)', $id)
		                      -> get('slider_mas');         
		   //  echo $this->db->last_query();                
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function add_data($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('slider_mas', $data);
		   return $this->db->insert_id();
	}
	
	
	public function slidername_check($slidername,$hid)
	{
        $query=$this->db->where('slider_nm',$slidername)
	   						->where_not_in('slider_id',$hid)
	   -> get('slider_mas');	

		            					  
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
		  return $this->db->where('slider_id', $hid)
                      ->update('slider_mas', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('md5(slider_id)', $id)
                       ->delete('slider_mas');
        
	}

	public function slider_rand()
	{
		 //$this->db1=$this->load->database('site', TRUE);
		 $this->db->order_by('rand()');
    	 $this->db->limit(1);
    	 $query=$this->db->get('slider_mas');
		 //echo $this->db->last_query();
		 $this->db->cache_on();
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	
}
?>
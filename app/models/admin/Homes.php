<?php
Class Homes extends SM_Model
{
	public function home_dtls()
	{
		$query=$this->db->get('home_content_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_home($id)
	{
		  $query= $this -> db ->  where('md5(home_id)', $id)
		                      -> get('home_content_mas');
		  // echo $this->db->last_query();                 
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
           $res=$this->db->insert('home_content_mas', $data);
          
		   return $this->db->insert_id();
	}
	public function update_data($data,$hid)
	{
		  return $this->db->where('home_id', $hid)
                      ->update('home_content_mas', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('home_id', $id)
                       ->delete('home_content_mas');
        
	}
	
}
?>
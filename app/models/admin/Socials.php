<?php
Class Socials extends SM_Model
{
	public function dtls()
	{
		 $query=$this->db->get('social_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	
	public function show($id)
	{
		  $query= $this -> db ->  where('md5(social_id)', $id)
		                      -> get('social_mas');
		                    
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	
	public function num_rows()
	{
		 $query=$this->db->get('social_mas');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function social_dtls2($limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
		                ->get('social_mas');
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
	public function add_data($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('social_mas', $data);
		   return $this->db->insert_id();
	}
	
	
	
	public function update_data($data,$hid)
	{
		  return $this->db->where('social_id', $hid)
                      ->update('social_mas', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('md5(social_id)', $id)
                       ->delete('social_mas');
        
	}
	
}
?>
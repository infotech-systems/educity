<?php
Class Administrations extends SM_Model
{
	
	public function dtls()
	{
		 $query=$this->db->get('adminstration_mas');
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
           $res=$this->db->insert('adminstration_mas', $data);
		   return $this->db->insert_id();
	}
	public function show($id)
	{
		$query= $this->db->where('md5(adm_id)', $id)
						->from('adminstration_mas')  
						->get();       
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
		  return $this->db->where('adm_id', $hid)
                      ->update('adminstration_mas', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('md5(adm_id)', $id)
                       ->delete('adminstration_mas');
        
	}
}
?>
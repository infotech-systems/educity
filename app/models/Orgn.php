<?php
Class Orgn extends SM_Model
{
	public function orgn_dtls()
	{
		 $query=$this->db->get('orgn_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function orgn_dtls2()
	{
		 $query=$this->db->get('orgn_mas');
		 
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_orgn($id)
	{
		  $query= $this -> db ->  where('orgn_id', $id)
		                      -> get('orgn_mas');         
		                    
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
		  return $this->db->where('orgn_id', $hid)
                      ->update('orgn_mas', $data);
echo $this->db->last_query();
	}
	public function login_valid($orgn_name)
	{
		$query=$this->db->select('*')
		                ->from('orgn_mas')
		                ->where(array('orgn_id'=>$orgn_name))
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
	
}
?>
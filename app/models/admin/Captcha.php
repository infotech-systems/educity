<?php
Class Captcha extends SM_Model
{
	public function dtls()
	{
		 $expiration = time() - 7200;
		 $query=$this->db->where('captcha_time < ', $expiration)
		                 ->get('captcha');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	
	public function add_data($data2)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('captcha', $data2);
		   return $this->db->insert_id();
	}
	public function delete_data($id)
	{
		return $this->db->where('captcha_id', $id)
                       ->delete('captcha');
	}
	
}
?>
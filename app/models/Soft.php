<?php
Class Soft extends SM_Model
{
	public function soft_dtls()
	{
		 $query=$this->db->get('soft_mas');
		// echo $this->db->last_Query();
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
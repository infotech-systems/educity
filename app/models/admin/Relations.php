<?php
Class Relations extends CI_Model
{
	public function dtls()
	{
		 $query=$this->db->get('relationship_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}	
    public function class_dtls()
	{
		 $query=$this->db->get('class_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function caste_dtls()
	{
		 $query=$this->db->get('caste_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
    public function batch_dtls()
	{
		 $query=$this->db->get('batch_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
    public function fee_dtls($class_id)
	{
		$query=$this->db->where('class_id',$class_id)
                        ->get('fee_mas');
		 
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
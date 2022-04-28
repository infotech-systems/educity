<?php
Class Users extends CI_Model
{
	public function user_dtls()
	{
		 $query=$this->db->get('user_mas');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_user($id)
	{
		  $query=$this->db->select('uid,user_nm,user_id,current_status') 
		  				  ->select('user_type,photo_path,page_per,orgn_id') 
						  ->select('status,user_cont_no,mail_id,client_id') 
		                  ->where('md5(uid)', $id)
		                  ->get('user_mas');
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function user_dtls2($limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
		                ->get('user_mas');
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
		 $query=$this->db->get('user_mas');
		 
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
           $res=$this->db->insert('user_mas', $data);
		   return $this->db->insert_id();
	}
	
	public function permission($id)
	{
         $query= $this -> db ->  where('md5(uid)', $id)
		                  -> get('user_mas');
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function email_check($email_id,$hid,$orgn_id)
	{
       $query= $this -> db ->where(array('uid'=>$hid,'mail_id'=>$email_id,'orgn_id'=>$orgn_id))
		                  ->where_not_in('uid',$hid)
		                  -> get('user_mas');
					
						  
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
		  return $this->db->where('uid', $hid)
                      ->update('user_mas', $data);
	}
	public function update_page_per($data,$uid)
	{
		return  $this->db->where('uid', $uid)
                         ->update('user_mas', $data);
	}
}
?>
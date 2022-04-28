<?php
Class Mails extends SM_Model
{
	public function add_data($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('mailbox', $data);
		   return $this->db->insert_id();
	}
	public function dtls($type,$limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
		                 ->select('mail_id,mail_from,sender_name,mail_to,attachments')
						 ->select('mail_subject,mail_content,mail_message,mail_time')
						 ->where('mail_type',$type)
                         ->from('mailbox')
                         ->order_by('mail_time','desc')
                         ->get();
                        // echo $this->db->last_query();    
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function num_rows($type)
	{
		 $query=$this->db->select('mail_id')
		  				->where('mail_type',$type)
		                ->get('mailbox');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show($id)
	{
		  $query= $this->db->where('mail_id', $id)
						   ->from('mailbox')  
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
	
	public function inquiry_dtls($type)
	{
		 $query=$this->db->select('mail_id,mail_from,sender_name,mail_to')
						 ->select('mail_subject,mail_content,mail_time,mobile_no')
						 ->where('mail_type',$type)
                         ->from('mailbox')
                         ->order_by('mail_time','desc')
                         ->get();
                        // echo $this->db->last_query();    
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
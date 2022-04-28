<?php
Class Students extends SM_Model
{
	public function admission_approva_pending()
	{
		$query=$this->db->from('student_mas s')
						->where('s.status','D')
			->join('class_mas cm','s.class_id=cm.class_id','LEFT')
			->join('batch_mas bm','s.batch_id=bm.batch_id','LEFT')
		->get();
			//echo $this->db->last_query();
			if($query->row())
			{
			return $query->result_array();
			}
			else
			{
			return FALSE;
			}
		 
		 
	}
	public function dtls()
	{
		$query=$this->db->from('student_mas s')
						->where('s.status','A')
			->join('class_mas cm','s.class_id=cm.class_id','LEFT')
			->join('batch_mas bm','s.batch_id=bm.batch_id','LEFT')
		->get();
			//echo $this->db->last_query();
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
           $res=$this->db->insert('student_mas', $data);
          
		   return $this->db->insert_id();
	}
	public function add_trans($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('trans_mas', $data);
          
		   return $this->db->insert_id();
	}
	public function add_inv($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('invoice_mas', $data);
          
		   return $this->db->insert_id();
	}
	
	public function update_data($data,$hid)
	{
		  return $this->db->where('student_id', $hid)
                      ->update('student_mas', $data);

	}
	public function update_receive($data,$hid)
	{
		  return $this->db->where('tr_id', $hid)
                      ->update('trans_mas', $data);

	}
	
	public function update_due($amt,$bill_no)
	{
		return $this->db->where(array('bill_no'=>$bill_no))
						->set('due_amt','due_amt-'.$amt,FALSE)
                      ->update('trans_mas');
		 

	}
	public function delete_data($id)
	{
		return $this->db->where('student_id', $id)
                       ->delete('student_mas');
        
	}
	public function student_check($contact_no)
	{
		$year=date('Y');
       $query= $this -> db ->where(array('mobile_no'=>$contact_no,'year'=>$year))               
		                   -> get('student_mas');	
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_student($id)
	{
		  $query= $this -> db ->  where('md5(student_id)', $id)
		                      -> get('student_mas');
		                    
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function adm_pending_app_receipt($id)
	{
		  $query= $this -> db ->  where(array('md5(student_id)'=>$id,'status'=>'D'))
		                      -> get('trans_mas');
		                    
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
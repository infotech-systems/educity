<?php
Class Loginmodel extends SM_Model
{
	public function login_valid($usernmae)
	{
		$query=$this->db->select('*')
		                ->from('user_mas')
						//->where(array('user_id'=>$usernmae,'pwd'=>$password))
		               ->where(array('user_id'=>$usernmae,'status'=>'A'))
		                ->get();
				//		echo $this->db->last_query();
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
          $this->db->insert('user_log_mas', $data);
	}
	public function login_log_id($uid)
	{
		$query=$this->db->select_max('id')
		                ->from('user_log_mas')
		                ->where(array('uid'=>$uid,'logout_on'=>'0000-00-00 00:00:00'))
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
	public function log_time($chk_id)
	{
		$query=$this->db->select('login_on')
		                ->from('user_log_mas')
		                ->where(array('id'=>$chk_id))
		                ->get();
			//			echo $this->db->last_query();
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
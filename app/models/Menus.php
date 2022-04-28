<?php
Class Menus extends SM_Model
{
	public function menu_dtls($id)
	{
		  $query= $this -> db ->  where('md5(id)', $id)
		                  -> get('dyn_menu');
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function dtls_method($param2)
	{
		$portal_type=$this->session->userdata('portal_type');		  
		$query= $this -> db->select('id,title,uri,url')
		 ->where(array('url'=>$param2))
		 ->where_in('p_type',array('',$portal_type))
		 -> get('dyn_menu');
							 
       // echo $this->db->last_query();
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function dtls_parent($param1)
	{
		  $portal_type=$this->session->userdata('portal_type');		
		  $query= $this -> db->select('id,title,uri,url,parent_id')
							 ->where(array('url'=>$param1))
		 					 ->where_in('p_type',array('',$portal_type))
		                     -> get('dyn_menu');
			//	 echo $this->db->last_query();				
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function dtls_main_parent($param3)
	{
		 $portal_type=$this->session->userdata('portal_type');		
		  $query= $this -> db->select('id,title,uri,url,parent_id')
		 					 ->where(array('id'=>$param3))
		 					 ->where_in('p_type',array('',$portal_type))
		                     -> get('dyn_menu');
					//		 echo $this->db->last_query();
							
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function page_per($type)
	{
		  $query= $this -> db->select('id')
		                     ->  like('acces_tag',$type)
		                     -> get('dyn_menu');
			
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function main_menu()
	{
		 $portal_type=$this->session->userdata('portal_type');
		 $query=$this->db->where_in(array('p_type'=>$portal_type))
		                   ->get('dyn_menu');
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function sublavel_id($sub_level_id)
	{
		 $query=$this->db->where('parent_id',$sub_level_id)
		                   ->get('dyn_menu');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	
	
	public function dtls_permission($param)
	{
		  $portal_type=$this->session->userdata('portal_type');
		  $user_type=$this->session->userdata('user_type');
		  $page_per=explode(',',$this->session->userdata('page_per'));
			  $this->db->select('id');
			  $this->db->where(array('url'=>$param));
			  $this->db->where_in('p_type',array('',$portal_type));
			/*  if($portal_type!='P')
			  {
				if($user_type!='A')
				{		
					$this->db->where_in('id',$page_per);
				}
			  }*/
		  $query=$this->db->get('dyn_menu');
		 // echo $this->db->last_query();
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
		 $query=$this->db->get('dyn_menu');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function dtls2($limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
			 		 ->order_by('parent_id,position','asc')
		                ->get('dyn_menu');
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
	public function dtls()
	{
		 $query=$this->db->order_by('parent_id,position','asc')
		                ->get('dyn_menu');
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
	public function show_menu($id)
	{
		  $query= $this -> db ->  where('id', $id)
		                      -> get('dyn_menu');
							    //              echo $this->db->last_query();
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
		   $this->db->set($data);	
           $res=$this->db->insert('dyn_menu', $data);
		   return $this->db->insert_id();
	}
	public function update_data($data,$hid)
	{
		  return $this->db->where('id', $hid)
                      ->update('dyn_menu', $data);
	}
	public function delete_data($id)
	{
		return $this->db->where('md5(id)', $id)
                        ->delete('dyn_menu');
        
	}

	
}
?>
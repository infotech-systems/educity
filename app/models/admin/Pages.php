<?php
Class Pages extends CI_Model
{
	public function page_dtls()
	{
		 $query=$this->db->order_by('parent_id,srl','asc')
		                 ->get('page_master');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function page_dtls2()
	{
		 $query=$this->db->order_by('parent_id,srl','asc')
		                ->get('page_master');
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
		 $query=$this->db->get('page_master');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_page($id)
	{
		  $query= $this -> db ->  where('md5(page_id)', $id)
		                      -> get('page_master');
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_page2($url)
	{
		  $query= $this -> db ->  where(array('page_link'=> $url))
							  -> get('page_master');
					//		  echo $this->db->last_query();
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function page_slug($page_slug)
	{
		  $query= $this -> db ->  where('page_slug', $page_slug)
							  -> get('page_master');
					//		  echo $this->db->last_query();
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
           $res=$this->db->insert('page_master', $data);
		   return $this->db->insert_id();
	}
	
	public function parent_show($parent_id)
	{
         $query= $this -> db ->  where('parent_id', $parent_id)
		                  -> get('page_master');
						//  echo $this->db->last_query();
		   if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function page_check($pagename,$hid)
	{
       $query= $this -> db ->where(array('page_name'=>$pagename))
		                  ->where_not_in('page_id',$hid)
		                  -> get('page_master');						  
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function page_check2($pagename)
	{
       $query= $this -> db ->where('page_name',$pagename)
		                  -> get('page_master');						  
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
		  return $this->db->where('page_id', $hid)
                      ->update('page_master', $data);
	}
	public function delete_data($id)
	{
		return $this->db->where('md5(page_id)', $id)
                        ->delete('page_master');
        
	}
	
}
?>
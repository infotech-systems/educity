<?php
Class Categorys extends SM_Model
{
	public function category_dtls()
	{
		 $query=$this->db->get('category_master');
		 
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_category($id)
	{
		  $query= $this -> db ->  where('md5(cat_id)', $id)
		                      -> get('category_master');         
		                    
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show($cat_slug)
	{
		  $query= $this -> db ->  where('cat_slug', $cat_slug)
		                      -> get('category_master');         
		                    
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function rand_category()
	{
		$query=$this->db->order_by('rand()')
		                ->limit('4')
		                ->from('category_master cm')  
						->join('photo_master pm','pm.cat_id=cm.cat_id')
						->group_by('pm.cat_id')
		                ->get();         
		                    
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }	
	}
	public function photo_category()
	{
		$query=$this->db->order_by('cm.cat_nm','asc')
		                ->from('category_master cm')  
						->join('photo_master pm','pm.cat_id=cm.cat_id')
						->group_by('pm.cat_id')
		                ->get();    
		             //   echo $this->db->last_query();
		                    
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
           $res=$this->db->insert('category_master', $data);
		   return $this->db->insert_id();
	}
	
	
	public function catname_check($catname,$hid)
	{
       $query= $this -> db ->where('cat_nm',$catname)
		                  ->where_not_in('cat_id',$hid)
		                  -> get('category_master');	

		            					  
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
		  return $this->db->where('cat_id', $hid)
                      ->update('category_master', $data);

	}
	public function delete_data($id)
	{
		return $this->db->where('md5(cat_id)', $id)
                       ->delete('category_master');
        
	}
	
}
?>
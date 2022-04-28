<?php
Class Medias extends SM_Model
{
	public function add_data($data)
	{
		   $this->db->set($data);	
           $this->db->insert('media_mas', $data);
		   return $this->db->insert_id();
	}
	public function media_dtls()
	{
		 $query=$this->db->get('media_mas');
		 
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
		 $query=$this->db->get('media_mas');
		 
		 if($query->row())
		 {
		 	return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function media_dtls2($limit,$offset)
	{
		 $query=$this->db->limit($limit,$offset)
		                ->get('media_mas');
		 if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_media($id)
	{
		  $query= $this -> db ->  where('md5(media_id)', $id)
		                      -> get('media_mas');         
		                    
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function delete_data($id)
	{
		return $this->db->where('md5(media_id)', $id)
                       ->delete('media_mas');
        
	}
	
}
?>
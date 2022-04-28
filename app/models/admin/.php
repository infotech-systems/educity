<?php
Class Projects extends SM_Model
{
	
	public function dtls()
	{
		 $query=$this->db->get('project_mas');
		// $this->db->cache_on();
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
         $query=$this->db->select('id')
                         ->from('project_mas')
                         ->order_by('id','desc')
                         ->get();
                        // echo $this->db->last_query();    
		 if($query->row())
		 {
			return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function project_dtls()
	{
         $query=$this->db->select('id,project_date,project_name,project_slug,project_description,project_photo,status')
                         ->from('project_mas')
                         ->order_by('id','desc')
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
	public function cat_wise_total_project()
	{
         $query=$this->db->select('count(pm.id) as total,cm.cat_nm,cm.cat_slug')
						 ->from('project_mas pm')
						 ->group_by('pm.cat_id')
						 ->join('category_master cm','pm.cat_id=cm.cat_id','LEFT')
                         ->get();
                     //  echo $this->db->last_query();    
		 if($query->row())
		 {
			return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
    }
	public function show_project($limit)
	{
		  $query= $this->db->limit($limit)
		  				   ->order_by('id','desc')
		                   -> get('project_mas');         
		if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_photo($project_id,$limit)
	{
		  $query= $this->db->limit($limit)
		                   ->where('project_id',$project_id)
		  				   ->order_by('pm_id','desc')
		                   -> get('project_photo');         
		if($query->row())
		 {
		 	return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show($project_slug)
	{
		  $query= $this->db->where('pm.project_slug', $project_slug)
						   ->from('project_mas pm')  
						   ->join('category_master cm','pm.cat_id=cm.cat_id','LEFT')
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
	public function add_data($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('project_mas', $data);
		   return $this->db->insert_id();
	}
	public function add_comment($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('project_comments', $data);
		   return $this->db->insert_id();
	}
	
	
	
	public function name_check($project_name,$hid)
	{
       $query= $this -> db ->where('project_name',$project_name)
		                  ->where_not_in('id',$hid)
		                  -> get('project_mas');	

		            					  
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function project_check($project_name)
	{
       $query=$this->db->where('project_name',$project_name)
		                -> get('project_mas');	
            					  
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
		  return $this->db->where('id', $hid)
                      ->update('project_mas', $data);

	}
	public function show2($id)
	{
		$query= $this->db->where('pm.id', $id)
						->from('project_mas pm')  
						->join('category_master cm','pm.cat_id=cm.cat_id','LEFT')
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
	public function delete_data($id)
	{
		return $this->db->where('id', $id)
                       ->delete('project_mas');
        
	}
	public function delete_comment_project($id)
	{
		return $this->db->where('project_id', $id)
                       ->delete('project_comments');
        
	}
	public function comment_dtls($project_id)
	{
		 $query=$this->db->select('id,comment_parent,comments,commenter_nm,commenter_photo')
		 				 ->select('commenter_contact,commenter_email,comment_time,comment_parent')
						 ->where(array('project_id'=>$project_id,'approval_status'=>'Y'))					 
                         ->from('project_comments')
                         ->get();
                     //    echo $this->db->last_query();    
		 if($query->row())
		 {
            return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_comment($comment_id)
	{
		 $query=$this->db->select('cm.id,cm.comment_parent,cm.comments,cm.commenter_nm,cm.commenter_photo,cm.project_id')
		 				 ->select('cm.commenter_contact,cm.commenter_email,cm.comment_time,cm.comment_parent,pm.project_slug')
						 ->where(array('md5(cm.id)'=>$comment_id,'cm.approval_status'=>'Y'))					 
						 ->from('project_comments cm')
						 ->join('project_mas pm','cm.project_id=pm.id','LEFT')
                         ->get();
                        // echo $this->db->last_query();    
		 if($query->row())
		 {
            return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function photo_dtls()
	{
		$query=$this->db->select('pp.pm_id,pp.project_id,pp.photo_name,pp.photo_path,pm.project_name')
						->from('project_photo pp')
						->join('project_mas pm','pp.project_id=pm.id','LEFT')
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
	public function add_photo($data)
	{
		   $this->db->set($data);	
           $res=$this->db->insert('project_photo', $data);
		   return $this->db->insert_id();
	}
	public function project_photo_check($project_id,$photoname)
	{
       $query=$this->db->where(array('project_id'=>$project_id,'photo_name'=>$photoname))
		                -> get('project_photo');	
            					  
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function project_photo_dtls($id)
	{
		$query=$this->db->where('pm_id',$id)
		                ->get('project_photo');         
		if($query->row())
		 {
			return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function project_photo_check2($project_id,$photoname,$hid)
	{
	   	$query=$this->db->where(array('project_id'=>$project_id,'photo_name'=>$photoname))
						->where_not_in('pm_id',$hid)
		                -> get('project_photo');	
            					  
		 if($query->num_rows())
		 {
		 	return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function update_photo($data,$hid)
	{
		  return $this->db->where('pm_id', $hid)
                      ->update('project_photo', $data);

	}
	public function photo_delete($id)
	{
		return $this->db->where('pm_id', $id)
                       ->delete('project_photo');
        
	}
	public function category_num_rows($category)
	{
		$query=$this->db->select('pm.id,cm.cat_nm,cm.cat_slug')
						->where('cm.cat_slug',$category)
						->from('project_mas pm')
						->join('category_master cm','pm.cat_id=cm.cat_id','LEFT')
						->get();
		 if($query->row())
		 {
			return $query->num_rows();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function category_project_dtls($limit,$offset,$category)
	{
         $query=$this->db->select('pm.id,pm.project_date,pm.project_name,pm.project_slug,pm.project_description,pm.project_information,pm.project_photo,pm.status')
						 ->limit($limit,$offset)
						 ->where('cm.cat_slug',$category)
						 ->from('project_mas pm ')
						 ->join('category_master cm','pm.cat_id=cm.cat_id','LEFT')
                         ->order_by('pm.id','desc')
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
	public function comment_all()
	{
		 $query=$this->db->select('pc.id,pc.comment_parent,pc.comments,pc.commenter_nm,pc.commenter_photo,pc.approval_status')
		 				 ->select('pc.commenter_contact,pc.commenter_email,pc.comment_time,pc.comment_parent,pm.project_name')
						 ->from('project_comments pc')
						 ->join('project_mas pm','pm.id=pc.project_id','LEFT')
                         ->get();
                     //    echo $this->db->last_query();    
		 if($query->row())
		 {
            return $query->result_array();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function show_comment2($comment_id)
	{
		 $query=$this->db->select('cm.id,cm.comment_parent,cm.comments,cm.commenter_nm,cm.commenter_photo,cm.project_id')
		 				 ->select('cm.commenter_contact,cm.commenter_email,cm.comment_time,cm.comment_parent,pm.project_slug')
						 ->select('pm.project_name,cm.approval_status')
						  ->where(array('md5(cm.id)'=>$comment_id))					 
						 ->from('project_comments cm')
						 ->join('project_mas pm','cm.project_id=pm.id','LEFT')
                         ->get();
                      //  echo $this->db->last_query();    
		 if($query->row())
		 {
            return $query->row();
		 }
		 else
		 {
		 	return FALSE;
		 }
	}
	public function update_comment($data,$hid)
	{
		  return $this->db->where('id', $hid)
                      ->update('project_comments', $data);

	}
	public function delete_comment($id)
	{
		return $this->db->where(array('md5(id)'=>$id))			
                       ->delete('project_comments');
        
	}
	
	
}
?>
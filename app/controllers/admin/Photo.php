<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/photos','photos');
	   $this->load->model('admin/categorys','categorys');
	   $this->load->library('image_lib');
	 }

	public function index()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$branch_id=$this->session->userdata('branch_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
		
			$param1='admin/photo';
			$permission= $this->menus->dtls_permission($param1);
			if(!empty($permission))
			{
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				if($param3!='0')
				{
				$data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				$data['soft']  = $this->soft->soft_dtls($sid);
				$data['catagorys']=$this->categorys->category_dtls();
				$data['photos'] = $this->photos->photo_dtls($branch_id);
				$this->load->view('admin/photo',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
			
	}
	public function add()
	{
		
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/photo/add';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/photo';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['categorys'] = $this->categorys->category_dtls();
				 $this->load->view('admin/photo-add',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
		else
		{
			return redirect('admin/login');
		}
	}
	public function adds()
	{
	   $data = array('success' => false, 'messages' => array());

		$this->form_validation->set_rules('photoname', 'Photo Name', 'trim|required|callback_check_photoname2');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			$data=array(
			'photo_nm'=>$this->input->post('photoname'),
			'photo_slug'=>url_title($this->input->post('photoname'), 'dash', true),	
			'cat_id'=>$this->input->post('category'),				
			'photo_content'=>$this->input->post('ckeditor'),			
			);
			$config['upload_path']          = './uploads/photo/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('photo'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('photoname'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['photo_path']=$ccc['new_image'];
				} 
		    }		  
            
			$res = $this->photos->add_data($data);	
			
			if($res==true)
			{
			//  $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
			  $data['success'] = true; 
			  $data['message'] = 'Your data Add Successfully..'; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
			}
			
		}
		else
		{
			foreach ($_POST as $key => $value) 
			{
				$data['messages'][$key] = form_error($key);
			}
		}

	echo json_encode($data);
	}
	
	public function edit($id)
	{
		
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/photo/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/photo';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['categorys'] = $this->categorys->category_dtls();
				 $data['photos'] = $this->photos->show($id);
				 
				 $this->load->view('admin/photo-edit',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
		else
		{
			return redirect('admin/login');
		}
	}
	public function update()
	{

	  $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('photoname', 'Photo Name', 'trim|required|callback_check_photoname');		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
			'photo_nm'=>$this->input->post('photoname'),
			'photo_slug'=>url_title($this->input->post('photoname'), 'dash', true),	
			'cat_id'=>$this->input->post('category'),				
			'photo_content'=>$this->input->post('ckeditor'),		
			);
				  
			$config['upload_path']          = './uploads/photo/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            
            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('photoname'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['photo_path']=$ccc['new_image'];
				} 
		    }
		    	  
            
			$res = $this->photos->update_data($data,$hid);	
			if($res)
			{
			   //$this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
			   $data['success'] = true; 
			   $data['message'] = 'Your data modification Successfully..'; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not update, some error occurred');");
			}
		}
		else
		{
			foreach ($_POST as $key => $value) 
			{
				$data['messages'][$key] = form_error($key);
			}
		}

	    echo json_encode($data);
	}
	public function check_photoname2()
	{
	       $photoname=$this->input->post('photoname');
		    $category=$this->input->post('category');
			$branch_id=$this->session->userdata('branch_id');
			$return_value= $this->photos->photoname2_check($photoname,$category,$branch_id);	
			if($return_value=='')
	       {
	        
	        return TRUE;
	    }
	    else
	    {
	    	return FALSE;
	    }
	 } 
    public function check_photoname()
	{
	       $photoname=$this->input->post('photoname');
		    $category=$this->input->post('category');
			$branch_id=$this->session->userdata('branch_id');
			$hid=$this->input->post('hid');
			$return_value= $this->photos->photoname_check($photoname,$category,$hid,$branch_id);	
			if($return_value=='')
	       {
	        
	        return TRUE;
	    }
	    else
	    {
	    	return FALSE;
	    }
	 } 
    
	public function delete($id)
	{
		$photos = $this->photos->show_photo($id);
		if(!empty($photos->photo_path))
		{
			$path=".$photos->photo_path"; 
			unlink($path);			
	   }
	   $res = $this->photos->delete_data($id);
			
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	   return redirect('admin/photo');	
				
	}
	public function resize($img_data,$new_name) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/photo/'.$new_name.''.$img_data['file_ext'];
		$config['maintain_ratio'] = false;
		$config['create_thumb'] = false;
        $config['quality'] = '80%';
	    $config['wm_overlay_path'] = './assets/public/img/logo.png';
        $config['wm_type'] = 'overlay'; 
		$config['wm_opacity']   = '10';
        $config['wm_x_transp'] = '9';
        $config['wm_y_transp'] = '9';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_padding'] = '0';
		
		$config['width'] = 400;
		$config['height'] = 300;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 1);
		$data['img_src'] = base_url() . $data['new_image'];
		//$this->image_lib->watermark();
		$this->image_lib->resize();  
		
		unlink('./uploads/photo/'.$img_data['file_name']);
		return $data;
  }	
		
}
?>
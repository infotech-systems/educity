<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/blogs');
	 }
	public function index()
	{
		$branch_id = $this->session->userdata('branch_id');
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param='admin/tag';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$parent = $this->menus->dtls_parent($param);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
	       	
				$data['tags'] = $this->blogs->all_tags();
				
	 			$this->load->view('admin/tag',$data);
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
				$param2='admin/tag/add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/tag';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $this->load->view('admin/tag-add',$data);
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
	   $this->form_validation->set_rules('tag_desc', 'Name', 'trim|required');
	   $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			$data=array(
				'tag_desc'=>$this->input->post('tag_desc'),
                'tag_slug'=>url_title($this->input->post('tag_desc'), 'dash', true),

			);
			$res = $this->blogs->add_tag_data($data);	
			if($res==true)
			{
			  //$this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
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
	    $user_type = $this->session->userdata('user_type');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/tag/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/tag';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['tag'] = $this->blogs->show_tag($id);
				 $this->load->view('admin/tag-edit',$data);
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
      $this->form_validation->set_rules('tag_desc', 'Name', 'trim|required');
      $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
			
		    $hid=$this->input->post('hid');
			$data=array(
				'tag_desc'=>$this->input->post('tag_desc'),
                'tag_slug'=>url_title($this->input->post('tag_desc'), 'dash', true),

			);
          		
			$res = $this->blogs->update_tag($data,$hid);	
			if($res)
			{
			 //  $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
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
	
	  

	public function delete($id)
	{
		
		$res = $this->blogs->delete_tag($id);
		if($res)
		{
			$this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			$data['success'] = true; 
		}
		else
		{
			$this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
		return redirect('admin/tag');	
				
	}
	public function resize($img_data) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/teacher/'.$img_data['file_name'];
		$config['maintain_ratio'] = false;
		$config['create_thumb'] = false;
        $config['quality'] = '80%';
	  /*  $config['wm_overlay_path'] = './assets/public/img/logo.png';
        $config['wm_type'] = 'overlay'; 
		$config['wm_opacity']   = '10';
        $config['wm_x_transp'] = '9';
        $config['wm_y_transp'] = '9';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_padding'] = '0';*/
		
		$config['width'] = 278;
		$config['height'] = 397;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 1);
		$data['img_src'] = base_url() . $data['new_image'];
		//$this->image_lib->watermark();
		$this->image_lib->resize();  
		
		return $data;
  }	
		
		
}
?>
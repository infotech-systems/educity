<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/pages','pages');
	   $this->load->library('image_lib');
	 }
	public function index()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');

		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param='admin/page';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/page';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);				
				$data['pages'] = $this->pages->page_dtls2();
				$data['allpages'] = $this->pages->page_dtls();
				
	 			$this->load->view('admin/page',$data);
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
				$param1='admin/page-add';
				$permission= $this->menus->dtls_permission($param1);
				if(!empty($permission))
				{
					 $param1='admin/page';
					 $param2='admin/page-add';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $pages  = $this->pages->page_dtls();
				     $data['pages']  = $pages;
					

					 $this->load->view('admin/page-add',$data);
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

		$this->form_validation->set_rules('pagename', 'Page Name', 'trim|required|callback_check_page2');
		$this->form_validation->set_rules('page_publish', 'Page Published', 'trim|required');
		$this->form_validation->set_rules('page_serial', 'Page Position', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			if($this->input->post('page_parent'))
			{
				$page_parent=$this->input->post('page_parent');
			}
			else
			{
				$page_parent='0';
			}
		
			$data=array(
			'page_name'=>$this->input->post('pagename'),
			'page_link'=>$this->input->post('page_url'),
			'parent_id'=>$page_parent,
			'page_content'=>$this->input->post('ckeditor'),
			'srl'=>$this->input->post('page_serial'),
			'show_tag'=>$this->input->post('page_publish'),
			'page_slug'=>url_title($this->input->post('pagename'), 'dash', true),
			'is_parent'=>$this->input->post('parent'),
			'meta_keywords'=>$this->input->post('meta_keywords'),
			'meta_desc'=>$this->input->post('meta_desc'),
			);
			$config['upload_path']          = './uploads/page/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('page_slider'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('pagename'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['page_slider']=$ccc['new_image'];
				} 
		    }	
			//print_r($data);			  
            
			$res = $this->pages->add_data($data);	
			
			if($res==true)
			{
			//  $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
			  $data['message'] = 'Your data Add Successfully..'; 
			  $data['success'] = true; 
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
			$param2='admin/page-edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/page';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['pages2'] = $this->pages->page_dtls();
				 $data['pages'] = $this->pages->show_page($id);
				 $this->load->view('admin/page-edit',$data);
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
		$this->form_validation->set_rules('pagename', 'Page Name', 'trim|required|callback_check_page');
		$this->form_validation->set_rules('page_publish', 'Page Published', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			if($this->input->post('page_parent'))
			{
				$page_parent=$this->input->post('page_parent');
			}
			else
			{
				$page_parent='0';
			}
		    $hid=$this->input->post('hid');
			$data=array(
			'page_name'=>$this->input->post('pagename'),
			'page_link'=>$this->input->post('page_url'),
			'parent_id'=>$page_parent,
			'page_content'=>$this->input->post('ckeditor'),
			'srl'=>$this->input->post('page_serial'),
			'show_tag'=>$this->input->post('page_publish'),
			'page_slug'=>url_title($this->input->post('pagename'), 'dash', true),
			'is_parent'=>$this->input->post('parent'),
			'meta_keywords'=>$this->input->post('meta_keywords'),
			'meta_desc'=>$this->input->post('meta_desc'),
			);
			$config['upload_path']          = './uploads/page/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('page_slider'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('pagename'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['page_slider']=$ccc['new_image'];
				} 
		    }	
			$res = $this->pages->update_data($data,$hid);	
			if($res)
			{
			//   $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
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
	public function check_page()
	{
		$pagename=$this->input->post('pagename');
		$hid=$this->input->post('hid');

		$return_value= $this->pages->page_check($pagename,$hid);	
		if($return_value=='')
		{
		
		return TRUE;
        }
        else
        {
        	return FALSE;
        }
	  }
	  public function check_page2()
	   {
	        $pagename=$this->input->post('pagename');
			$return_value= $this->pages->page_check2($pagename);	
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
		$page = $this->pages->show_page($id);
		if(!empty($page->page_slider))
		{
			$path=".$page->page_slider"; 
			unlink($path);
	    }
		   $res = $this->pages->delete_data($id);
		   if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
			}
		    return redirect('admin/page');	
				
	}
	public function resize($img_data,$new_name) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/page/'.$new_name.''.$img_data['file_ext'];
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
		
		$config['width'] = 1920;
		$config['height'] = 900;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 1);
		$data['img_src'] = base_url() . $data['new_image'];
		//$this->image_lib->watermark();
		$this->image_lib->resize();  
		
		unlink('./uploads/page/'.$img_data['file_name']);
		return $data;
  }	
		
		
}
?>
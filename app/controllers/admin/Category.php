<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/categorys','categorys');
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
			$param='admin/category';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param='admin/category';
				$parent = $this->menus->dtls_parent($param);
				$param3=$parent->parent_id;
				
				if($param3!='0')
				{
					$data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				$data['categorys'] = $this->categorys->category_dtls();
				$data['soft']  = $this->soft->soft_dtls($sid);
				$this->load->view('admin/category',$data);
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
			$param2='admin/category/add';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/category';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->view('admin/category-add',$data);
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

		$this->form_validation->set_rules('catname', 'Category Name', 'trim|required|is_unique[category_master.cat_nm]');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data=array(
			'cat_nm'=>$this->input->post('catname'),	
			'cat_slug'=>url_title($this->input->post('catname'), 'dash', true),		
			'cat_content'=>$this->input->post('ckeditor'),			
			);
			$config['upload_path']          = './uploads/category/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
          //  $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('cat_photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();
				$new_name=url_title($this->input->post('catname'), 'dash', true);
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['photo']=$ccc['new_image'];
				} 
		    }		  
            
			$res = $this->categorys->add_data($data);	
			
			if($res==true)
			{
			 // $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
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
	public function edit($cat_slug)
	{
		
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/category/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/category';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['categorys'] = $this->categorys->show($cat_slug);
				 $this->load->view('admin/category-edit',$data);
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
		$this->form_validation->set_rules('catname', 'Category Name', 'trim|required|callback_check_catname');		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$id=$hid;
			$data=array(
			'cat_nm'=>$this->input->post('catname'),			
			'cat_content'=>$this->input->post('ckeditor'),	
			'cat_slug'=>url_title($this->input->post('catname'), 'dash', true),			
			);
				  
			$config['upload_path']          = './uploads/category/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('cat_photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();
				$new_name=url_title($this->input->post('catname'), 'dash', true);
				$ccc=$this->resize($img_data,$new_name);
				if($img_data['file_name']!="")
				{
					 $data['photo']=$ccc['new_image'];
				} 
		    }
			$res = $this->categorys->update_data($data,$hid);	
			if($res)
			{
			  // $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
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
	public function check_catname()
	{
	       $catname=$this->input->post('catname');
		    $hid=$this->input->post('hid');
			$return_value= $this->categorys->catname_check($catname,$hid);	
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
		$categorys = $this->categorys->show_category($id);
		if(!empty($categorys->photo))
		{
			$path=".$categorys->photo"; 
			unlink($path);
	   }
	   $res = $this->categorys->delete_data($id);
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	    return redirect('admin/category');	
				
	}
    public function resize($img_data,$new_name) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/category/'.$new_name.''.$img_data['file_ext'];
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
		
		$config['width'] = 300;
		$config['height'] = 211;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 1);
		$data['img_src'] = base_url() . $data['new_image'];
		//$this->image_lib->watermark();
		$this->image_lib->resize();  
		
		unlink('./uploads/category/'.$img_data['file_name']);
		return $data;
		
  }		
		
}
?>
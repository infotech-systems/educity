<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/sliders','slider');
	   $this->load->library('image_lib');
	 }
	public function index()
	{
		$id=$this->session->userdata('soft_id');
		$username = $this->session->userdata('user_id');
		$branch_id = $this->session->userdata('branch_id');

		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param1='admin/slider';
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
				$data['sliders'] = $this->slider->slider_dtls($branch_id);
				$data['soft']  = $this->soft->soft_dtls($id);
				$this->load->view('admin/slider',$data);
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
				$param2='admin/slider-add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/slider';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $this->load->view('admin/slider-add',$data);
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

		$this->form_validation->set_rules('slidername', 'Slider Name', 'trim|required|is_unique[slider_mas.slider_nm]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			$data=array(
			'slider_nm'=>$this->input->post('slidername'),			
			'slider_content'=>$this->input->post('ckeditor'),	
			'show_tag'=>$this->input->post('slider_publish'),			
			);
			$config['upload_path']          = './uploads/slider/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            //$config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('slider_photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
				$img_data = $this->upload->data();		
				$new_name=url_title($this->input->post('slidername'), 'dash', true);
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['image_path']='/'.$ccc['new_image'];
				} 
		    }
			$res = $this->slider->add_data($data);	
			
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
	    $user_type = $this->session->userdata('user_type');
	    $page_pers = explode(',',$this->session->userdata('page_per'));
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			if($user_type!='A')
			{
				$param='admin/slider-edit';
				$permission= $this->menus->dtls_permission($param,$page_pers);
				if(!empty($permission))
				{
					 $param1='admin/slider';
					 $param2='admin/slider-edit';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $data['sliders'] = $this->slider->show_slider($id);
					
					 $this->load->view('admin/slider-edit',$data);
					}
					else
					{
						return redirect('admin/dashboard');
					}
				}
				else
				{
					 $param1='admin/slider';
					 $param2='admin/slider-edit';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $data['sliders'] = $this->slider->show_slider($id);
					 $this->load->view('admin/slider-edit',$data);
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
		$this->form_validation->set_rules('slidername', 'Slider Name', 'trim|required|callback_check_slidername');		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
			'slider_nm'=>$this->input->post('slidername'),			
			'slider_content'=>$this->input->post('ckeditor'),	
			'show_tag'=>$this->input->post('slider_publish'),			
			);
				  
			$config['upload_path']          = './uploads/slider/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           // $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('slider_photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();
				
				$new_name=url_title($this->input->post('slidername'), 'dash', true);
				//echo $new_name;
				$ccc=$this->resize($img_data,$new_name);
				if($img_data['file_name']!="")
				{
					 $data['image_path']='/'.$ccc['new_image'];
				} 
		    }
			$res = $this->slider->update_data($data,$hid);	
			if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
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
	public function check_slidername()
	{
		$slidername=$this->input->post('slidername');
		$hid=$this->input->post('hid');
		$return_value= $this->slider->slidername_check($slidername,$hid);	
		if($return_value=='')
		{
	        
	        return TRUE;
	    }
	    else
	    {
			$this->form_validation->set_message('check_slidername', 'Slider Name already Exist');
	    	return FALSE;
	    }
	 } 

	public function delete($id)
	{
		$sliders = $this->slider->show_slider($id);
		if(!empty($sliders->image_path))
		{
			$path=".$sliders->image_path"; 
		
		unlink($path);
	   }
	   $res = $this->slider->delete_data($id);
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	    return redirect('admin/slider');
				
	}
    public function resize($img_data,$new_name)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/slider/'.$new_name.''.$img_data['file_ext'];
		$config['maintain_ratio'] = false;
        $config['quality'] = '70%';
	    $config['wm_overlay_path'] = './assets/public/img/logo.png';
        $config['wm_type'] = 'overlay'; 
		$config['wm_opacity']   = '10';
        $config['wm_x_transp'] = '9';
        $config['wm_y_transp'] = '9';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_padding'] = '0';
		
		$config['width'] = 1920;
		$config['height'] =900;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 2);
		$data['img_src'] = base_url() . $data['new_image'];
		$this->image_lib->resize();  
		//$this->image_lib->watermark();
		unlink('./uploads/slider/'.$img_data['file_name']);
		return $data;
  }		
		
}
?>
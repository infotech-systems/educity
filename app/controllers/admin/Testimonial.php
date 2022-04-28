<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
       $this->load->model('admin/testimonials');
	   $this->load->library('image_lib');
	 }
	public function index()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$branch_id = $this->session->userdata('branch_id');

		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param='admin/testimonial';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/testimonial';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				$data['testimonials'] = $this->testimonials->test_dtls($branch_id);				
	 			$this->load->view('admin/testimonial',$data);
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
				$param2='admin/testimonial/add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/testimonial';
					 
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);				
					 $this->load->view('admin/testimonial-add',$data);
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

		$this->form_validation->set_rules('test_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('test_comment', 'Comment', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data=array(
			'test_name'=>strtoupper($this->input->post('test_name')),
			'company_nm'=>strtoupper($this->input->post('company_nm')),
			'test_comment'=>$this->input->post('test_comment'),
			'branch_id'=>$this->session->userdata('branch_id'),			
			);
			$config['upload_path']          = './uploads/testimonial/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('photo_path'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$ccc=$this->resize($img_data);
                
				if($img_data['file_name']!="")
				{
					 $data['photo_path']=$ccc['new_image'];
				} 
		    }	
		//	print_r($data);			  
            
			$res = $this->testimonials->add_data($data);	
			
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
	public function edit($id)
	{
		
		$username = $this->session->userdata('user_id');
	    $user_type = $this->session->userdata('user_type');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/testimonial/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/testimonial';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);	
				 $data['testimonial'] = $this->testimonials->show($id);
				 $this->load->view('admin/testimonial-edit',$data);
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
		$this->form_validation->set_rules('test_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('test_comment', 'Comment', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
                'test_name'=>strtoupper($this->input->post('test_name')),
                'company_nm'=>strtoupper($this->input->post('company_nm')),
                'test_comment'=>$this->input->post('test_comment'),
			);
			$config['upload_path']          = './uploads/testimonial/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('photo_path'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$ccc=$this->resize($img_data);
                
				if($img_data['file_name']!="")
				{
                 /*   $testimonial = $this->testimonials->show($hid);
					if(!empty($testimonial->photo_path))
					{
						$path=".$testimonial->photo_path"; 
						//unlink($path);
				    }*/
					 $data['photo_path']=$ccc['new_image'];
				} 
		    }	
            //print_r($data);
			$res = $this->testimonials->update_data($data,$hid);	
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
	public function check_client()
	{
        $client_name=$this->input->post('client_name');
        $contact_no=$this->input->post('contact_no');
		$return_value= $this->clients->client_check($client_name,$contact_no);	
		if($return_value=='')
		{
		
		return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_client', 'Client Already Created');
			return FALSE;
		}
	}
	public function check_client2()
	{
		$client_name=$this->input->post('client_name');
		$contact_no=$this->input->post('contact_no');
		$hid=$this->input->post('hid');
		$return_value= $this->clients->name_check($client_name,$contact_no,$hid);	
		if($return_value=='')
		{
		
		return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_product', 'Client Already Created');
		//	return FALSE;
		}
	}
	public function delete($id)
	{
		   $testimonial= $this->testimonials->show($id);
			if($testimonial->photo_path):
				unlink('./'.$testimonial->photo_path);
			endif;
		   $res = $this->testimonials->delete_data($id);
		   if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
			}
		    return redirect('admin/testimonial');	
				
	}
	public function resize($img_data) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/testimonial/'.$img_data['file_name'];
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
		
		$config['width'] = 220;
		$config['height'] = 220;
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
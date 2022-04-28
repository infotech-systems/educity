<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
       $this->load->model('admin/clients');
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
			$param='admin/client';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/client';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				$data['clients'] = $this->clients->dtls();				
	 			$this->load->view('admin/mailbox',$data);
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
				$param2='admin/client/add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/client';
					 
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);				
					 $this->load->view('admin/client-add',$data);
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

		$this->form_validation->set_rules('client_name', 'Client Name', 'trim|required|callback_check_client');
	//	$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
	//	$this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email');
		
		if (empty($_FILES['client_logo']['name']))
		{
			$this->form_validation->set_rules('client_logo', 'Please Select Client Logo ', 'required');
		}
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data=array(
			'client_name'=>$this->input->post('client_name'),
			'contact_address'=>$this->input->post('contact_address'),
			'contact_person'=>$this->input->post('contact_person'),
			'contact_no'=>$this->input->post('contact_no'),
			'contact_email'=>$this->input->post('contact_email'),
			);
			$config['upload_path']          = './uploads/client/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('client_logo'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('client_name'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['client_logo']=$ccc['new_image'];
				} 
		    }	
		//	print_r($data);			  
            
			$res = $this->clients->add_data($data);	
			
			if($res==true)
			{
			  $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
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
			$param2='admin/client/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/client';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);	
				 $data['client'] = $this->clients->show($id);
				 $this->load->view('admin/client-edit',$data);
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
		$this->form_validation->set_rules('client_name', 'Client Name', 'trim|required|callback_check_client2');
	////	$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required');
	//	$this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
				'client_name'=>$this->input->post('client_name'),
				'contact_address'=>$this->input->post('contact_address'),
				'contact_person'=>$this->input->post('contact_person'),
				'contact_no'=>$this->input->post('contact_no'),
				'contact_email'=>$this->input->post('contact_email'),
			);
			$config['upload_path']          = './uploads/client/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('client_logo'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();	
				$new_name=url_title($this->input->post('client_name'), 'dash', true);	
				$ccc=$this->resize($img_data,$new_name);
                
				if($img_data['file_name']!="")
				{
					 $data['client_logo']=$ccc['new_image'];
				} 
            }	
            //print_r($data);
			//$data=$this->security->xss_clean($data);
			$res = $this->clients->update_data($data,$hid);	
			if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
			   $data['success'] = true; 
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
		   $client= $this->clients->show($id);
			if($client->client_logo):
				unlink('./'.$client->client_logo);
			endif;
		   $res = $this->clients->delete_data($id);
		   if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
			}
		    return redirect('admin/product');	
				
	}
	public function resize($img_data,$new_name) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/client/'.$new_name.''.$img_data['file_ext'];
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
		
		$config['width'] = 250;
		$config['height'] = 124;
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 1);
		$data['img_src'] = base_url() . $data['new_image'];
		//$this->image_lib->watermark();
		$this->image_lib->resize();  
		
		unlink('./uploads/client/'.$img_data['file_name']);
		return $data;
  }	
		
		
}
?>
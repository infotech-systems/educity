<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/administrations','expert');
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
			$param='admin/Administration';
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
	       	
				$data['Administrations'] = $this->expert->dtls();
				
	 			$this->load->view('admin/administration',$data);
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
				$param2='admin/Administration/add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/Administration';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $this->load->view('admin/administration-add',$data);
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
	   $this->form_validation->set_rules('adm_nm', 'Name', 'trim|required');
	   $this->form_validation->set_rules('adm_desig', 'Designation', 'trim|required');
	   $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			$data=array(
				'adm_nm'=>$this->input->post('adm_nm'),
				'adm_desig'=>$this->input->post('adm_desig'),
				'subject'=>$this->input->post('subject'),
				'contact_no'=>$this->input->post('contact_no'),
				'extn'=>$this->input->post('extn'),
				'email_id'=>$this->input->post('email_id'),
			);
			$config['upload_path']          = './uploads/administration/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|JPG';
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
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
					
				
			$res = $this->expert->add_data($data);	
			
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
			$param2='admin/administration/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/administration';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['administration'] = $this->expert->show($id);
				 $this->load->view('admin/administration-edit',$data);
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
	  $this->form_validation->set_rules('adm_nm', 'Name', 'trim|required');
	  $this->form_validation->set_rules('adm_desig', 'Designation', 'trim|required');
	   $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
			
		    $hid=$this->input->post('hid');
			$data=array(
				'adm_nm'=>$this->input->post('adm_nm'),
				'adm_desig'=>$this->input->post('adm_desig'),
				'subject'=>$this->input->post('subject'),
				'contact_no'=>$this->input->post('contact_no'),
				'extn'=>$this->input->post('extn'),
				'email_id'=>$this->input->post('email_id'),
			);
			$config['upload_path']          = './uploads/administration/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|JPG';
           
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
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
          		
			$res = $this->expert->update_data($data,$hid);	
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
	
	  

	public function delete($id)
	{
		$teacher=$this->expert->show($id);
		if($teacher->photo_path):
			unlink('.'.$teacher->photo_path);
		endif;
	

		$res = $this->expert->delete_data($id);
		if($res)
		{
			$this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			$data['success'] = true; 
		}
		else
		{
			$this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
		return redirect('admin/administration');	
				
	}
	public function resize($img_data) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/administration/'.$img_data['file_name'];
		$config['maintain_ratio'] = false;
		$config['create_thumb'] = false;
        $config['quality'] = '80%';

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
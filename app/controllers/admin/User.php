<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends SM_Controller
{
	 function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/users','users');
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
			$param='admin/user';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/user';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				
				if($param3!='0')
				{
				$data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
				$data['soft']  = $this->soft->soft_dtls($sid);
				$this->load->library('pagination');
				
				$config['base_url'] = base_url('admin/user/index');
				$config['total_rows'] = $this->users->num_rows();
				$config['per_page'] = 10;
				$config["uri_segment"] = 4;
				$config['full_tag_open'] = '<ul class="pagination pagination-sm m-0 float-right">';
				$config['full_tag_close'] = '</ul>';
				
				$config['first_link'] = '&laquo;';
				$config['first_tag_open'] = '<li class="page-item">';
				$config['first_tag_close'] = '</li>';	       
				
				$config['last_link'] = '&raquo;';
				$config['last_tag_open'] = '<li class="page-item">';
				$config['last_tag_close'] = '</li>';  
				
				$config['prev_link'] = '&laquo;';
				$config['prev_tag_open'] = '<li class="page-item">';
				$config['prev_tag_close'] = '</li>';	       
				
				$config['next_link'] = '&raquo;';
				$config['next_tag_open'] = '<li class="page-item">';
				$config['next_tag_close'] = '</li>';	
				
				$config['num_tag_open'] = '<li class="page-item">';
				$config['num_tag_close'] = '</li>';
				//$config['anchor_class'] = 'class="page-link"';
				$config['attributes'] = array('class' => 'page-link');
				
				$config['cur_tag_open']='<li class="page-item active"><a href="#" class="page-link">';
				$config['cur_tag_close']="</a></li>";
				
				$this->pagination->initialize($config);
				$limit=$config['per_page'];
				$offset=$this->uri->segment(4);
				
				$data['users'] = $this->users->user_dtls2($limit,$offset);
				
				$this->load->view('admin/user',$data);
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
			$param2='admin/user-add';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/user';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->view('admin/user-add',$data);
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

		$this->form_validation->set_rules('user_nm', 'User Name', 'trim|required');
		$this->form_validation->set_rules('user_id', 'User ID', 'trim|required|is_unique[user_mas.user_id]');
		$this->form_validation->set_rules('pwd', 'Password', 'trim|required');
		if($this->input->post('mail_id'))
		{
			$this->form_validation->set_rules('mail_id', 'Email ID', 'trim|valid_email');
		}
		if($this->input->post('user_cont_no'))
		{
			$this->form_validation->set_rules('user_cont_no', 'Contact No', 'trim|exact_length[10]|numeric');
		}
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data=array(
			'user_nm'=>$this->input->post('user_nm'),
			'user_id'=>$this->input->post('user_id'),
			'pwd'=>password_hash($this->input->post('pwd'),PASSWORD_BCRYPT),
			'user_type'=>$this->input->post('user_type'),
			'orgn_id'=>$this->session->userdata('orgn_id'),
			'user_cont_no'=>$this->input->post('user_cont_no'),
			'mail_id'=>$this->input->post('mail_id'),
			);
			//print_r($data);	
			$config['upload_path']          = './uploads/user/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;

            $this->load->library('upload', $config);

            if (! $this->upload->do_upload('user_photo'))
            {
                    $error = array('error' => $this->upload->display_errors());
            }
            else
            {
				$img_data = $this->upload->data();		
				$ccc=$this->resize($img_data);
                
				if($img_data['file_name']!="")
				{
					 $data['photo_path']='/uploads/user/'.$img_data['file_name'];
				} 
		    }		  
            
			$res = $this->users->add_data($data);	
			
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
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			 $param2='admin/user-edit';
			 $permission= $this->menus->dtls_permission($param2);
			 if(!empty($permission))
			 {
				 $param1='admin/user';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['user'] = $this->users->show_user($id);
				 $this->load->view('admin/user-edit',$data);
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
	public function profile()
	{
		
		$username = $this->session->userdata('user_id');
		$uid =md5($this->session->userdata('uid'));
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			 $param1='admin/user-profile';
			
			 $parent = $this->menus->dtls_parent($param1);
			  print_r($parent);
			 $param3=$parent->parent_id;
			 
			 if($param3!='0')
			 {
				 $data['main_p'] =$this->menus->dtls_main_parent($param3);
			 }
			 $data['parent']= $parent;
			 $data['soft']  = $this->soft->soft_dtls($sid);
			 $data['user'] = $this->users->show_user($uid);
			 $this->load->view('admin/my-profile',$data);
			
		}
		else
		{
			return redirect('admin/login');
		}
	}
		public function myupdate()
	{
	    $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('user_nm', 'User Name', 'trim|required');
		if($this->input->post('mail_id'))
		{
			$this->form_validation->set_rules('mail_id', 'Email ID', 'trim|valid_email');
		}
		if($this->input->post('user_cont_no'))
		{
			$this->form_validation->set_rules('user_cont_no', 'Contact No', 'trim|exact_length[10]|numeric');
		}
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
			$hid=$this->input->post('hid');
			
			$data=array(
			'user_nm'=>$this->input->post('user_nm'),
			'user_cont_no'=>$this->input->post('user_cont_no'),
			'mail_id'=>$this->input->post('mail_id'),
			);
			if($this->input->post('pwd'))
			{
				$data['pwd']=password_hash($this->input->post('pwd'),PASSWORD_BCRYPT);
			}
			
			    $config['upload_path']          = './uploads/user/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
	
                if (! $this->upload->do_upload('user_photo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $img_data = $this->upload->data();
					
                    
					if($img_data['file_name']!="")
					{
						 $data['photo_path']='/uploads/user/'.$img_data['file_name'];
					} 
			    }
			$res = $this->users->update_data($data,$hid);	
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
	public function update()
	{
	    $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('user_nm', 'User Name', 'trim|required');
		if($this->input->post('mail_id'))
		{
			$this->form_validation->set_rules('mail_id', 'Email ID', 'trim|valid_email');
		}
		if($this->input->post('user_cont_no'))
		{
			$this->form_validation->set_rules('user_cont_no', 'Contact No', 'trim|exact_length[10]|numeric');
		}
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
		    $hid=$this->input->post('hid');
			$data=array(
			'user_nm'=>$this->input->post('user_nm'),
			'user_type'=>$this->input->post('user_type'),
			'user_cont_no'=>$this->input->post('user_cont_no'),
			'mail_id'=>$this->input->post('mail_id'),
			'status'=>$this->input->post('status'),
			);
			if($this->input->post('pwd'))
			{
				$data['pwd']=password_hash($this->input->post('pwd'),PASSWORD_BCRYPT);
			}
			
			    $config['upload_path']          = './uploads/user/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);
	
                if (! $this->upload->do_upload('user_photo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $img_data = $this->upload->data();
					
                    
					if($img_data['file_name']!="")
					{
						 $data['photo_path']='/uploads/user/'.$img_data['file_name'];
					} 
				}
			$user = $this->users->show_user(md5($hid));	
			$res = $this->users->update_data($data,$hid);	
			if($res)
			{
				if(($user->status=!$this->input->post('status')) and ($user_type=='C') )
				{   $enail=$user->user_id;
					$subject="User Approved Confirmation";
					$content="Your Application approved. Your User Id is $enail";
					$attachments=array();
					$email=$this->dynamic_email->send_email($user->user_nm,$user->user_id,$subject,$content,$attachments);
					if($email==true)
					{
						$mail_data=
						array(
							'mail_to'=>$email,	
							'sender_name'=>$user->user_nm,	
							'mail_from'=>$orgns[0]['cont_per_email'],
							'mail_subject'=>$subject,
							'mail_content'=>$content,
							'mail_message'=>$this->input->post('message'),
							'mail_type'=>'O',
							'mail_time'=>date('Y-m-d H:i:s'),
						);
						//print_r($mail_data);
						$this->mails->add_data($mail_data);
					}
				}
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
	public function permission($id)
	{
		
		$username = $this->session->userdata('user_id');
	    $page_pers = explode(',',$this->session->userdata('page_per'));
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/user-permission';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/user';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $users = $this->users->show_user($id);
				 $data['users']=$users;
				 $main_menu = $this->menus->main_menu();
				 $data['main_menu']=$main_menu;
				 $this->load->view('admin/user-permission',$data);
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
	public function user_permission()
	{
		$data = array('success' => false, 'messages' => array());
		$uid=$this->input->post('uid');
		$checkbox=$this->input->post('checkbox');
		$page_id = implode(', ', $checkbox);
	
		$data=array(
			'page_per'=>$page_id
		);
			$res=$this->users->update_page_per($data,$uid);
			if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your Page Permission modification Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not update, some error occurred');");
			}
	    echo json_encode($data);

	}  
	public function resize($img_data) 
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $img_data['full_path'];
		$config['new_image'] = './uploads/user/'.$img_data['file_name'];
		$config['maintain_ratio'] = false;
        $config['quality'] = '80%';
	  //$config['wm_overlay_path'] = './assets/public/images/logo.png';
     // $config['wm_type'] = 'overlay'; 
	//	$config['wm_opacity']   = '48';
   //   $config['wm_x_transp'] = '9';
  //    $config['wm_y_transp'] = '9';
	/* 	$config['wm_text'] = 'Copyright Church Art Kolkata';
		$config['wm_type'] = 'text';
        $config['wm_font_path'] = './sys/fonts/texb.ttf';
		$config['wm_font_size'] = '12';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'bottom';
		$config['wm_hor_alignment'] = 'left';
		$config['wm_padding'] = '0';
		*/
		/*$config['width'] = 150;
		$config['height'] = 150;*/
		$this->image_lib->initialize($config);
		$src = $config['new_image'];
		$data['new_image'] = substr($src, 2);
		$data['img_src'] = base_url() . $data['new_image'];
		$this->image_lib->resize();  
		$this->image_lib->watermark();
		return $data;
  }
		
		
}
?>
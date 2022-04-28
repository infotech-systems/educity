<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/socials','socials');
	 }

	public function index()
	{
		$username = $this->session->userdata('user_id');
	    $user_type = $this->session->userdata('user_type');
	    $page_pers = explode(',',$this->session->userdata('page_per'));
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			
			if($user_type!='A')
			{
				$param='admin/social';
				$permission= $this->menus->dtls_permission($param,$page_pers);
		   		if(!empty($permission))
				{
					$param1='admin/social';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					$data['soft']  = $this->soft->soft_dtls($sid);
					
					$this->load->library('pagination');
					$config['base_url'] = base_url('admin/social/index');
					$config['total_rows'] = $this->social->num_rows();
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
					$config['anchor_class'] = 'class="page-link"';
				 //   $config['attributes'] = array('class' => 'page-link');
	
					$config['cur_tag_open']='<li class="page-item active"><a href="#" class="page-link">';
					$config['cur_tag_close']="</a></li>";
	
					$this->pagination->initialize($config);
					$limit=$config['per_page'];
					$offset=$this->uri->segment(4);
					$data['socials'] = $this->socials->social_dtls2($limit,$offset);
					$this->load->view('admin/social',$data);
				}
				else
				{
					return redirect('admin/dashboard');
				}
			}
			else
			{
				$param1='admin/social';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->library('pagination');
				$config['base_url'] = base_url('admin/social/index');
				$config['total_rows'] = $this->socials->num_rows();
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
				$config['anchor_class'] = 'class="page-link"';
			 //   $config['attributes'] = array('class' => 'page-link');

				$config['cur_tag_open']='<li class="page-item active"><a href="#" class="page-link">';
				$config['cur_tag_close']="</a></li>";

				$this->pagination->initialize($config);
				$limit=$config['per_page'];
				$offset=$this->uri->segment(4);
				$data['socials'] = $this->socials->social_dtls2($limit,$offset);
			   
			   
	 			$this->load->view('admin/social',$data);
			}
		}
			
	}
	public function add()
	{
		
		$username = $this->session->userdata('user_id');
	    $user_type = $this->session->userdata('user_type');
	    $page_pers = explode(',',$this->session->userdata('page_per'));
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			if($user_type!='A')
			{
				$param='admin/social-add';
				$permission= $this->menus->dtls_permission($param,$page_pers);
				if(!empty($permission))
				{
					 $param1='admin/social';
					 $param2='admin/social-add';
					 $parent = $this->video->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $this->load->view('admin/social-add',$data);
					}
					else
					{
						return redirect('admin/dashboard');
					}
				}
				else
				{
					 $param1='admin/social';
					 $param2='admin/social-add';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $this->load->view('admin/social-add',$data);
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

		$this->form_validation->set_rules('socialname', 'Name', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data=array(
			'social_nm'=>$this->input->post('socialname'),	
			'social_path'=>$this->input->post('social_path'),	
			'social_url'=>$this->input->post('social_url')				
			);
			
			$res = $this->socials->add_data($data);	
			
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
				$param='admin/social-edit';
				$permission= $this->menus->dtls_permission($param,$page_pers);
				if(!empty($permission))
				{
					 $param1='admin/social';
					 $param2='admin/social-edit';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $data['socials'] = $this->socials->show($id);				
					 $this->load->view('admin/social-edit',$data);
					}
					else
					{
						return redirect('admin/dashboard');
					}
				}
				else
				{
					 $param1='admin/social';
					 $param2='admin/social-edit';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $data['socials'] = $this->socials->show($id);					
					 $this->load->view('admin/social-edit',$data);
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
		$this->form_validation->set_rules('socialname', 'Name', 'trim|required');		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
			'social_nm'=>$this->input->post('socialname'),	
			'social_path'=>$this->input->post('social_path'),	
			'social_url'=>$this->input->post('social_url')				
			);
			$res = $this->socials->update_data($data,$hid);	
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
		
	   $res = $this->socials->delete_data($id);
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	    return redirect('admin/social');	
				
	}
	  
		
}
?>
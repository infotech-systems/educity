<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/homes','homes');
	  
	 }

	public function index()
	{
		$username = $this->session->userdata('user_id');
		$branch_id = $this->session->userdata('branch_id');
		$id=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param1='admin/home';
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
				$data['soft']  = $this->soft->soft_dtls($id);
				$data['homes'] = $this->homes->home_dtls($branch_id);
				$this->load->view('admin/home',$data);
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
			$param2='admin/home-add';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/home';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->view('admin/home-add',$data);
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
		$this->form_validation->set_rules('homename', 'Home Name', 'trim|required');	
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{		 
			$data=array(
			'home_title'=> $this->input->post('homename'),				
			'home_content'=>$this->input->post('ckeditor'),	
			'branch_id'=>$this->session->userdata('branch_id'),	
				
			);	

			$res = $this->homes->add_data($data);	
			if($res==true)
			{
		//	  $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
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
			$param2='admin/home-edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/home';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);		
				 $data['homes'] = $this->homes->show_home($id);	
				 $this->load->view('admin/home-edit',$data);
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
		$this->form_validation->set_rules('homename', 'Home Name', 'trim|required');			
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
		   
				
			$data=array(
			'home_title'=> $this->input->post('homename'),				
			'home_content'=>$this->input->post('ckeditor'),		
			);	
			
			$res = $this->homes->update_data($data,$hid);	
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
	
    
	public function delete($id)
	{
	  $res = $this->homes->delete_data($id);
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	    return redirect('admin/home');	
				
	}
		
		
}
?>
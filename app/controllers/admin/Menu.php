<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('menus');
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
			$param='admin/menu';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/menu';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				$data['menus'] = $this->menus->dtls();
				$menus = $this->menus->dtls();
				//print_r($menus);
				if($menus)
				{   
					foreach($menus as $menu):
					$menu_id=$menu['id'];
					$parent_id=$menu['parent_id'];
					
					$parents[$menu_id]= $this->menus->show_menu($parent_id);
					endforeach;
					$data['parents']=$parents;
				}
				
				
	 			$this->load->view('admin/menu',$data);
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
				$param2='admin/menu/add';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/menu';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
				     $data['menus']  =  $this->menus->dtls();
					

					 $this->load->view('admin/menu-add',$data);
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

		$this->form_validation->set_rules('menuname', 'Menu Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			if($this->input->post('parent_menu'))
			{
				$parent_menu=$this->input->post('parent_menu');
			}
			else
			{
				$parent_menu='0';
			}
			$data=array(
			'title'=>$this->input->post('menuname'),
			'url'=>$this->input->post('menu_url'),
			'uri'=>$this->input->post('menu_uri'),
			'dyn_group_id'=>$this->input->post('group'),
			'position'=>$this->input->post('position'),
			'target'=>$this->input->post('target'),
			'parent_id'=>$parent_menu,
			'is_parent'=>$this->input->post('parent'),
			'show_menu'=>$this->input->post('menu_publish'),
			'p_type'=>$this->input->post('type'),
			);
		//	print_r($data);			  
            
			$res = $this->menus->add_data($data);	
			
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
			$param2='admin/menu/edit';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/menu';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['menus'] = $this->menus->dtls();
				 $data['menu'] = $this->menus->menu_dtls($id);
				 $this->load->view('admin/menu-edit',$data);
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
		$this->form_validation->set_rules('menuname', 'Menu Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
		    $hid=$this->input->post('hid');
			
			if($this->input->post('parent_menu'))
			{
				$parent_menu=$this->input->post('parent_menu');
			}
			else
			{
				$parent_menu='0';
			}
			$data=array(
			'title'=>$this->input->post('menuname'),
			'url'=>$this->input->post('menu_url'),
			'uri'=>$this->input->post('menu_uri'),
			'dyn_group_id'=>$this->input->post('group'),
			'position'=>$this->input->post('position'),
			'target'=>$this->input->post('target'),
			'parent_id'=>$parent_menu,
			'is_parent'=>$this->input->post('parent'),
			'show_menu'=>$this->input->post('menu_publish'),
			'p_type'=>$this->input->post('type'),
			);
			
			
			$res = $this->menus->update_data($data,$hid);	
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
	

	public function delete($id)
	{
		   $res = $this->menus->delete_data($id);
		   if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
			}
		    return redirect('admin/menu');	
				
	}
		
		
}
?>
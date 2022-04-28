<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Organization extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	 }
	public function index()
	{
	    $username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$id=$this->session->userdata('orgn_id');
		if($username!='')
		{
			$param1='admin/setting/organization';
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
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['orgn'] = $this->orgn->show_orgn($id);
				 $this->load->view('admin/orgn',$data);
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
		$this->form_validation->set_rules('orgnname', 'Name', 'trim|required');
		$this->form_validation->set_rules('cont_per_email', 'Contact Email', 'trim|required');		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
			$data=array(
			'orgn_nm'=>$this->input->post('orgnname'),			
			'cont_per_email'=>$this->input->post('cont_per_email'),
			'cont_per_no'=>$this->input->post('cont_per_no'),
			'orgn_addr1'=>$this->input->post('orgn_addr1'),
			'web_addr'=>$this->input->post('web_addr')		
			);
			$res = $this->orgn->update_data($data,$hid);	
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

}
?>
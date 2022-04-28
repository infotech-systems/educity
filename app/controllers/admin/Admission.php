<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/students');
	   $this->load->model('admin/relations');
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
			$param1='admin/admission';
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
				$data['students'] = $this->students->admission_approva_pending();
	 			$this->load->view('admin/admission',$data);				
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
	}
	
	public function approval($id)
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
				$param2='admin/admission/approval';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/admission';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
					 $data['soft']  = $this->soft->soft_dtls($sid);
					 $data['student'] = $this->students->show_student($id);	
                     $data['relations']=$this->relations->dtls();
                     $data['classes']=$this->relations->class_dtls();
                     $data['batches']=$this->relations->batch_dtls();
                     $data['castes']=$this->relations->caste_dtls();
                     $data['bill'] = $this->students->adm_pending_app_receipt($id);	
					 $this->load->view('admin/student-approval',$data);
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
	public function approved()
	{

	  $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('hid', 'Student', 'trim|required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');	
		
		if ($this->form_validation->run() == TRUE)
		{
		    $hid=$this->input->post('hid');
		    $tr_id=$this->input->post('tr_id');
		    $s_bill_no=$this->input->post('s_bill_no');
		    $bill_amt=$this->input->post('bill_amt');
		    
			$data=array(
			'status'=> 'A'				
			);
			$this->students->update_receive($data,$tr_id);	
			$this->students->update_due($bill_amt,$s_bill_no);	
			$res = $this->students->update_data($data,$hid);	
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
	public function student()
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
			$param2='admin/admission/student';
				$permission= $this->menus->dtls_permission($param2);
				if(!empty($permission))
				{
					 $param1='admin/admission';
					 $parent = $this->menus->dtls_parent($param1);
					 $param3=$parent->parent_id;
					 if($param3!='0')
					 {
						 $data['main_p'] =$this->menus->dtls_main_parent($param3);
					 }
					 $data['parent']= $parent;
					 $data['child'] = $this->menus->dtls_method($param2);
				$data['soft']  = $this->soft->soft_dtls($sid);
				$data['students'] = $this->students->dtls();
	 			$this->load->view('admin/student',$data);				
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
	}	
}
?>
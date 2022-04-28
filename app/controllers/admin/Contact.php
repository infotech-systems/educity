<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
       $this->load->model('admin/mails');
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
			$param='admin/contact';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/contact';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				$data['mails'] = $this->mails->inquiry_dtls($branch_id,'C');
	 			$this->load->view('admin/contact',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
			
	}
	
		
}
?>
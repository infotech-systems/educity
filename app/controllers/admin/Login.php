<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('orgn');
	  $this->load->model('admin/loginmodel','loginmodel');
	  
	 }
	public function index()
	{
		$id=1;
		$data['soft']  = $this->soft->soft_dtls($id);
		$this->load->view('admin/login',$data);
	}
	public function admin_login()
	{
		$id=2;
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['soft']  = $this->soft->soft_dtls($id);
			$this->load->view('admin/login',$data);
		}
		else
		{
			$username=$this->input->post('username');
            $password=$this->input->post('password');
			
			$login_id=$this->loginmodel->login_valid($username);
			if($login_id)
			{
				if (password_verify($password, $login_id->pwd))
				{
					$uid=$login_id->uid;
					$orgn_id=$login_id->orgn_id;
					$id=$orgn_id;
					$login_on=date('Y-m-d H:i:s');
					$data=array(
						'uid'=>$uid,
						'login_on'=>$login_on,
						'orgn_id'=>$orgn_id
						);
						

						$this->loginmodel->add_data($data);	
					
					$login_log=$this->loginmodel->login_log_id($uid);
					$orgn = $this->orgn->show_orgn($id);
					$this->session->set_userdata('uid',$uid);
					$this->session->set_userdata('user_nm',$login_id->user_nm);
					$this->session->set_userdata('user_id',$login_id->user_id);
					$this->session->set_userdata('current_status',$login_id->current_status);
					$this->session->set_userdata('user_type',$login_id->user_type);
					$this->session->set_userdata('photo_path',$login_id->photo_path);
					$this->session->set_userdata('page_per',$login_id->page_per);
					$this->session->set_userdata('orgn_id',$login_id->orgn_id);
					$this->session->set_userdata('status',$login_id->status);
					$this->session->set_userdata('chk_id',$login_log->id);
					$this->session->set_userdata('orgn_logo',$orgn->orgn_logo);
					$this->session->set_userdata('orgn_abbr',$orgn->orgn_abbr);
					$this->session->set_userdata('orgn_nm',$orgn->orgn_nm);
					$this->session->set_userdata('soft_id','2');
					$this->session->set_userdata('portal_type','W');
					if($login_id->user_type=='C')
					{
						$this->session->set_userdata('portal_type','C');
					}
					return redirect('admin/dashboard');
				}
				else
				{
				$data['soft']  = $this->soft->soft_dtls($id);
				$this->session->set_flashdata('message', "alertify.error('ERROR: Wrong User Name  or Password');");
				$this->load->view('admin/login',$data);
				}
			}
			else
			{
				$data['soft']  = $this->soft->soft_dtls($id);
				$this->session->set_flashdata('message', "alertify.error('ERROR: Wrong User Name');");
				$this->load->view('admin/login',$data);

			}
		}
     }
}
?>
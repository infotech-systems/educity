<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailbox extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
       $this->load->model('admin/mails');
	   $this->load->library('image_lib');
	   $this->load->helper('download');
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
			$param='admin/mailbox';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/mailbox';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				//$data['mails'] = $this->mails->dtls('I');	
				$this->load->library('pagination');

				$config['base_url'] = base_url('admin/mailbox/index');
	            $config['total_rows'] = $this->mails->num_rows('I');
	            $config['per_page'] =10;
	            $config["uri_segment"] = 4;
	            $config['full_tag_open'] = '<ul class="pagination pagination-sm m-0 float-right">';
	            $config['full_tag_close'] = '</ul>';
	            

	            $config['prev_link'] = '<i class="fas fa-chevron-left"></i>';
	            $config['prev_tag_open'] = '<li class="page-item">';
	            $config['prev_tag_close'] = '</li>';	       
	             
	 			$config['next_link'] = '<i class="fas fa-chevron-right"></i>';
	            $config['next_tag_open'] = '<li class="page-item">';
	            $config['next_tag_close'] = '</li>';	

	            $config['num_tag_open'] = '<li class="page-item" id="show">';
	            $config['num_tag_close'] = '</li>';
				//$config['anchor_class'] = 'class="page-link"';
                 $config['attributes'] = array('class' => 'page-link');

				$config['cur_tag_open']='<li class="page-item active" id="show"><a href="#" class="page-link">';
				$config['cur_tag_close']="</a></li>";

				$this->pagination->initialize($config);
				$limit=$config['per_page'];
				$offset=$this->uri->segment(4);
				$data['offset'] =$offset;
				$data['limit'] ='10';
				$data['total'] =$this->mails->num_rows('I');
				$data['mails'] = $this->mails->dtls('I',$limit,$offset);

				

	 			$this->load->view('admin/mailbox',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
			
	}
	public function read($id)
	{
		
		$username = $this->session->userdata('user_id');
	    $user_type = $this->session->userdata('user_type');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/mailbox/read';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/mailbox';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);	
				 $data['mail'] = $this->mails->show($id);
				 $this->load->view('admin/mail-inbox-read',$data);
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
	public function sent()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
			$param='admin/mailbox/sent';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$param1='admin/mailbox/sent';
				$parent = $this->menus->dtls_parent($param1);
				$param3=$parent->parent_id;
				 
				if($param3!='0')
				{
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				}
				$data['parent']= $parent;
				
	       		$data['soft']  = $this->soft->soft_dtls($sid);
				//$data['mails'] = $this->mails->dtls('I');	
				$this->load->library('pagination');

				$config['base_url'] = base_url('admin/mailbox/index');
	            $config['total_rows'] = $this->mails->num_rows('O');
	            $config['per_page'] =10;
	            $config["uri_segment"] = 4;
	            $config['full_tag_open'] = '<ul class="pagination pagination-sm m-0 float-right">';
	            $config['full_tag_close'] = '</ul>';
	            

	            $config['prev_link'] = '<i class="fas fa-chevron-left"></i>';
	            $config['prev_tag_open'] = '<li class="page-item">';
	            $config['prev_tag_close'] = '</li>';	       
	             
	 			$config['next_link'] = '<i class="fas fa-chevron-right"></i>';
	            $config['next_tag_open'] = '<li class="page-item">';
	            $config['next_tag_close'] = '</li>';	

	            $config['num_tag_open'] = '<li class="page-item" id="show">';
	            $config['num_tag_close'] = '</li>';
				//$config['anchor_class'] = 'class="page-link"';
                 $config['attributes'] = array('class' => 'page-link');

				$config['cur_tag_open']='<li class="page-item active" id="show"><a href="#" class="page-link">';
				$config['cur_tag_close']="</a></li>";

				$this->pagination->initialize($config);
				$limit=$config['per_page'];
				$offset=$this->uri->segment(4);
				$data['offset'] =$offset;
				$data['limit'] ='10';
				$data['total'] =$this->mails->num_rows('O');
				$data['mails'] = $this->mails->dtls('O',$limit,$offset);

				

	 			$this->load->view('admin/sentbox',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
			
	}
	public function download($file=NULL)
	{
		if($file):
			$file_path='uploads/complain/'.$file;
			echo $file_path;
			if(file_exists($file_path)):
				$data=file_get_contents($file_path);
				force_download($file,$data);
			endif;
		endif;
	}
		
		
}
?>
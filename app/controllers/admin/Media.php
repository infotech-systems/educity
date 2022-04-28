<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('admin/medias','medias');
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
			$param1='admin/media';
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
				$this->load->library('pagination');
				$config['base_url'] = base_url('admin/media/index');
				$config['total_rows'] = $this->medias->num_rows();
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
				$data['medias'] = $this->medias->media_dtls2($limit,$offset);
				$this->load->view('admin/media',$data);
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
			
	}
	public function browser()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('admin/login');
		}
		else
		{
				$data['medias'] = $this->medias->media_dtls();
				$this->load->view('admin/temp/file-browser',$data);
		}
			
	}
	public function add()
	{
		
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			$param2='admin/media-add';
			$permission= $this->menus->dtls_permission($param2);
			if(!empty($permission))
			{
				 $param1='admin/media';
				 $param2='admin/media-add';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->view('admin/media-add',$data);
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

		$this->form_validation->set_rules('media', 'Media', 'required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)
		{
			$data=array();
			 $config['upload_path']          = './uploads/media/';
             $config['allowed_types'] = 'jpg|gif|png|jpeg|bmp|pdf|xls|xlsx|zip|rar|mp3|doc|docx|txt';
           

            $this->load->library('upload', $config);
            if (! $this->upload->do_upload('media_path'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();		
                
				if($img_data['file_name']!="")
				{
					 $data['media_path']='/uploads/media/'.$img_data['file_name'];
					 $data['med_extn']=$img_data['file_ext'];
				} 
		    }		  
            
            
			
			$res = $this->medias->add_data($data);   
			
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
    
	public function delete($id)
	{
		$media = $this->medias->show_media($id);
		if(!empty($media->media_path))
		{
			$path=".$media->media_path"; 
			unlink($path);
	   }
		
	   $res = $this->medias->delete_data($id);
	   if($res)
		{
		   $this->session->set_flashdata('message', "alertify.success('Your data delete Successfully..');");
		   $data['success'] = true; 
		}
		else
		{
		  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not delete, some error occurred');");
		}
	    return redirect('admin/media');	
				
	}
	  
		
}
?>
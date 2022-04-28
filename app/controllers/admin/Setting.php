<?php 
class Setting extends SM_Controller
{
	function __construct()
	 {
	   parent::__construct();

        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
		$this->load->helper('directory');
		ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3000);
	 }
	public function index()
	{
		return redirect('dashboard');
	}
	public function database()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param='admin/setting/database';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$DBUSER=$this->db->username;
				$DBPASSWD=$this->db->password;
				$DATABASE=$this->db->database;
			
				$filename = $DATABASE . "-" . date("Y-m-d_H-i-s") . ".sql";
				$this->load->dbutil();
				
				$db_format=array('format'=>'zip','filename'=>$filename);
				$backup=$this->dbutil->backup($db_format);
				$dbname='backup-on-'.date('Y-m-d').'.zip';
				$save='asset/backup/'.$dbname;
				write_file($save,$backup);
				force_download($dbname,$backup);
			}
			else
			{
				return redirect('dashboard');
			}
		}
	}
	public function media()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param='admin/setting/media';
			$permission= $this->menus->dtls_permission($param);
			if(!empty($permission))
			{
				$this->zip->compression_level = 0;
				$this->zip->read_dir('/uploads/');
				$this->zip->read_dir('uploads/video/');
				$this->zip->read_dir('uploads/user/');
				$this->zip->read_dir('uploads/teacher/');
				$this->zip->read_dir('uploads/tag/');
				$this->zip->read_dir('uploads/speech/');
				$this->zip->read_dir('uploads/soft/');
				
				$this->zip->read_dir('uploads/slider/');
				$this->zip->read_dir('uploads/product/');
				$this->zip->read_dir('uploads/photo/');
				$this->zip->read_dir('uploads/orgn/');
				$this->zip->read_dir('uploads/news/');
				$this->zip->read_dir('uploads/member/');
				
				$this->zip->read_dir('uploads/media/');
				$this->zip->read_dir('uploads/license/');
				$this->zip->read_dir('uploads/fact/');
				$this->zip->read_dir('uploads/events/');
				$this->zip->read_dir('uploads/comp/');
				$this->zip->read_dir('uploads/category/');
				
				$dbname='source-backup-on-'.date('Y-m-d').'.zip';
				$this->zip->download($dbname);  
			}
			else
			{
				return redirect('admin/dashboard');
			}
		}
	}
	public function retore_database()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param1='setting/retore_database';
			$permission= $this->menus->dtls_permission($param1);
			if(!empty($permission))
			{
				// $param1='setting';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $main_p =$this->menus->dtls_main_parent($param3);
					 $data['main_p']=$main_p;
					 $param4=$main_p->parent_id;
					 if($param4!='0')
					 {
						$main =$this->menus->dtls_main_parent($param4);
						$data['main']=$main;
					 }
				 }
				 $data['parent']= $parent;
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $this->load->view('restore-database',$data);
			}
			else
			{
				return redirect('dashboard');
			}
		}
	}
	public function fadds()
    {
       set_time_limit(6000);
       $data = array('success' => false, 'messages' => array());   
       $this->form_validation->set_rules('media', 'Media', 'required');                   
       $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
       if ($this->form_validation->run() == TRUE)
        {
            $data=array();
            $config['upload_path']   = './uploads/restore/';
            $config['allowed_types'] = 'zip|rar';
            $config['max_size']           = 0;
                $this->load->library('upload', $config);
    
                if (! $this->upload->do_upload('databasefile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $img_data = $this->upload->data();
                    if($img_data['file_name']!="")
                    {
                        $media_path='./uploads/restore/'.$img_data['file_name'];

                        $this->load->library('unzip');
                        $this->unzip->allow(array('sql'));
                        $this->unzip->extract($media_path, './uploads/restore/'); 
                        unlink($media_path);
                        $files = directory_map('uploads/restore/');
                        if($files)
                        {
                        
                            $file_name=$files[0];
                            $path = getcwd();
                            $folder_name = 'uploads/restore/';
                            $restore_file = $path . '/' .$folder_name . '/' . $file_name;

                             $this->load->dbutil();
                            if (!file_exists($restore_file)) 
                            {
                                $this->response->message = lang('File_not_found');
                                $this->session->set_flashdata('message', lang('File_not_found'));
                                $this->response_message();
                            }

                            $file_restore = $this->load->file($restore_file, true);
                            $file_array = explode(';', $file_restore);
                            foreach ($file_array as $query) 
                            {
                                $query = trim($query);
								echo "<br>$query";

                                if (!empty($query) && strlen($query)) 
                                {
                                    $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
                                    $this->db->query($query);
                                    $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
                                }
                            }
                             $media_path1='./uploads/restore/'.$file_name;
                            unlink($media_path1);
                        }
                        else
                        {
                            $data['success'] = true;     
                            $this->session->set_flashdata('message', "alertify.error('Your data restore Unuccessfully..');");
                        }
                    } 
                }
                      
                $data['success'] = true;     
                $this->session->set_flashdata('message', "alertify.success('Your data restore Successfully..');");
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
	
	public function organization()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$orgn_id=$this->session->userdata('orgn_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param1='admin/setting/organization';
			$permission= $this->menus->dtls_permission($param1);
			if(!empty($permission))
			{
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $main_p =$this->menus->dtls_main_parent($param3);
					 $data['main_p']=$main_p;
					 $param4=$main_p->parent_id;
					 if($param4!='0')
					 {
						$main =$this->menus->dtls_main_parent($param4);
						$data['main']=$main;
					 }
				 }
				 $data['parent']= $parent;
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['orgn']  = $this->orgn->show_orgn($orgn_id);
				 $this->load->view('admin/organization',$data);
			}
			else
			{
				return redirect('dashboard');
			}
		}
	}
	public function orgn_update()
	{
	    $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('orgn_nm', 'Name', 'trim|required');
		$this->form_validation->set_rules('orgn_abbr', 'ABBR', 'trim|required');
		if($this->input->post('email_id'))
		{
			$this->form_validation->set_rules('email_id', 'Email ID', 'trim|valid_email');
		}
		if($this->input->post('cont_per_email'))
		{
			$this->form_validation->set_rules('cont_per_email', 'Contact Email', 'trim|valid_email');
		}
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
		    $hid=$this->input->post('hid');
			$data=array(
				'orgn_nm'=>$this->input->post('orgn_nm'),
				'orgn_abbr'=>$this->input->post('orgn_abbr'),
				'orgn_addr1'=>$this->input->post('orgn_addr'),
				'email_id'=>$this->input->post('email_id'),
				'web_addr'=>$this->input->post('web_addr'),
				'cont_per'=>$this->input->post('cont_per'),
				'cont_per_no'=>$this->input->post('cont_per_no'),
				'cont_per_no2'=>$this->input->post('cont_per_no2'),
				'cont_per_email'=>$this->input->post('cont_per_email'),
				'about_me'=>$this->input->post('ckeditor'),
				'active_year'=>$this->input->post('active_year'),
			);
			$orgn  = $this->orgn->show_orgn($hid);

			$config['upload_path']          = './uploads/orgnization/';
			$config['allowed_types']        = 'gif|jpg|png|ico';
			$this->load->library('upload', $config);

			if (! $this->upload->do_upload('orgn_logo'))
			{
					$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				if($orgn->orgn_logo)
				{
					unlink(".$orgn->orgn_logo");
				}
				$img_data = $this->upload->data();
				if($img_data['file_name']!="")
				{
					 $data['orgn_logo']='/uploads/orgnization/'.$img_data['file_name'];
				} 
			}
			if (! $this->upload->do_upload('footer_logo'))
			{
					$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				if($orgn->footer_logo)
				{
					unlink(".$orgn->footer_logo");
				}
				$img_data2 = $this->upload->data();
				if($img_data2['file_name']!="")
				{
					 $data['footer_logo']='/uploads/orgnization/'.$img_data2['file_name'];
				} 
			}
			if (! $this->upload->do_upload('favicon'))
			{
					$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				if($orgn->favicon)
				{
					unlink(".$orgn->favicon");
				}
				$img_data3 = $this->upload->data();
				if($img_data3['file_name']!="")
				{
					 $data['favicon']='/uploads/orgnization/'.$img_data3['file_name'];
				} 
			}
			$res = $this->orgn->update_data($data,$hid);	
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
	public function year()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$orgn_id=$this->session->userdata('orgn_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param1='setting/year';
			$permission= $this->menus->dtls_permission($param1);
			if(!empty($permission))
			{
				// $param1='setting';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $main_p =$this->menus->dtls_main_parent($param3);
					 $data['main_p']=$main_p;
					 $param4=$main_p->parent_id;
					 if($param4!='0')
					 {
						$main =$this->menus->dtls_main_parent($param4);
						$data['main']=$main;
					 }
				 }
				 $data['parent']= $parent;
				 $param5='user-add';
				 $data['add_per']=$this->menus->dtls_permission($param5);
				 $param6='user-edit';
				 $data['edit_per']=$this->menus->dtls_permission($param6);
				 $param7='user-permission';
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['years']  = $this->years->year_dtls($orgn_id);
				 $this->load->view('year',$data);
			}
			else
			{
				return redirect('dashboard');
			}
		}
	}
	public function year_edit($id)
	{
		
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		if($username!='')
		{
			 $param2='setting/year_edit';
			 $permission= $this->menus->dtls_permission($param2);
			 if(!empty($permission))
			 {
				 $param1='setting/year';
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $data['main_p'] =$this->menus->dtls_main_parent($param3);
				 }
				 $data['parent']= $parent;
				 $data['child'] = $this->menus->dtls_method($param2);
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['year'] = $this->years->show_year($id);
				 $this->load->view('year-edit',$data);
			}
			else
			{
				return redirect('dashboard');
			}
		}
		else
		{
			return redirect('login');
		}
	}
	public function year_update()
	{
	    $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('year_desc', 'Description', 'trim|required');
		$this->form_validation->set_rules('year_abbr', 'ABBR', 'trim|required');
		$this->form_validation->set_rules('st_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim||required|callback_check_enddate['.$this->input->post('st_date').']');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
		/*	
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
			$res = $this->users->update_data($data,$hid);	
			if($res)
			{
			   $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
			   $data['success'] = true; 
			}
			else
			{
			  $this->session->set_flashdata('message', "alertify.error('ERROR: Did not update, some error occurred');");
			}*/
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
	public function check_enddate($str,$st_date)
	{
    	// $st_date=$this->input->post('st_date');
	    // $year_desc=$this->input->post('year_desc');  
		print_r($str);
		if(strtotime($st_date)>=strtotime($this->input->post('end_date')))
		{
			//echo strtotime($this->input->post('st_date'));
			
			$this->form_validation->set_message('check_enddate', 'The end date must be greater than the start date.');
		    return FALSE;
		}
		else
		{
			return TRUE;
		
		}
	}

	public function branch()
	{
		$username = $this->session->userdata('user_id');
		$sid=$this->session->userdata('soft_id');
		$orgn_id=$this->session->userdata('orgn_id');
		$branch_id=$this->session->userdata('branch_id');
		if($username=='')
		{
			return redirect('login');
		}
		else
		{
			$param1='admin/setting/branch';
			$permission= $this->menus->dtls_permission($param1);
			if(!empty($permission))
			{
				 $parent = $this->menus->dtls_parent($param1);
				 $param3=$parent->parent_id;
				 
				 if($param3!='0')
				 {
					 $main_p =$this->menus->dtls_main_parent($param3);
					 $data['main_p']=$main_p;
					 $param4=$main_p->parent_id;
					 if($param4!='0')
					 {
						$main =$this->menus->dtls_main_parent($param4);
						$data['main']=$main;
					 }
				 }
				 $data['parent']= $parent;
				 $data['soft']  = $this->soft->soft_dtls($sid);
				 $data['branch']  = $this->branchs->show_branch($branch_id);
				 $this->load->view('admin/branch',$data);
			}
			else
			{
				return redirect('dashboard');
			}
		}
	}
	public function branch_update()
	{
	    $data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('branch_nm', 'Name', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');		
		if ($this->form_validation->run() == TRUE)
		{
			
		    $hid=$this->input->post('hid');
			$data=array(
			'branch_nm'=>$this->input->post('branch_nm'),
			'cont_no'=>$this->input->post('cont_no'),
			'branch_addr'=>$this->input->post('branch_addr'),
			'map'=>$this->input->post('map'),
			);
		
			$res = $this->branchs->update_data($data,$hid);	
			if($res)
			{
			  // $this->session->set_flashdata('message', "alertify.success('Your data modification Successfully..');");
			   $data['message'] = 'Your data modification Successfully..'; 
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
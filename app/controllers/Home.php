<?php 
class Home extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/socials');
	   $this->load->model('admin/sliders');
	   $this->load->model('admin/homes');
	   $this->load->model('admin/pages');
	   $this->load->model('admin/photos');
	   $this->load->model('admin/categorys');
	   $this->load->helper('captcha');
	   $this->load->model('admin/captcha'); 
	   $this->load->model('admin/mails'); 

	}
	public function index()
	{
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$data['sliders'] = $this->sliders->slider_dtls();
		$data['homes'] = $this->homes->home_dtls();
		$page=$this->pages->show_page2('home');
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_content,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
		$categorys = $this->categorys->rand_category();
		if($categorys):
			foreach($categorys as $cat):
				$data['photos'][$cat['cat_id']]= $this->photos->photo_group('4',$cat['cat_id']);

			endforeach;

		endif;
		$data['captcha']=$this->initCaptcha();

		$data['categorys']=$categorys;

		$this->load->view('temp/header',$data);
		$this->load->view('home',$data);
		$this->load->view('temp/footer',$data);
		$this->load->view('include/home',$data);
	}
	function initCaptcha()
	{
		$cpatchas = $this->captcha->dtls();
	//	 print_r($cpatchas);
		if($cpatchas)
		{
			foreach($cpatchas as $captcha):
				if($captcha['image_name']):
				$path='./uploads/captcha/'.$captcha['image_name'];
					unlink($path);
				endif;
				$this->captcha->delete_data($captcha['captcha_id']);
			endforeach;
		}
	//Only the img_path and img_url are required. rest is optional it will use default 
		$values=array(
		//If a word is not supplied, the function will generate a random ASCII string
		'word'=>rand(1,999999),
		'word_lenght'=>8,
		'img_path'=>'./uploads/captcha/',
		'img_url'=>base_url().'uploads/captcha/',
		'font_path' => base_url() . 'system/fonts/texb.ttf',
		'img_width' => '150',
		'img_height' => 50,
		'img_id'=>'captchaId',
		'expiration' => 72000 ,
		'color'=>array(
		'backgroud'=>array(255,255,255),
		'border'=>array(255,255,255),
		'text'=>array(0,0,0),
		'grid'=>array(255,40,40)
		)
		);
		
		$data = create_captcha($values);
		$this->session->set_userdata('captchaWord',$data['word']);
		$this->session->set_userdata('captchaFile',$data['filename']);
		$data2 = array(
				'captcha_time'  => $data['time'],
				'ip_address'    => $this->input->ip_address(),
				'word'          => $data['word'],
				'image_name'          => $data['filename']
		);
		//print_r($data);
		$query = $this->db->insert_string('captcha', $data2);
		$this->db->query($query);
		return $data;
	}
	public function check_captcha($captchaWord)
	{
		
		$captcha_code=$this->input->post('captcha_code');
			if($captcha_code === $captchaWord)
	        {
	        
	        	return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_captcha','Captcha code mismatch');
				return FALSE;
			}
	 }
     public function inquiry()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('your_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('your_mobile', 'Phone', 'trim|required');
		$this->form_validation->set_rules('your_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim|required|callback_check_captcha['.$this->session->userdata('captchaWord').']');
		$this->form_validation->set_rules('your_message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == FALSE)
		{
			foreach ($_POST as $key => $value) 
			{
				$data['messages'][$key] = form_error($key);
			}
		}
		else
		{
			$your_name=$this->input->post('your_name');
			$form_subject='Admission Inquiry';
			$form_number=$this->input->post('your_mobile');
			$messagess=$this->input->post('your_message');
			$email=$this->input->post('your_email');

				$mail_data=
				array(
					'mail_from'=>$email,	
					'sender_name'=>$your_name,	
					'mail_to'=>'',
					'mail_subject'=>$form_subject,
					'mobile_no'=>$form_number,
					'mail_content'=>$messagess,
					'mail_type'=>'I',
					'mail_time'=>date('Y-m-d H:i:s'),
				);
			$res=$this->mails->add_data($mail_data);
            if($res)
            {
				$this->session->set_flashdata('message', "alertify.success('Your message send Successfully..');");
			    $data['success'] = true; 
			    $data['message'] = 'Your message send Successfully..'; 
			}
			else
			{
				 $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
			}
		}
		echo json_encode($data);

	}
	public function allinquiry()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('recipient_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('recipient_contact', 'Phone', 'trim|required');
		$this->form_validation->set_rules('recipient_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim|required|callback_check_captcha['.$this->session->userdata('captchaWord').']');
		$this->form_validation->set_rules('recipient_message', 'message', 'trim|required');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == FALSE)
		{
			foreach ($_POST as $key => $value) 
			{
				$data['messages'][$key] = form_error($key);
			}
		}
		else
		{
			$your_name=$this->input->post('recipient_name');
			$form_subject='Admission Inquiry';
			$form_number=$this->input->post('recipient_contact');
			$messagess=$this->input->post('recipient_message');
			$email=$this->input->post('recipient_email');

				$mail_data=
				array(
					'mail_from'=>$email,	
					'sender_name'=>$your_name,	
					'mail_to'=>'',
					'mail_subject'=>$form_subject,
					'mobile_no'=>$form_number,
					'mail_content'=>$messagess,
					'mail_type'=>'I',
					'mail_time'=>date('Y-m-d H:i:s'),
				);
			$res=$this->mails->add_data($mail_data);
            if($res)
            {
				$this->session->set_flashdata('message', "alertify.success('Your message send Successfully..');");
			    $data['success'] = true; 
			    $data['message'] = 'Your message send Successfully..'; 
			}
			else
			{
				 $this->session->set_flashdata('message', "alertify.success('Your data Add Successfully..');");
			}
		}
		echo json_encode($data);

	}
}
?>
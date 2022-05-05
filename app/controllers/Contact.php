<?php 
class Contact extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/socials');
	   $this->load->model('admin/sliders');
	   $this->load->model('admin/homes');
	   $this->load->model('admin/pages');
	   $this->load->model('admin/categorys');
       $this->load->helper('captcha');
	   $this->load->model('admin/captcha'); 
	   $this->load->model('admin/mails'); 
	   $this->load->library('email');
	   $this->load->library('parser');
	}
	public function index()
	{
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$page=$this->pages->show_page2('contact');
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_content,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
        
		$data['captcha']=$this->initCaptcha();
		$this->load->view('temp/header',$data);
		$this->load->view('contact',$data);
		$this->load->view('temp/footer',$data);
		$this->load->view('include/contact',$data);
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
				   if(file_exists($path)):
					unlink($path);
				endif;
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
	 public function refreshCaptcha()
	{
		$data=$this->initCaptcha();
		 echo $data['image'];
	}
	
	public function check_captcha($captcha_code,$captcha_text)
	{
		
		$hid_code=$this->input->post('hid_code');
			if($captcha_code === $hid_code)
	        {
	        
	        	return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_captcha','Captcha code mismatch');
				return FALSE;
			}
	 }
     public function send()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('form_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('form_subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('form_number', 'Phone', 'trim|required');
		$this->form_validation->set_rules('form_email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim|required|callback_check_captcha['.$this->session->userdata('captchaWord').']');
		$this->form_validation->set_rules('messagess', 'message', 'trim|required');
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
			$your_name=$this->input->post('form_name');
			$form_subject=$this->input->post('form_subject');
			$form_number=$this->input->post('form_number');
			$messagess=$this->input->post('messagess');
			$email=$this->input->post('form_email');
			$content='
			<table width="97%" cellpadding="4" cellspacing="4" border="0" style="border:1px solid #c0251b;">
			<tr>
			<td width="113" align="left" class="text">Name</td>
			<td width="5" align="left" class="text">:</td>
			<td align="left" colspan="5" class="text">'.$your_name.'</td>
			</tr>
			<tr>
			<td width="113" align="left" class="text">Email ID</td>
			<td width="5" align="left" class="text">:</td>
			<td align="left" colspan="5" class="text">'.$email.'</td>
			</tr>
			<tr>
			<td width="113" align="left" class="text">Mobile</td>
			<td width="5" align="left" class="text">:</td>
			<td align="left" colspan="5" class="text">'.$form_number.'</td>
			</tr>
			<tr>
			<td width="113" align="left" class="text">Subect</td>
			<td width="5" align="left" class="text">:</td>
			<td align="left" colspan="5" class="text">'.$form_subject.'</td>
			</tr>
			<tr>
			<td width="113" align="left" class="text">Massage</td>
			<td width="5" align="left" class="text">:</td>
			<td align="left" colspan="5" class="text">'.$this->input->post('your_message').'</td>
			</tr>
			</table>
			';          
			$orgns = $this->orgn->orgn_dtls2();
			//print_r($orgns);
		//	$this->email->from($email, $your_name);
			$this->email->from($email, $your_name);
			$this->email->to('contact@educitywb.in'); 
			$this->email->subject($form_subject);
		//	$this->email->cc('foundationebs@gmail.com', $your_name);
			$this->email->cc($email, $your_name);
			
			//$this->email->bcc('churchart.ganguly@gmail.com');

			$this->email->message($content);  
			if($this->email->send())
			{
				$mail_data=
				array(
					'mail_from'=>$email,	
					'sender_name'=>$your_name,	
					'mail_subject'=>$form_subject,
					'mobile_no'=>$form_number,
					'mail_content'=>$messagess,
					'mail_type'=>'C',
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
			else
			{
				show_error($this->email->print_debugger());
			}
		}
		echo json_encode($data);

	}
	 
}
?>
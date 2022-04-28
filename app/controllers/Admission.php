<?php 
class Admission extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/socials');
	   $this->load->model('admin/sliders');
	   $this->load->model('admin/homes');
	   $this->load->model('admin/pages');
	   $this->load->model('admin/students');
	   $this->load->model('admin/relations');
	   $this->load->helper('captcha');
	   $this->load->model('admin/captcha'); 
	}
	public function index()
	{
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$data['sliders'] = $this->sliders->slider_dtls();
		$page=$this->pages->show_page2('admission');
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_content,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
		$data['captcha']=$this->initCaptcha();
        $data['relations']=$this->relations->dtls();
        $data['classes']=$this->relations->class_dtls();
        $data['batches']=$this->relations->batch_dtls();
        $data['castes']=$this->relations->caste_dtls();
		$this->load->view('temp/header',$data);
		$this->load->view('admission',$data);
		$this->load->view('temp/footer',$data);
        $this->load->view('include/admission',$data);

	}  
    public function getfee()
	{
		$class_id=$this->input->post('class_id');

		$data['fees']=$this->relations->fee_dtls($class_id);
		$this->load->view('fee',$data);
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

    public function check_captcha($captcha_word)
	{
		
		$captcha_code=$this->input->post('captcha_code');
        if($captcha_code === $captcha_word)
        {
        
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('check_captcha','Captcha code mismatch');
            return FALSE;
        }
	 } 
     public function check_student()
	{
		
		$contact_no=$this->input->post('contact_no');
        $student = $this->students->student_check($contact_no);	
        if($student)
        {
            $this->form_validation->set_message('check_student','Already student admitted');
            return FALSE;
        }
        else
        {
            return TRUE;
 
        }
	 } 
     public function check_pay()
     {
         
        $pay_amt=$this->input->post('pay_amt');
        $total_amt=$this->input->post('total_amt');
        if($pay_amt === $total_amt)
         {
         
             return TRUE;
         }
         else
         {
             $this->form_validation->set_message('check_pay','Payment Amount & Total Amount are  mismatch');
             return FALSE;
         }
      } 
	public function send()
	{
		$data = array('success' => false, 'messages' => array());
		$this->form_validation->set_rules('form_name', 'Name Of Applicant', 'trim|required');
		$this->form_validation->set_rules('form_addr', 'Full Address', 'trim|required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required');
		$this->form_validation->set_rules('guardian_name', 'Father / Guardian', 'trim|required');
		$this->form_validation->set_rules('relationship', 'Relationship', 'trim|required');
		$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required|callback_check_student');
		$this->form_validation->set_rules('stream', 'Class applied for', 'trim|required');
		$this->form_validation->set_rules('batch', 'Batch preferred', 'trim|required');
		$this->form_validation->set_rules('captcha_code', 'Captcha Code', 'trim|required|callback_check_captcha['.$this->session->userdata('captchaWord').']');
        $this->form_validation->set_rules('pay_amt', 'Pay Amount', 'trim|required|callback_check_pay');
		$this->form_validation->set_rules('pay_date', 'Date of Payment', 'trim|required');
      
      
        
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
			$dob1=$this->input->post('dob');
			$dob2= DateTime::createFromFormat('d/m/Y', $dob1); 
			$dob= $dob2->format('Y-m-d'); 

            $pay_date2= DateTime::createFromFormat('d/m/Y', $this->input->post('pay_date')); 
			$pay_date= $pay_date2->format('Y-m-d'); 

			$studentdata=array(
				'year'=> date('Y'),	
				'mobile_no'=>$this->input->post('contact_no'),	
				'student_name'=>$this->input->post('form_name'),	
				'student_addr'=>$this->input->post('form_addr'),	
				'landmark'=>$this->input->post('landmark'),	
				'dob'=>$dob,	
				'guardian_name'=>$this->input->post('guardian_name'),	
				'relationship_id'=>$this->input->post('relationship'),	
				'caste'=>$this->input->post('caste'),	
				'category'=>$this->input->post('category'),	
				'class_id'=>$this->input->post('stream'),	
				'cur_school_name'=>$this->input->post('school_name'),	
				'batch_id'=>$this->input->post('batch'),
				'adm_date'=>date('Y-m-d'),
				'pay_upto'=>date('Y-m'),
			);
			$config['upload_path']          = './uploads/student/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = '2048';
           
            $this->load->library('upload', $config);
			
            if (! $this->upload->do_upload('photo'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data = $this->upload->data();		
				if($img_data['file_name']!="")
				{
					 $studentdata['photo_path']='/uploads/student/'.$img_data['file_name'];
				} 
				
								
		    }	
			$config2['upload_path']          = './uploads/income/';
            $config2['allowed_types']        = 'gif|jpg|png|jpeg';
            $config2['max_size']             = '2048';
           
            $this->load->library('upload', $config2);
			$this->upload->initialize($config2);
            if (! $this->upload->do_upload('income'))
            {
                 $error = array('error' => $this->upload->display_errors());
            }
            else
            {
                $img_data2 = $this->upload->data();		
				if($img_data2['file_name']!="")
				{
					 $studentdata['income_proof']='/uploads/income/'.$img_data2['file_name'];
				} 
		    }	
			$student_id = $this->students->add_data($studentdata);	
			if($student_id):
                $sale_bill='INV/'.$student_id.'/'.strtotime(date('Y-m-d H:i:s'));

                $billdata=array(
                    'tr_code'=> 'S',	
                    'student_id'=>$student_id,	
                    'bill_no'=>$sale_bill,	
                    'bill_date'=>date('Y-m-d'),	
                    'bill_amt'=>$this->input->post('total_amt'),	
                    'due_amt'=>$this->input->post('total_amt'),	
                );
                $tr_id = $this->students->add_trans($billdata);	
                $check=$this->input->post('check');
                $fee_amt=$this->input->post('fee_amt');
                foreach($check as $ck):
                    $invdata=array(
                        'tr_id'=> $tr_id,	
                        'bill_no'=>$sale_bill,	
                        'student_id'=>$student_id,	
                        'fees_id'=>$ck,	
                        'fees_amt'=>$fee_amt[$ck],	
                        'bill_month'=>date('Y-m'),	
                    );  
                    $this->students->add_inv($invdata);	
                endforeach;
                $receive_bill='REC/'.$student_id.'/'.strtotime(date('Y-m-d H:i:s'));
                $receivedata=array(
                    'tr_code'=> 'R',	
                    'student_id'=>$student_id,	
                    'bill_no'=>$receive_bill,	
                    'bill_date'=>date('Y-m-d'),	
                    'bill_amt'=>$this->input->post('total_amt'),	
                    'pay_id'=>$this->input->post('transaction_id'),	
                    'pay_date'=>$pay_date,	
                    's_bill_no'=>$sale_bill,	
                    'status'=>'D',	
                );
                $config3['upload_path']          = './uploads/payment/';
                $config3['allowed_types']        = 'gif|jpg|png|jpeg';
                $config3['max_size']             = '2048';
            
                $this->load->library('upload', $config3);
                $this->upload->initialize($config3);
                if (! $this->upload->do_upload('pay_photo'))
                {
                    $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                    $img_data3 = $this->upload->data();		
                    if($img_data3['file_name']!="")
                    {
                        $receivedata['pay_slip']='/uploads/payment/'.$img_data3['file_name'];
                    } 
                }	
                $this->students->add_trans($receivedata);	

				$this->session->set_flashdata('message', "alertify.success('Your message send Successfully..');");
				$data['success'] = true; 
			else:
				$this->session->set_flashdata('message', "alertify.error('Error: Your data not added');");
			endif;
    
		
			
		}
			echo json_encode($data);

	}
}
?>
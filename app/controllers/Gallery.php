<?php 
class Gallery extends SM_Controller
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
	}
	public function index()
	{
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$data['sliders'] = $this->sliders->slider_dtls();
		$data['homes'] = $this->homes->home_dtls();
		$page=$this->pages->show_page2('gallery');
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_content,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
		$data['captcha']=$this->initCaptcha();
        $data['categorys']=$this->categorys->photo_category();
        $data['photos']= $this->photos->photo_dtls();

		$this->load->view('temp/header',$data);
		$this->load->view('gallery',$data);
		$this->load->view('temp/footer',$data);
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
}
?>
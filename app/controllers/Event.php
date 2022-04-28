<?php 
class Event extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/socials');
	   $this->load->model('admin/homes');
	   $this->load->model('admin/pages');
	   $this->load->model('admin/events');
	   $this->load->model('branchs');
	   $this->load->model('admin/captcha'); 
       $this->load->helper('captcha');

	}
	public function index()
	{
		$branch=$this->branchs->branch_by_path('kolkata');
		$data['branch'] = $branch;
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$data['homes'] = $this->homes->home_dtls($branch->branch_id);
		$page=$this->pages->show_page2('event',$branch->branch_id);
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_content,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
			$data['captcha']=$this->initCaptcha();

        $this->load->library('pagination');
        $config['base_url'] = base_url('kolkata/event/index');
        $config['total_rows'] = $this->events->num_rows($branch->branch_id);
        $config['per_page'] = 10;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
            
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';	       
            
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';  

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';	       
            
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';	

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
      //  $config['anchor_class'] = 'class="page-link"';
        //   $config['attributes'] = array('class' => 'page-link');

        $config['cur_tag_open']='<li class="active"><a href="#">';
        $config['cur_tag_close']="</a></li>";

        $this->pagination->initialize($config);
        $limit=$config['per_page'];
        $offset=$this->uri->segment(4);
        $data['events']= $this->events->events_dtls2($limit,$offset,$branch->branch_id);
		$data['event_recents'] = $this->events->event_recent('3',$branch->branch_id);
		$this->load->view('kolkata/temp/header',$data);
		$this->load->view('kolkata/event',$data);
		$this->load->view('kolkata/temp/footer',$data);
	}

    
        public function details($event_slug)
        {
            $branch=$this->branchs->branch_by_path('kolkata');
		    $data['branch'] = $branch;
            $page=$this->pages->show_page2('event',$branch->branch_id);
            $data['page']=$page;
            $data['pageinfo']=array(
                'title'=>$page->page_name,
                'meta_keywords'=>$page->meta_keywords,
                'meta_desc'=>$page->meta_desc,
                );
            $data['event']=$this->events->show_event_byslug($event_slug);
			$data['captcha']=$this->initCaptcha();
            $data['event_recents'] = $this->events->event_recent('3',$branch->branch_id);
            $data['orgn'] = $this->orgn->orgn_dtls();
            $data['socials'] = $this->socials->dtls();
            $this->load->view('kolkata/temp/header',$data);
            $this->load->view('kolkata/event-details',$data);
            $this->load->view('kolkata/temp/footer',$data);	
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
<?php 
class Administration extends SM_Controller
{
	function __construct()
	{
	   parent::__construct();
	   $this->load->model('admin/socials');
	   $this->load->model('admin/pages');
	   $this->load->model('admin/administrations','expert');
	}
	public function index()
	{
		$data['orgn'] = $this->orgn->orgn_dtls();
		$data['socials'] = $this->socials->dtls();
		$page=$this->pages->show_page2('administration');
		$data['page']=$page;
		$data['pageinfo']=array(
			'title'=>$page->page_name,
			'meta_keywords'=>$page->meta_keywords,
			'meta_desc'=>$page->meta_desc,
			);
        $data['administrations']= $this->expert->dtls();
		$this->load->view('temp/header',$data);
		$this->load->view('administration',$data);
		$this->load->view('temp/footer',$data);
	}

    
}
?>